<?php

namespace Mage2\Dashboard\Controllers;

use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Catalog\Models\Product;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = new Product();
        $featureProducts = $product->getFeaturedProducts();
        return view('home.index')
            ->with('featuredProducts', $featureProducts);
    }
}
