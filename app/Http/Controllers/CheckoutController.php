<?php
namespace App\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Country;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Shipping\Facade as Shipping;
use AvoRed\Framework\Cart\Facade as Cart;

class CheckoutController extends Controller
{


    public function index()
    {
        $cartItems          = Cart::all();
        $shippingOptions    = Shipping::all();
        $paymentOptions     = Payment::all();
        $countries          = Country::options();

        return view('checkout.index')
            ->with('cartItems', $cartItems)
            ->with('countries', $countries)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions);
    }

}
