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
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $configModel = Model::whereConfigurationKey($key)->first();

            if ($configModel->configuration_value == $value) {
                continue;
            }

            if (null === $configModel) {
             
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;

                Model::create($data);
            } else {
                $configModel->update(['configuration_value' => $value]);
            }
        }

        return redirect()->back()->with('notificationText', 'All Configuration saved!');
    }
}
