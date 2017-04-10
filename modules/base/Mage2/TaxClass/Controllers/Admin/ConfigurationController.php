<?php

namespace Mage2\TaxClass\Controllers\Admin;

use Illuminate\Support\Collection;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\TaxClass\Models\Country;

class ConfigurationController extends AdminController
{
   

    /**
     * Display a listing of the Catalog Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfiguration()
    {
        $configurations = Configuration::all()->pluck('configuration_value', 'configuration_key');
        $countryOptions =  Collection::make(['' =>  'Please Select'] + Country::all()->pluck('name','id')->toArray());


        return view('mage2taxclass::admin.tax-class.configuration.index')
                ->with('configurations', $configurations)
                ->with('countryOptions', $countryOptions);
    }
}
