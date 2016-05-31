<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    public function index() {

        $sessionProducts = Session::get('products');
        return view('cart.index')->with('products', $sessionProducts);
    }

    public function action(Request $request){
        $sessionProducts = Session::get('products');
        
        if(null !== $request->get('update') ) {
            $sessionProducts[$request->get('id')]['qty'] = $request->get('qty');
        }
        if(null !== $request->get('delete') ) {
            unset($sessionProducts[$request->get('id')]);
        }
        
        Session::put('products', $sessionProducts);
        return redirect('/cart');
    }

    public function addToCart($id) {

        $product = Product::findorfail($id);
        $sessionProducts = Session::get('products');

        if (isset($sessionProducts[$id])) {
            $sessionProducts[$id]['qty'] += 1;
        } else {
            $data = ['id' => $id, 'title' => $product->title, 'price' => $product->price, 'qty' => 1];
            $sessionProducts[$id] = $data;
        }

        Session::put('products', $sessionProducts);

        return redirect()->back();
    }

}
