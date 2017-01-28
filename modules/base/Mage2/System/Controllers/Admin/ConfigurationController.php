<?php

namespace Mage2\System\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;

class ConfigurationController extends AdminController
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = AdminConfiguration::all();

        return view('mage2system::admin.configuration.index')->with('configurations', $configurations);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $configuration = Configuration::where('configuration_key', '=', $key)->get()->first();

            if (null === $configuration) {
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;
                $data['website_id'] = $this->websiteId;


                Configuration::create($data);


            } else {
                $configuration->update(['configuration_value' => $value]);
            }
        }


        return redirect()->back()->with('notificationText', 'All Configuration saved.');
    }

    /**
     * Display a Paypal Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGeneralConfiguration()
    {
        $configurations = Configuration::all()->pluck('configuration_value', 'configuration_key');

        return view('mage2system::admin.configuration.general-configuration')
            ->with('configurations', $configurations);
    }
}
