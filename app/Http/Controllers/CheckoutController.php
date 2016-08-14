<?php

namespace App\Http\Controllers;

use Mage2\Admin\Shipping\Facade\Shipping;
use Mage2\Admin\Payment\Facade\Payment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CheckoutUserRequest;
use Mage2\Admin\Models\User;
use Illuminate\Support\Facades\Session;
use Mage2\Admin\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class CheckoutController extends Controller {

    public function index() {

        $orderData = Session::get('order_data');
        if (Auth::check()) {
            $orderData['user_id'] = Auth::user()->id;
            Session::put('order_data', $orderData);
            return redirect()->route('checkout.step.shipping-address');
        }
        return view($this->theme . ".checkout.index");
    }

    public function postUser(CheckoutUserRequest $request) {
        $orderData = Session::get('order_data');

        $request->merge(['password' => bcrypt($request->get('password'))]);
        $user = User::create($request->all());

        Auth::guard('web')->login($user);

        $orderData['user_id'] = $user->id;
        Session::put('order_data', $orderData);
        return redirect()->route('checkout.step.shipping-address');
    }

    public function shippingAddress() {


        $user = Auth::user();
        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'SHIPPING')->get()->first();

        //return $address;
        return view($this->theme . ".checkout.shipping-address")
                        ->with('address', $address)
        ;
    }

    public function postShippingAddress(AddressRequest $request) {

        $orderData = Session::get('order_data');
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $request->merge(['type' => 'SHIPPING']);


        
        if ($request->get('id') > 0) {
            $address = Address::findorfail($request->get('id'));
            $address->update($request->all());
        } else {
            $address = Address::create($request->all());
        }
        $orderData['shipping_address_id'] = $orderData['shipping_address_id'] = $address->id;
        Session::put('order_data', $orderData);


        return redirect()->route('checkout.step.billing-address');
    }

    public function billingAddress() {

        $user = Auth::user();

        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'BILLING')->get()->first();
        return view($this->theme . ".checkout.billing-address")
                        ->with('address', $address)
        ;
    }

    public function postBillingAddress(AddressRequest $request) {


        $orderData = Session::get('order_data');
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $request->merge(['type' => 'BILLING']);
        if ($request->get('id') > 0) {
            $address = Address::findorfail($request->get('id'));
            $address->update($request->all());
        } else {
            $address = Address::create($request->all());
        }
        $orderData['billing_address_id'] = $orderData['shipping_address_id'] = $address->id;
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.shipping-option');
    }

    public function shippingOption() {

        $shillingOptions = Shipping::all();
        return view($this->theme . ".checkout.shipping-option")
                ->with('shillingOptions',$shillingOptions)
        ;
    }

    public function postShippingOption(Request $request) {

        $orderData = Session::get('order_data');
        $orderData['shipping_method'] = $request->get('shipping_option');
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.payment-option');
    }

    public function paymentOption() {

        $paymentOptions = Payment::all();
        return view($this->theme . ".checkout.payment-option")
                ->with('paymentOptions',$paymentOptions)
        ;
    }

    public function postPaymentOption(Request $request) {

        $orderData = Session::get('order_data');


        $orderData['payment_method'] = $request->get('payment_option');
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.review');
    }

    public function review() {
        $cartProducts = Session::get('cart');
        return view($this->theme . ".checkout.review")
                        ->with('cartProducts', $cartProducts)
        ;
    }

}
