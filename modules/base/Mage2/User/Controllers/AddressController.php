<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */


namespace Mage2\User\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\User\Models\Address;
use Mage2\User\Requests\AddressRequest;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\TaxClass\Models\Country;

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
        //$addresses = Address::where('user_id', '=', $user->id)->get();
        $addresses = Address::where('user_id', '=', $user->id)->get();

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
        $countries = Country::all();
        $defaultCountry = Configuration::getConfiguration('mage2_address_default_country');

        return view('address.my-account.create-address')
                        ->with('user', $user)
                        ->with('countries', $countries)
                        ->with('defaultCountry', $defaultCountry);
    }

    /**
     * Store a newly created user addresses in database.
     *
     * @param \Mage2\User\Requests\AddressRequest $request
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
     * Display the specified user addresses.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user addresses.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $address = Address::findorfail($id);

        $countries = Country::all();

        return view('address.my-account.edit-address')
                        ->with('user', $user)
                        ->with('address', $address)
                        ->with('countries', $countries);
    }

    /**
     * Update the specified user addresses in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = Address::findorfail($id);
        $address->update($request->all());

        return redirect()->route('my-account.address.index');
    }

    /**
     * Remove the specified user address from database.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::destroy($id);

        return redirect()->route('my-account.address.index');
    }
}
