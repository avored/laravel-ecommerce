<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Support\Facades\Payment;
use AvoRed\Framework\Support\Facades\Shipping;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\AddressRepository
     */
    protected $addressRepository;

    /**
     * checkout controller construct.
     */
    public function __construct(
        CountryModelInterface $countryRepository,
        AddressModelInterface $addressRepository
    ) {
        $this->CountryRepository = $countryRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $addresses = Collection::make([]);
        if (Auth::guard('customer')->check()) {
            $addresses = $this->addressRepository->getByCustomerId(Auth::guard('customer')->user()->id);
        }

        $paymentOptions = Payment::all();
        $shippingOptions = Shipping::all();
        $countryOptions = $this->CountryRepository->options();

        return view('checkout.show')
            ->with(compact('shippingOptions', 'paymentOptions', 'addresses', 'countryOptions'));
    }
}
