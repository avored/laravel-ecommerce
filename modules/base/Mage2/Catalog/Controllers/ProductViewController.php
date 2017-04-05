<?php

namespace Mage2\Catalog\Controllers;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVarcharValue;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Controllers\Controller;

class ProductViewController extends Controller
{
    public function view($slug)
    {
        $product = $this->_getProductBySlug($slug);


        $view = view('catalog.product.view')
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
        $product = Product::where('slug', '=', $slug)->get()->first();

        return $product;
    }
}
