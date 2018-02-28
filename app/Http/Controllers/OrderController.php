<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Mage2\Ecommerce\Events\OrderPlaceAfterEvent;
use Illuminate\Support\Facades\Session;
use Mage2\Ecommerce\Models\Database\Product;
use Mage2\Ecommerce\Models\Database\Order;
use App\Http\Requests\PlaceOrderRequest;
use Mage2\Ecommerce\Models\Database\OrderStatus;
use Mage2\Ecommerce\Models\Database\User;
use Mage2\Ecommerce\Models\Database\Address;

use Mage2\Ecommerce\Models\Database\OrderProductVariation;
use Mage2\Ecommerce\Payment\Facade as Payment;

class OrderController extends Controller
{

    public function place(PlaceOrderRequest $request)
    {


        $orderProductData = Session::get('cart');
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

        Session::forget('cart');
        Session::forget('order_data');

        return redirect()->route('order.success', $order->id);

    }


    public function success($id)
    {
        $order = Order::findorfail($id);

        return view('order.success')
            ->with('order', $order);
    }

    public function myAccountOrderList()
    {
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id', '=', $user->id)->get();
        $view = view('order.my-account-order-list')->with('orders', $orders);

        return $view;
    }

    public function myAccountOrderView($id)
    {
        $order = Order::find($id);
        $view = view('order.my-account-order-view')->with('order', $order);

        return $view;
    }

    private function _getUser(Request $request)
    {


        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }
        $userData = $request->get('user');


        $user = User::where('email', '=', $userData['email'])->first();


        if (null === $user) {
            $billingData = $request->get('billing');


            //register guest user as user with random password
            $userData['password'] = bcrypt(str_random(6));
            $userData['first_name'] = $billingData['first_name'];
            $userData['last_name'] = $billingData['last_name'];

            $user = User::create($userData);
        }

        Auth::guard('web')->loginUsingId($user->id);

        return $user;

    }

    private function _getBillingAddress(Request $request)
    {

        $billingData = $request->get('billing');

        $billingData['type'] = 'BILLING';
        $billingData['user_id'] = Auth::guard('web')->user()->id;

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
        $shippingData['user_id'] = Auth::guard('web')->user()->id;

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

        //Only use pivot fields only @later on use Collection and then use pluck method rather then foreach
        foreach ($orderProducts as $id => $orderProduct) {

            if (isset($orderProduct['attributes'])) {
                foreach ($orderProduct['attributes'] as $attribute) {
                    $data = ['order_id' => $order->id,
                        'product_id' => $id,
                        'attribute_dropdown_option_id' => $attribute['attribute_dropdown_option_id'],
                        'attribute_id' => $attribute['attribute_id'],
                    ];

                    //@todo change the Product QTY
                    //$productVariation = ProductVariation::findorfail($attribute['variation_id']);
                    //$productVariation->update(['qty' => ($productVariation->qty - $orderProduct['qty'])]);
                    OrderProductVariation::create($data);
                }
            } else {

                $product = Product::findorfail($id);
                $product->update(['qty' => ($product->qty - $orderProduct['qty'])]);
            }

            unset($orderProduct['name']);
            unset($orderProduct['slug']);
            unset($orderProduct['image']);
            unset($orderProduct['id']);
            unset($orderProduct['attributes']);
            unset($orderProduct['final_price']);
            $orderProducts[$id] = $orderProduct;
        }



        $order->products()->sync($orderProducts);
    }


}
