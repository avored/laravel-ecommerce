<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Country;
use Illuminate\Http\Request;
use AvoRed\Ecommerce\Models\Database\Page;
use AvoRed\Framework\Models\Database\Configuration as Model;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class ConfigurationController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $repository;

    public function __construct(ConfigurationInterface $repository)
    {
        $this->repository = $repository;
    }

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
            $configModel = $this->repository->findByKey($key);

            if (null === $configModel) {
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;

                $this->repository->create($data);
            } else {
                $configModel->update(['configuration_value' => $value]);
            }
        }

        return redirect()->back()->with('notificationText', 'All Configuration saved!');
    }
}
