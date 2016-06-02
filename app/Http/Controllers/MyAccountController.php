<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Customer;
class MyAccountController extends Controller
{
    public function __construct() {
        $this->middleware('customer');
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
    
}
