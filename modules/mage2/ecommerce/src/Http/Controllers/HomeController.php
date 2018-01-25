<?php
namespace Mage2\Ecommerce\Http\Controllers;

use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Models\Database\Page;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageModel = null;
        $pageId = Configuration::getConfiguration('general_home_page');


        if(null !== $pageId) {
            $pageModel = Page::find($pageId);
        }

        return view('home.index')->with('pageModel', $pageModel);

    }
}
