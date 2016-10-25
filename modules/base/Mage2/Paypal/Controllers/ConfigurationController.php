<?php

namespace Mage2\Paypal\Controllers;

use Mage2\Configuration\Models\Configuration;
use Mage2\Framework\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Catalog Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfiguration()
    {
        $configurations = Configuration::all()->pluck('configuration_value', 'configuration_key');

        return view('paypal.admin.configuration.index')
                ->with('configurations', $configurations);
    }
}
