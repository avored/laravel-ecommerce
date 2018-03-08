<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Payment\Facade as Payment;
use AvoRed\Ecommerce\Shipping\Facade as Shipping;
use AvoRed\Ecommerce\Models\Database\Country;

class CheckoutController extends Controller
{
    public function index()
    {

        $shippingOptions = Shipping::all();
        $paymentOptions = Payment::all();
        $countries = Country::getCountriesOptions();

        $cartItems = Session::get('cart');


        return view('checkout.index')
            ->with('cartItems', $cartItems)
            ->with('countries', $countries)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions);
    }

}
