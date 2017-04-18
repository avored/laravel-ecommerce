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
            //$user = Auth::user();

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

}
