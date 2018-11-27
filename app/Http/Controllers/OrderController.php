<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\OrderPlaceAfterEvent;
use App\Http\Requests\PlaceOrderRequest;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\Address;
use AvoRed\Framework\Models\Database\OrderProductVariation;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;
use App\Http\Requests\MyAccount\Order\OrderReturnRequest;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class OrderController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
    */
    protected $repository;
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderReturnRequestRepository  $orderReturnRequestRepository
    */
    protected $orderReturnRequestRepository;
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderReturnProductRepository  $orderReturnProductRepository
    */
    protected $orderReturnProductRepository;

    /**
     * Construct to setup Repository
     *
     */
    public function __construct(
        ConfigurationInterface $rep,
        OrderReturnRequestInterface $orderReturnRequestRepository,
        OrderReturnProductInterface $orderReturnProductRepository
    ) {
        parent::__construct();

        $this->repository = $rep;
        $this->orderReturnRequestRepository = $orderReturnRequestRepository;
        $this->orderReturnProductRepository = $orderReturnProductRepository;
    }

    public function place(PlaceOrderRequest $request)
    {
        $orderProductData = Cart::all();

        $user = $this->getUser($request);
        $billingAddress = $this->getBillingAddress($request);
        $shippingAddress = $this->getShippingAddress($request);
        $orderStatus = OrderStatus::whereIsDefault(1)->get()->first();
        $paymentOption = $request->get('payment_option');

        $currencyCode = Session::get('currency_code') ?? $this->repository->getValueByKey('general_site_currency');

        $data['shipping_address_id'] = $shippingAddress->id;
        $data['billing_address_id'] = $billingAddress->id;
        $data['user_id'] = $user->id;
        $data['shipping_option'] = $request->get('shipping_option');
        $data['payment_option'] = $paymentOption;
        $data['order_status_id'] = $orderStatus->id;
        $data['currency_code'] = $currencyCode;

        $payment = Payment::get($paymentOption);

        $paymentReturn = $payment->process($data, $orderProductData, $request);

        //@todo check Response is success of fail.

        $order = Order::create($data);
        $this->syncOrderProductData($order, $orderProductData);

        ////INSERT a RECORD INTO ORDER_HISTORY TABLE
        $orderHistoryRepository = app(OrderHistoryInterface::class);
        $orderHistoryRepository->create(['order_id' => $order->id, 'order_status_id' => $orderStatus->id]);
        Event::fire(new OrderPlaceAfterEvent($order, $orderProductData, $request));

        Cart::clear();

        return redirect()->route('order.success', $order->id);
    }

    public function success(Order $order)
    {
        return view('order.success')->with('order', $order);
    }

    /**
     * User Order List Page
     *
     * @return Illuminate\Http\Response
     */
    public function myAccountOrderList()
    {
        $user = Auth::guard()->user();
        $orders = Order::whereUserId($user->id)->get();
        $view = view('order.my-account-order-list')->with('orders', $orders);

        return $view;
    }

    /**
     * User Order Details Page
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return Illuminate\Http\Response
     */
    public function myAccountOrderView(Order $order)
    {
        return view('order.my-account-order-view')
                    ->withOrder($order);
    }

    /**
     * Order Return Request Page
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return Illuminate\Http\Response
     */
    public function return(Order $order)
    {
        return view('my-account.order.return')
                    ->withOrder($order);
    }

    /**
     * Order Return Request Page
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @param \App\Http\Requests\MyAccount\Order\OrderReturnRequest $order
     * @return Illuminate\Http\Response
     */
    public function returnPost(Order $order, OrderReturnRequest $request)
    {
        $returnRequest = $this->orderReturnRequestRepository->create([
            'order_id' => $order->id,
            'comment' => $request->get('comment'),
            'status' => 'PENDING'
        ]);

        foreach ($request->get('products') as $product) {
            $product['product_id'] = app(ProductInterface::class)->findBySlug($product['slug'])->id;

            $returnRequest->products()->create($product);
        }

        return redirect()->back()->withNotificationText('Order Return Request placed successfully!');
    }

    private function getUser(Request $request)
    {
        if (Auth::guard()->check()) {
            return Auth::guard()->user();
        }
        $userData = $request->get('user');

        $user = User::whereEmail($userData['email'])->first();

        if (null === $user) {
            $billingData = $request->get('billing');

            //register guest user as user with random password
            $userData['password'] = bcrypt(str_random(6));
            $userData['first_name'] = $billingData['first_name'];
            $userData['last_name'] = $billingData['last_name'];

            $user = User::create($userData);
        }

        Auth::guard()->loginUsingId($user->id);

        return $user;
    }

    private function getBillingAddress(Request $request)
    {
        $billingData = $request->get('billing');

        $billingData['type'] = 'BILLING';
        $billingData['user_id'] = Auth::guard()->user()->id;

        if (isset($billingData['id']) && $billingData['id'] > 0) {
            $address = Address::findorfail($billingData['id']);
        //$address->update($shippingData);
        } else {
            $address = Address::create($billingData);
        }

        return $address;
    }

    private function getShippingAddress(Request $request)
    {
        if (null == $request->get('use_different_shipping_address')) {
            $shippingData = $request->get('billing');
        } else {
            $shippingData = $request->get('shipping');
        }

        $shippingData['type'] = 'SHIPPING';
        $shippingData['user_id'] = Auth::guard()->user()->id;

        if (isset($shippingData['id']) && $shippingData['id'] > 0) {
            $address = Address::findorfail($shippingData['id']);
        //$address->update($shippingData);
        } else {
            $address = Address::create($shippingData);
        }

        return $address;
    }

    /**
     * @param $order
     * @param $orderProducts
     *
     *
     */
    private function syncOrderProductData($order, $orderProducts)
    {
        $orderProductTableData = [];

        foreach ($orderProducts as $orderProduct) {
            if (null != $orderProduct->attributes() && $orderProduct->attributes()->count() >= 0) {
                foreach ($orderProduct->attributes() as $attribute) {
                    $product = Product::whereSlug($orderProduct->slug())->first();
                    $data = ['order_id' => $order->id,
                        'product_id' => $product->id,
                        'attribute_dropdown_option_id' => $attribute['attribute_dropdown_option_id'],
                        'attribute_id' => $attribute['attribute_id'],
                    ];

                    OrderProductVariation::create($data);

                    $productVariationModel = Product::find($attribute['variation_id']);
                    $productVariationModel->update(['qty' => ($productVariationModel->qty - $orderProduct->qty())]);
                }
            } else {
                $product = Product::whereSlug($orderProduct->slug())->first();
                $product->update(['qty' => ($product->qty - $orderProduct->qty())]);
            }

            $orderProductTableData[] = [
                'product_id' => $product->id,
                'qty' => $orderProduct->qty(),
                'price' => $orderProduct->price(),
                'tax_amount' => 0.00,
                'product_info' => $product->toJson()

            ];
        }
        $order->products()->sync($orderProductTableData);
    }
}
