<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Ecommerce\Configuration\Facade as AdminConfiguration;
use AvoRed\Ecommerce\Models\Database\Page;
use Illuminate\Support\Collection;
use AvoRed\Ecommerce\Models\Database\Country;

class ConfigurationController extends AdminController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model = new Configuration();
        $pageOptions = Collection::make(['' => 'Please Select'] + Page::all()->pluck('name', 'id')->toArray());
        $countryOptions = Country::getCountriesOptions($empty = true);

        return view('avored-ecommerce::admin.configuration.index')
            ->with('model', $model)
            ->with('pageOptions', $pageOptions)
            ->with('countryOptions',$countryOptions)
            ;
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

                Configuration::create($data);


            } else {
                $configuration->update(['configuration_value' => $value]);
            }
        }


        return redirect()->back()->with('notificationText', 'All Configuration saved.');
    }

}
