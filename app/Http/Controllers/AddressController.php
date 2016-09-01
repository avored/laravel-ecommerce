<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Mage2\Admin\Eloquents\Repository\AddressRepository;
use Mage2\Admin\Eloquents\Models\Address;
class AddressController extends Controller {

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    public function __construct(AddressRepository $repository){
        $this->addressRepository = $repository;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        //$addresses = Address::where('user_id', '=', $user->id)->get();
        $addresses = $this->addressRepository->getAllByUserId($user->id); //Address::where('user_id', '=', $user->id)->get();
        return view("my-account.address")
                        ->with('user', $user)
                        ->with('addresses', $addresses)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = Auth::user();
        return view("my-account.create-address")
                        ->with('user', $user)
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request) {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);
        $this->addressRepository->create($request->all());

        return redirect()->route('my-account.address.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = Auth::user();
        $address = $this->addressRepository->findorfail($id);

        return view("my-account.edit-address")
                        ->with('user', $user)
                        ->with('address', $address)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id) {
        $address = $this->addressRepository->findorfail($id);
        $address->update($request->all());
        
        return redirect()->route('my-account.address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Address::destroy($id);
        return redirect()->route('my-account.address.index');
    }

}
