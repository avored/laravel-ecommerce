<?php

namespace Mage2\Address\Controllers;

use Mage2\Address\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
use Mage2\Address\Models\Address;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\TaxClass\Models\Country;
use Mage2\Configuration\Models\Configuration;

class AddressController extends Controller {

   

    /**
     * Display a listing of the user addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        //$addresses = Address::where('user_id', '=', $user->id)->get();
        $addresses = Address::where('user_id', '=', $user->id)->get();
        return view("address.my-account.address")
                        ->with('user', $user)
                        ->with('addresses', $addresses)
        ;
    }

    /**
     * Show the form for creating a new user addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = Auth::user();
        $countries = Country::all();
        $defaultCountry = Configuration::getConfiguration("mage2_address_default_country");
        
        return view("address.my-account.create-address")
                        ->with('user', $user)
                        ->with('countries', $countries)
                        ->with('defaultCountry', $defaultCountry)
        ;
    }

    /**
     * Store a newly created user addresses in database.
     *
     * @param  \Mage2\Address\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request) {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        Address::create($request->all());

        return redirect()->route('my-account.address.index');
    }

    /**
     * Display the specified user addresses.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified user addresses.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = Auth::user();
        $address = Address::findorfail($id);

        $countries = Country::all();
        return view("address.my-account.edit-address")
                        ->with('user', $user)
                        ->with('address', $address)
                        ->with('countries', $countries)
            ;
    }

    /**
     * Update the specified user addresses in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id) {
        $address = Address::findorfail($id);
        $address->update($request->all());
        
        return redirect()->route('my-account.address.index');
    }

    /**
     * Remove the specified user address from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Address::destroy($id);
        return redirect()->route('my-account.address.index');
    }

}
