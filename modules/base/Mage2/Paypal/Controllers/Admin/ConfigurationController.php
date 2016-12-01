<?php

namespace Mage2\Paypal\Controllers\Admin;

use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;

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

        return view('admin.paypal.configuration.index')
                ->with('configurations', $configurations);
    }
}
