<?php

namespace Mage2\Catalog\Controllers;

use Illuminate\Support\Collection;

use Mage2\Catalog\Models\Category;
use Mage2\Catalog\Requests\CategoryRequest;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Common\Models\Configuration;

class ConfigurationController extends Controller
{
  
    public function __construct(){
      
        parent::__construct();
    }
    /**
     * Display a listing of the Catalog Configuration
     * @return \Illuminate\Http\Response
     */
    public function getConfiguration()
    {
        $configurations = Configuration::all()->pluck('configuration_value','configuration_key');
        return view('catalog.admin.configuration.index')
                ->with('configurations',$configurations)
            ;
    }

    /**
     * Stora the Catalog Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $request->all();
    }
}
