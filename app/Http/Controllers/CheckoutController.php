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
        
        $orderData = collect($request->except('_token'));
        Session::put('orders',$orderData->all());
        return view('checkout.step2')->with('orderData', $orderData);
    }
    public function step3(Request $request) {
        $orderData = Session::get('orders');
        $request->merge($orderData);
                
        $orderData = $request->except(['_token']);
        Session::put('orders' , $orderData);
        return view('checkout.step3')->with('orderData', $orderData);
    }
    public function step4(Request $request) {
        $orderData = Session::get('orders');
        $request->merge($orderData);
        $orderData = $request->except(['_token']);
        Session::put('orders',$orderData);
        return view('checkout.step4')->with('orderData', $orderData);
    }
    public function step5(Request $request) {
        $orderData = Session::get('orders');
        $request->merge($orderData);
        $orderData = $request->except(['_token']);
        Session::put('orders',$orderData);
        return view('checkout.step5')->with('orderData', $orderData);
    }
    public function step6(Request $request) {
        $orderData = Session::get('orders');
        $products = Session::get('products');
        $request->merge($orderData);
        $orderData = $request->except(['_token']);
        Session::put('orders',$orderData);
        return view('checkout.step6')
                ->with('orderData', $orderData)
                ->with('products', $products)
                ;
    }
    
    public function step7(Request $request) {
        $orderData = Session::get('orders');
        var_dump($orderData);die;
        
        
        
    }
}
