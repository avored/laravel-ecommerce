<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('product.index')->with('products' , $products);
    }

    public function create() {

        return view('product.create');
    }

    public function store(Request $request) {
        $product = Product::create($request->all());
        return redirect('/admin/product');

    }


    public function edit($id) {
        $product = Product::findorfail($id);
        return view('product.edit')->with('product', $product);
    }

    public function update(Request $request, $id) {
        $product = Product::findorfail($id);
        $product->update($request->all());
        return redirect('/admin/product');
    }

    public function destroy($id) {
        Product::destroy($id);
        return redirect('/admin/product');
    }

}
