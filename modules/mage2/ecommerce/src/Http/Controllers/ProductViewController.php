<?php
namespace Mage2\Ecommerce\Http\Controllers;

use Mage2\Ecommerce\Models\Database\Product;

class ProductViewController extends Controller
{
    public function __construct() {
        $this->middleware(['product.viewed']);
    }
    public function view($slug)
    {
        $product = $this->_getProductBySlug($slug);

        $view = view('catalog.product.view')
            ->with('metaTitle', 'test')
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
