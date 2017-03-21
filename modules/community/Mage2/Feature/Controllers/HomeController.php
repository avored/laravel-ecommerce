<?php

namespace Mage2\Feature\Controllers;

use Mage2\Feature\Helpers\FeatureProductHelper;
use Mage2\Framework\System\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helper = new FeatureProductHelper();
        $featureProducts = $helper->getFeaturedProducts();

       
        return view('home.index')
            ->with('featuredProducts', $featureProducts);
    }
}
