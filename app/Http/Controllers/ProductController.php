<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(10);
        return view('product.index')->with('products' , $products);
    }
}
