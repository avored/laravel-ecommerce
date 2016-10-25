<?php

namespace Mage2\Configuration\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Configuration\Models\Configuration;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Framework\View\Facades\AdminConfiguration;

class ConfigurationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminauth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = AdminConfiguration::getAll();

        return view('admin.config.index')->with('configs', $configs);
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
}
