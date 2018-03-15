<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Ecommerce\Http\Requests\AddressRequest;
use AvoRed\Ecommerce\Repository\User;

class AddressController extends Controller
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



    /**
     * Display a listing of the user addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $addresses = $this->userRepository->addressModel()->where('user_id', '=', $user->id)->get();

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
        $countries = $this->userRepository->countryModel()->all();
        $defaultCountry = Configuration::getConfiguration('avored_address_default_country');

        return view('address.my-account.create-address')
            ->with('user', $user)
            ->with('countries', $countries)
            ->with('defaultCountry', $defaultCountry);
    }

    /**
     * Store a newly created user addresses in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\AddressRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $this->userRepository->addressModel()->create($request->all());

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
        $user           = Auth::user();
        $address        = $this->userRepository->addressModel()->findorfail($id);
        $defaultCountry = Configuration::getConfiguration('avored_address_default_country');
        $countries      = $this->userRepository->countryModel()->all();

        return view('address.my-account.edit-address')
            ->with('user', $user)
            ->with('model', $address)
            ->with('defaultCountry', $defaultCountry)
            ->with('countries', $countries);
    }

    /**
     * Update the specified user addresses in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\AddressRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = $this->userRepository->addressModel()->findorfail($id);
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
        $this->userRepository->addressModel()->destroy($id);

        return redirect()->route('my-account.address.index');
    }
}
