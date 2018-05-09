<?php
namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Product;

class ProductViewController extends Controller
{

    public function view($slug)
    {
        $product = Product::whereSlug($slug)->first();

        $title          = (!empty($product->meta_title)) ?
                                            $product->meta_title :
                                            $product->name;

        $description    = (!empty($product->meta_description)) ?
                                        $product->meta_description :
                                        substr($product->description, 0, 255);

        return view('product.view')
                                ->with('product', $product)
                                ->with('title', $title)
                                ->with('description', $description);
    }

}
