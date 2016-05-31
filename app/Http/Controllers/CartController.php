<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {

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
