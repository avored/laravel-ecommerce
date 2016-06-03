<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class CheckoutController extends Controller
{
    public function step1() {
        Session::forget('orders');
        return view('checkout.step1');
    }
    
    public function step2(Request $request) {
        
        $orderData = collect(Session::get('orders'));
        $orderData->merge($request->except('_token'));
        Session::put('orders',$orderData->all());
        return view('checkout.step2')->with('orderData', $orderData);
    }
    public function step3(Request $request) {
        $orderData = collect(Session::get('orders'));
        //var_dump($request->except(['_token']));die;
        $orderData->merge(['test' => 'test1']);
        var_dump($orderData->all());die;
        Session::put('orders' , $orderData->all());
        return view('checkout.step3')->with('orderData', $orderData);
    }
    public function step4(Request $request) {
        $orderData = Session::get('orders');
        $orderData = $request->except(['_token']);
        var_dump($orderData);die;
        Session::put('orders',$orderData);
        return view('checkout.step3')->with('orderData', $orderData);
    }
}
