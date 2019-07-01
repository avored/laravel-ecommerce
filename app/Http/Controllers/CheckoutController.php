<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Support\Facades\Payment;
use AvoRed\Framework\Support\Facades\Shipping;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;

class CheckoutController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * checkout controller construct
     */
    public function __construct(CountryModelInterface $countryRepository)
    {
        $this->CountryRepository = $countryRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $paymentOptions = Payment::all();
        $shippingOptions = Shipping::all();
        $countryOptions = $this->CountryRepository->options();

        return view('checkout.show')
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions)
            ->with('countryOptions', $countryOptions);
    }
}
