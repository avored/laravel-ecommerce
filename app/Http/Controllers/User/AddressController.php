<?php

namespace App\Http\Controllers\User;

use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use AvoRed\Framework\Models\Database\Address;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
      * Display a listing of the user addresses.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $user = Auth::user();
        $addresses = Address::whereUserId($user->id)->get();
        return view('address.my-account.address')
            ->with('user', $user)
            ->with('addresses', $addresses);
    }

    /**
     * Show the form for creating a new user addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $countries = Country::options();
        $defaultCountry = Configuration::getConfiguration('user_default_country');

        return view('address.my-account.create-address')
            ->with('user', $user)
            ->with('countries', $countries)
            ->with('defaultCountry', $defaultCountry);
    }

    /**
     * Store a newly created user addresses in database.
     *
     * @param \App\Http\Requests\AddressRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        Address::create($request->all());

        return redirect()->route('my-account.address.index');
    }

    /**
     * Show the form for editing the specified user addresses.
     *
     * @param \AvoRed\Framework\Models\Database\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address  $address)
    {
        $user = Auth::user();
        $defaultCountry = Configuration::getConfiguration('user_default_country');
        $countries = Country::options();

        return view('address.my-account.edit-address')
            ->with('user', $user)
            ->with('model', $address)
            ->with('defaultCountry', $defaultCountry)
            ->with('countries', $countries);
    }

    /**
     * Update the specified user addresses in database.
     *
     * @param \App\Http\Requests\AddressRequest $request
     * @param \AvoRed\Framework\Models\Database\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->all());
        return redirect()->route('my-account.address.index');
    }
}
