<?php

namespace App\Http\Controllers;

use Mage2\Admin\Eloquents\Models\ProductAttribute;
use Mage2\Admin\Eloquents\Models\ProductVarcharValue;
use Illuminate\Http\Request;
use Mage2\Admin\Eloquents\Models\Product;
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
