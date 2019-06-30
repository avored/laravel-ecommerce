<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Support\Facades\Payment;
use AvoRed\Framework\Support\Facades\Shipping;

class CheckoutController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * checkout controller construct
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $paymentOptions = Payment::all();
        $shippingOptions = Shipping::all();

        return view('checkout.show')
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions);
    }
}
