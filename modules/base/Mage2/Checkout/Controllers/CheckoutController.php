<?php

namespace Mage2\Checkout\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mage2\User\Models\Address;
use Mage2\User\Requests\AddressRequest;
use Mage2\Checkout\Requests\CheckoutUserRequest;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Framework\Payment\Facades\Payment;
use Mage2\Framework\Shipping\Facades\Shipping;
use Mage2\TaxClass\Models\Country;
use Mage2\User\Models\User;
use Mage2\Checkout\Requests\ShippingOptionRequest;
use Mage2\Checkout\Requests\PaymentOptionRequest;

class CheckoutController extends Controller
{
    public function index()
    {

        $user = NULL;
        $shippingOptions = Shipping::all();
        $paymentOptions = Payment::all();
        $countries =  [null => 'Please Select'] +  Country::all()->pluck('name' , 'id')->toArray();
        $orderData = Collection::make([]);

        $cartItems = Session::get('cart');
        //$cartItems = Session::get('order_data');
        if (Auth::check()) {
            //$orderData['user_id'] = Auth::user()->id;
            Session::put('order_data', $orderData);

            $user = Auth::user();

            //$orderData->push($user->toArray());
            //return redirect()->route('checkout.step.shipping-address');
        }




        //dd($orderData);
        return view('checkout.new-index')
                    ->with('cartItems',$cartItems)
                    ->with('countries',$countries)
                    ->with('shippingOptions',$shippingOptions)
                    ->with('paymentOptions',$paymentOptions)

                    ;

        return view('checkout.index');
    }

    public function postUser(CheckoutUserRequest $request)
    {
        $orderData = Session::get('order_data');

        $request->merge(['password' => bcrypt($request->get('password'))]);
        $user = User::create($request->all());

        Auth::guard('web')->login($user);

        $orderData['user_id'] = $user->id;
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.shipping-address');
    }

    public function shippingAddress()
    {
        $countries = Country::all();
        $user = Auth::user();
        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'SHIPPING')->get()->first();

        if (null === $address) {
            $address = new Address();
        }
        //return $address;
        return view('checkout.shipping-address')
                        ->with('address', $address)
                        ->with('countries', $countries);
    }

    public function postShippingAddress(AddressRequest $request)
    {
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

    public function billingAddress()
    {
        $user = Auth::user();
        $countries = Country::all();

        $address = Address::where('user_id', '=', $user->id)
                        ->where('type', '=', 'BILLING')->get()->first();
        if (null === $address) {
            $address = new Address();
        }

        return view('checkout.billing-address')
                        ->with('address', $address)
                        ->with('countries', $countries);
    }

    public function postBillingAddress(AddressRequest $request)
    {
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

    public function shippingOption()
    {
        $shillingOptions = Shipping::all();

        return view('checkout.shipping-option')
                ->with('shillingOptions', $shillingOptions);
    }

    public function postShippingOption(ShippingOptionRequest $request)
    {
        $orderData = Session::get('order_data');
        $orderData['shipping_method'] = $request->get('shipping_option');
        Session::put('order_data', $orderData);

        return redirect()->route('checkout.step.payment-option');
    }

    public function paymentOption()
    {
        $paymentOptions = Payment::all();

        return view('checkout.payment-option')
                ->with('paymentOptions', $paymentOptions);
    }

    public function postPaymentOption(PaymentOptionRequest $request)
    {
        $orderData = Session::get('order_data');
        $cartProducts = Session::get('cart');

        $paymentMethod = Payment::get($request->get('payment_option'));

        
        $redirectUrl = $paymentMethod->process($orderData, $cartProducts);
        $orderData['payment_method'] = $request->get('payment_option');

        Session::put('order_data', $orderData);

        if (null === $redirectUrl) {
            return redirect()->route('checkout.step.review');
        } else {
            return Redirect::to($redirectUrl);
        }
    }

    public function review()
    {
        $cartProducts = Session::get('cart');
        $orderData = Session::get('order_data');
        $shippingPrice = Shipping::get($orderData['shipping_method'])->getAmount();

        return view('checkout.review')
                        ->with('cartProducts', $cartProducts)
                        ->with('shippingPrice',$shippingPrice);
    }
}
