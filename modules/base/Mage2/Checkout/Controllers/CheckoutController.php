<?php

namespace Mage2\Checkout\Controllers;

use Mage2\Address\Models\Address;
use Mage2\User\Models\User;
use Mage2\Framework\Shipping\Facade\Shipping;
use Mage2\Framework\Payment\Facade\Payment;
use Illuminate\Http\Request;
use Mage2\Checkout\Requests\CheckoutUserRequest;
use Illuminate\Support\Facades\Session;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mage2\Address\Requests\AddressRequest;
use Mage2\TaxClass\Models\Country;
class CheckoutController extends Controller {

   
    public function __construct(){
       
        parent::__construct();
    }
    public function index() {

        $orderData = Session::get('order_data');
        if (Auth::check()) {
            $orderData['user_id'] = Auth::user()->id;
            Session::put('order_data', $orderData);
            return redirect()->route('checkout.step.shipping-address');
        }
        return view("checkout.index");
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


        $countries = Country::all();
        $user = Auth::user();
        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'SHIPPING')->get()->first();

        if(Null === $address) {
            $address = new Address();
        }
        //return $address;
        return view("checkout.shipping-address")
                        ->with('address', $address)
                        ->with('countries', $countries)
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
        $countries = Country::all();

        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'BILLING')->get()->first();
        if(Null === $address) {
            $address = new Address();
        }
        return view("checkout.billing-address")
                        ->with('address', $address)
                        ->with('countries', $countries)
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
        return view("checkout.shipping-option")
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
        return view("checkout.payment-option")
                ->with('paymentOptions',$paymentOptions)
        ;
    }

    public function postPaymentOption(Request $request) {

        $orderData = Session::get('order_data');

        $paymentMethod = Payment::get($request->get('payment_option'));
        $paymentMethod->process($orderData);

        $orderData['payment_method'] = $request->get('payment_option');


        dd('die');
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.review');
    }

    public function review() {
        $cartProducts = Session::get('cart');
        return view("checkout.review")
                        ->with('cartProducts', $cartProducts)
        ;
    }

}
