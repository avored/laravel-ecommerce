<?php

namespace Mage2\TaxClass\Controllers\Admin;

use Mage2\Configuration\Models\Configuration;
use Mage2\System\Controllers\AdminController;

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

        return view('admin.tax-class.configuration.index')
                ->with('configurations', $configurations);
    }
}
