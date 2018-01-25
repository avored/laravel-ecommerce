<?php
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Mage2\Ecommerce\Payment\Facade as Payment;
use Mage2\Ecommerce\Shipping\Facade as Shipping;
use Mage2\Ecommerce\Models\Database\Country;

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
