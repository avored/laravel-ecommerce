<?php
namespace App\Http\Controllers;

use AvoRed\Ecommerce\Repository\Config;
use AvoRed\Ecommerce\Repository\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AddressRequest;


class AddressController extends Controller
{

    /**
     * AvoRed Product Repository
     *
     * @var \AvoRed\Ecommerce\Repository\User
     */
    protected $userRepository;

    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Config
     */
    protected $configRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\User $repository
     * @param \AvoRed\Ecommerce\Repository\Config $configRepository
     * @return void
     */
    public function __construct(User $repository, Config $configRepository)
    {
        $this->userRepository   = $repository;
        $this->configRepository = $configRepository;
    }



    /**
     * Display a listing of the user addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $addresses = $this->userRepository->allUserAddresses($user->id);

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
        $user           = Auth::user();
        $countries      = $this->userRepository->countryOptions();
        $defaultCountry = $this->configRepository->getConfiguration('avored_address_default_country');

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
        $this->userRepository->createUserAddress($request->all());

        return redirect()->route('my-account.address.index');
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
        $address        = $this->userRepository->findAddress($id);
        $defaultCountry = $this->configRepository->getConfiguration('avored_address_default_country');
        $countries      = $this->userRepository->countryOptions();


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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = $this->userRepository->findAddress($id);
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
        $this->userRepository->destroyUserAddress($id);

        return redirect()->route('my-account.address.index');
    }

}
