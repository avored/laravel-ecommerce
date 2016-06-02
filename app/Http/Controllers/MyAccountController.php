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
        $user = Auth::guard('customer')->user();
        
        
        return view('my-account.index')->with('user', $user);
    }
    public function edit(){
        $user = Auth::guard('customer')->user();
        return view('my-account.edit')->with('user', $user);
    }
    public function update(Request $request){
        $user = Customer::findorfail(Auth::guard('customer')->user()->id);
        $user->update($request->all());
        return redirect('my-account');
    }
    
}
