<?php

namespace Mage2\TaxClass\Controllers;

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
        return view('tax-class.admin.configuration.index')
                ->with('configurations',$configurations)
            ;
    }
}
