<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Support\Facades\Cart;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Database\Contracts\OrderProductAttributeModelInterface;
use AvoRed\Framework\Support\Facades\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderPlaceRequest;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\AddressRepository
     */
    protected $addressRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $oderRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderProductRepository
     */
    protected $orderProductRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderProductAttributeRepository
     */
    protected $oderProductAttributeRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $oderStatusRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     * Customer Model.
     * @var \App\Customer
     */
    protected $customer;

    /**
     * Customer Shipping Address Model.
     * @var \AvoRed\Framework\Database\Models\Address
     */
    protected $shippingAddress;

    /**
     * Order Status Model.
     * @var \AvoRed\Framework\Database\Models\OrderStatus
     */
    protected $orderStatus;

    /**
     * Customer Billing Address Model.
     * @var \AvoRed\Framework\Database\Models\Address
     */
    protected $billingAddress;

    /**
     * order controller construct.
     * @param \AvoRed\Framework\Database\Contracts\CustomerModelInterface
     * @param \AvoRed\Framework\Database\Contracts\AddressModelInterface
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface
     * @param \AvoRed\Framework\Database\Contracts\OrderStatusModelInterface
     */
    public function __construct(
        CustomerModelInterface $customerRepository,
        AddressModelInterface $addressRepository,
        OrderModelInterface $orderRepository,
        OrderStatusModelInterface $orderStatusRepository,
        OrderProductModelInterface $orderProductRepository,
        OrderProductAttributeModelInterface $orderProductAttributeRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->oderStatusRepository = $orderStatusRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->oderProductAttributeRepository = $orderProductAttributeRepository;
    }

    /**
     * Place the Order .
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place(OrderPlaceRequest $request)
    {
        $this->customer($request);
        $this->shippingAddress($request);
        $this->billingAddress($request);
        $this->paymentOption();
        $this->orderStatus();

        $orderData = [
            'shipping_option' => $request->get('shipping_option'),
            'payment_option' => $request->get('payment_option'),
            'order_status_id' => $this->orderStatus->id,
            'currency_id' => $this->getCurrency()->id,
            'customer_id' => $this->customer->id,
            'shipping_address_id' => $this->shippingAddress->id,
            'billing_address_id' => $this->billingAddress->id,
        ];
        $order = $this->orderRepository->create($orderData);
        $this->syncProducts($order, $request);
        Cart::clear();

        return redirect()
            ->route('order.successful', $order->id)
            ->with('success', 'Order Placed Successfuly!');
    }

    /**
     * Create/Get Customer to placed an Order.
     * @param Request $request
     * @return self
     */
    public function customer($request)
    {
        if (Auth::guard('customer')->check()) {
            $this->customer = Auth::guard('customer')->user();
        } else {            
            $email = $request->get('email');
           
            $this->customer = $this->customerRepository->findByEmail($email);     

            if ($this->customer === null) {
                $this->customer = $this->customerRepository->create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password'))
                ]);
               
            }
        }

        return $this;
    }

    /**
     * Create/Get Customer to placed an Order.
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function shippingAddress($request)
    {
        $addressData = $request->get('shipping');
        //var_dump($addressData);

        if (isset($addressData['address_id'])) {
            $this->shippingAddress = $this->addressRepository->find($addressData['address_id']);

            return $this;
        }
        $addressData['type'] = 'SHIPPING';
        $addressData['customer_id'] = $this->customer->id;

        $this->shippingAddress = $this->addressRepository->create($addressData);

        return $this;
    }

    /**
     * Create/Get Customer to placed an Order.
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function billingAddress($request)
    {
        $addressData = $request->get('billing');

        if (isset($addressData['address_id'])) {
            $this->billingAddress = $this->addressRepository->find($addressData['address_id']);

            return $this;
        }

        $flag = $request->get('use_different_address');
        if ($flag == 'true') {
            $addressData['type'] = 'BILLING';
            $addressData['customer_id'] = $this->customer->id;

            $this->billingAddress = $this->addressRepository->create($addressData);
        } else {
            $this->billingAddress = $this->shippingAddress;
        }

        return $this;
    }

    /**
     * Set Default Order Status Model.
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function orderStatus()
    {
        $this->orderStatus = $this->oderStatusRepository->findDefault();
    }

    /**
     * check and process payment option
     */
    public function paymentOption()
    {
        $payment = Payment::get(request()->get('payment_option'));

        $payment->process();
    }

    /**
     * Successfull Page Display.
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return \Illuminate\Response\Renderable
     */
    public function successful(Order $oder)
    {
        return view('order.successful');
    }

    /**
     * Get the current default currency from session.
     * @return \AvoRed\Framework\Database\Models\Currency
     */
    protected function getCurrency(): Currency
    {
        return session()->get('default_currency');
    }

    /**
     * Sync Products and Attributes with Order Tables.
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function syncProducts(Order $order, $request)
    {
        $cartProducts = Cart::all();

        foreach ($cartProducts as $cartProduct) {
            $orderProductData = [
                'product_id' => $cartProduct->id(),
                'order_id' => $order->id,
                'qty' => $cartProduct->qty(),
                'price' => $cartProduct->price(),
                'tax_amount' => $cartProduct->taxAmount(),
            ];
            $orderProductModel = $this->orderProductRepository->create($orderProductData);

            $attributes = $cartProduct->attributes();

            if ($attributes !== null && count($attributes) > 0) {
                foreach ($attributes as $attribute) {
                    $orderProductAttributeData = [
                        'order_product_id' => $orderProductModel->id,
                        'attribute_id' => $attribute['attribute_id'],
                        'attribute_dropdown_option_id' => $attribute['attribute_dropdown_option_id'],
                    ];
                    $this->oderProductAttributeRepository->create($orderProductAttributeData);
                }
            }
        }
    }
}
