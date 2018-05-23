<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Country;
use Illuminate\Http\Request;
use AvoRed\Ecommerce\Models\Database\Page;
use AvoRed\Framework\Models\Database\Configuration as Model;

class ConfigurationController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Model();
        $pageOptions = Page::Options();
        $countryOptions = Country::options();

        return view('avored-ecommerce::configuration.index')
                            ->with('model', $model)
                            ->with('pageOptions', $pageOptions)
                            ->with('countryOptions', $countryOptions);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $configuration = Model::getConfiguration($key);

            if (null === $configuration) {
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;

                Model::create($data);
            } else {
                Model::whereConfigurationKey($key)->first()->update(['configuration_value' => $value]);
            }
        }

        return redirect()->back()->with('notificationText', 'All Configuration saved!');
    }
}
