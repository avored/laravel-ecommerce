<?php

namespace Mage2\Catalog\Controllers;

use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Attribute\Models\ProductVarcharValue;
use Mage2\Catalog\Models\Product;
use Mage2\System\Controllers\Controller;

class ProductViewController extends Controller
{
    public function view($slug)
    {
        $product = $this->_getProductBySlug($slug);


        $view = view('product.view')
                ->with('product', $product);

        $title = $product->page_title;
        $description = $product->page_description;

        if ($title != '') {
            $view->with('title', $title);
        }
        if ($description != '') {
            $view->with('description', $description);
        }

        return $view;
    }

    private function _getProductBySlug($slug)
    {
        $slugAttribute = ProductAttribute::where('identifier', '=', 'slug')->get()->first();
        $productVarcharValue = ProductVarcharValue::where('product_attribute_id', '=', $slugAttribute->id)
                                                ->where('value', '=', $slug)
                                                ->where('website_id', '=', $this->websiteId)->get()->first();


        $product = Product::findorfail($productVarcharValue->product_id);

        return $product;
    }
}
