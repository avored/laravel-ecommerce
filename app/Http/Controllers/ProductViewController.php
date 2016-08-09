<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CrazyCommerce\Admin\Models\Product;
use App\Http\Requests;

class ProductViewController extends Controller
{
    public function view($id) {
        $product = Product::findorfail($id);
        return view($this->theme . ".product.view")
                ->with('product', $product);
    }
}
