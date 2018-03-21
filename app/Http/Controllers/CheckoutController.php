<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Repository\User;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Shipping\Facade as Shipping;
use AvoRed\Framework\Cart\Facade as Cart;

class CheckoutController extends Controller
{
    /**
     * AvoRed Product Repository
     *
     * @var \AvoRed\Ecommerce\Repository\User
     */
    protected $userRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\User $repository
     * @return void
     */
    public function __construct(User $repository)
    {
        $this->userRepository = $repository;
    }


    public function index()
    {
        $cartItems          = Cart::all();
        $shippingOptions    = Shipping::all();
        $paymentOptions     = Payment::all();
        $countries          = $this->userRepository->countryOptions();

        return view('checkout.index')
            ->with('cartItems', $cartItems)
            ->with('countries', $countries)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions);
    }

}
