<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Mage2\Admin\Models\Product;
use Illuminate\Http\Request;
use Mage2\Admin\Shipping\Facade\Shipping;

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
        return view($this->theme . '.home')
                ->with('featuredProducts', $featureProducts);
    }
}
