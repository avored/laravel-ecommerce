<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CrazyCommerce\Admin\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class CartController extends Controller
{
    public function addToCart($id) {
        $cart = Session::get('cart');
        $product = Product::findorfail($id);
        
        if(isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart [$id] = ['id' => $id,
                            'qty' => 1,
                            'price' => $product->price,
                            'model' => $product,
                        ];
            
        }
        Session::put('cart',$cart);
        
        return redirect()->back();
    }
    
    public function view() {
        
        $cartProducts = Session::get('cart');
        return view($this->theme. ".cart.view")
                ->with('cartProducts', $cartProducts)
                ;
    }
    
    public function update(Request $request) {
        $cartData = Session::get('cart');
        
        if($request->get('qty') == 0) {
            unset($cartData[$request->get('id')]);
        } else {
            $cartData[$request->get('id')] ['qty'] = $request->get('qty');
        }
        Session::put('cart', $cartData);
        return redirect()->back();
    }
    public function destroy($id) {
        $cartData = Session::get('cart');
        unset($cartData[$id]);
        
        Session::put('cart', $cartData);
        return redirect()->back();
    }
}
