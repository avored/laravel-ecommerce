<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Customer;
class MyAccountController extends Controller
{
    public function __construct() {
        
        
        $this->middleware('customerauth');
    }
    
    public function index(){
        $customer = Customer::findorfail( Auth::guard('customer')->user()->id);

        return view('my-account.index')->with('customer', $customer);
    }
    public function edit(){
        $customer = Customer::findorfail( Auth::guard('customer')->user()->id);
        return view('my-account.edit')->with('customer', $customer);
    }
    public function update(Request $request){
        $user = Customer::findorfail(Auth::guard('customer')->user()->id);
        $user->update($request->all());
        return redirect('my-account');
    }

    public function addressCreate() {

        $customer = Customer::findorfail( Auth::guard('customer')->user()->id);
        return view('my-account.create-address')->with('customer', $customer);
    }

    public function addressStore(Request $request) {
        $customer = Customer::findorfail( Auth::guard('customer')->user()->id);
        $request->merge(['customer_id' => $customer->id]);

        Address::create($request->all());
        return redirect('/my-account');
    }
    
    
    public function addressEdit($id) {
        
         $customer = Customer::findorfail( Auth::guard('customer')->user()->id);
         $address = Address::findorfail($id);
        return view('my-account.edit-address')
                    ->with('customer', $customer)
                    ->with('address', $address)
                    ;
        
    }
    public function addressUpdate($id , Request $request) {
        
         $customer = Customer::findorfail( Auth::guard('customer')->user()->id);
         $address = Address::findorfail($id);
         $address->update($request->all());
        return redirect('/my-account');
        
    }
}
