<?php

namespace Mage2\System\Controllers;

use Mage2\Catalog\Models\Product;
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
        return view('home.index')
            ;
    }
}
