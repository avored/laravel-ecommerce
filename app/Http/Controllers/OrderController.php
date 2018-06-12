<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use AvoRed\Ecommerce\Events\OrderPlaceAfterEvent;
use App\Http\Requests\PlaceOrderRequest;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Ecommerce\Models\Database\User;
use AvoRed\Ecommerce\Models\Database\Address;
use AvoRed\Framework\Models\Database\OrderProductVariation;

class OrderController extends Controller
{
    public function place(PlaceOrderRequest $request)
    {
        $orderProductData = Cart::all();
        $user = $this->_getUser($request);
        $billingAddress = $this->_getBillingAddress($request);
        $shippingAddress = $this->_getShippingAddress($request);
        $orderStatus = OrderStatus::whereIsDefault(1)->get()->first();
        $paymentOption = $request->get('payment_option');

        $data['shipping_address_id'] = $shippingAddress->id;
        $data['billing_address_id'] = $billingAddress->id;
        $data['user_id'] = $user->id;
        $data['shipping_option'] = $request->get('shipping_option');
        $data['payment_option'] = $paymentOption;
        $data['order_status_id'] = $orderStatus->id;

        $payment = Payment::get($paymentOption);

        $paymentReturn = $payment->process($data, $orderProductData, $request);

        //@todo check Response is success of fail.

        $order = Order::create($data);
        $this->_syncOrderProductData($order, $orderProductData);

        Event::fire(new OrderPlaceAfterEvent($order, $orderProductData, $request));

        Cart::clear();

        return redirect()->route('order.success', $order->id);
    }

    public function success(Order $order)
    {
        return view('order.success')->with('order', $order);
    }

    public function myAccountOrderList()
    {
        $user = Auth::guard()->user();
        $orders = Order::whereUserId($user->id)->get();
        $view = view('order.my-account-order-list')->with('orders', $orders);

        return $view;
    }

    public function myAccountOrderView(Order $order)
    {
        $view = view('order.my-account-order-view')->with('order', $order);
        return $view;
    }

    private function _getUser(Request $request)
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

    private function _getBillingAddress(Request $request)
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

    private function _getShippingAddress(Request $request)
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
    private function _syncOrderProductData($order, $orderProducts)
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
                                        'tax_amount' => 0.00 //$orderProduct->tax();
                                        ];
        }
        $order->products()->sync($orderProductTableData);
    }
}
