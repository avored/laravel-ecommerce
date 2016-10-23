<?php

namespace Mage2\Address\Controllers\Admin;

use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Configuration\Models\Configuration;
use Mage2\TaxClass\Models\Country;
use Illuminate\Database\Eloquent\Collection;

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
        $countries = $this->_getCountriesOptions();
        $configurations = Configuration::all()->pluck('configuration_value','configuration_key');
        return view('admin.address.configuration.index')
                ->with('configurations',$configurations)
                ->with('countries',$countries)
            ;
    }
    
    private function _getCountriesOptions() {
        $options = Collection::make([0 => 'Please Select'] + Country::getCountriesOptions()->toArray());
        return $options;
    }
    
   
}
