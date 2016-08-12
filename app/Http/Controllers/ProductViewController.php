<?php

namespace App\Http\Controllers;

use CrazyCommerce\Admin\Models\ProductAttribute;
use CrazyCommerce\Admin\Models\ProductVarcharValue;
use Illuminate\Http\Request;
use CrazyCommerce\Admin\Models\Product;
use App\Http\Requests;

class ProductViewController extends Controller
{
    public function view($slug) {

        $product = $this->_getProductBySlug($slug);

        return view($this->theme . ".product.view")
                ->with('product', $product);
    }

    private function _getProductBySlug($slug) {
        $slugAttribute = ProductAttribute::where('identifier','=','slug')->get()->first();
        $productVarcharValue = ProductVarcharValue::where('product_attribute_id','=', $slugAttribute->id)
                                                ->where('website_id','=', $this->websiteId)->get()->first();

        $product = Product::findorfail($productVarcharValue->product_id);
        return $product;
    }
}
