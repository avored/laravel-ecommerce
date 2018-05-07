<?php

namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AvoRed\Ecommerce\Repository\Page;
use AvoRed\Ecommerce\Repository\User;
use AvoRed\Ecommerce\Repository\Config;

class ConfigurationController extends AdminController
{
    /**
     * AvoRed Product Repository.
     *
     * @var \AvoRed\Ecommerce\Repository\User
     */
    protected $userRepository;

    /**
     * AvoRed Config Repository.
     *
     * @var \AvoRed\Ecommerce\Repository\Config
     */
    protected $configRepository;

    /**
     * AvoRed Config Repository.
     *
     * @var \AvoRed\Ecommerce\Repository\Page
     */
    protected $pageRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\User $repository
     * @param \AvoRed\Ecommerce\Repository\Config $configRepository
     * @param \AvoRed\Ecommerce\Repository\Page $pageRepository
     * @return void
     */
    public function __construct(User $repository, Config $configRepository, Page $pageRepository)
    {
        $this->userRepository = $repository;
        $this->configRepository = $configRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->configRepository->model();
        $pageOptions = $this->pageRepository->pageOptions();
        $countryOptions = $this->userRepository->countryOptions();

        return view('avored-ecommerce::admin.configuration.index')
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
            $configuration = $this->configRepository->findConfigurationByKey($key);

            if (null === $configuration) {
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;

                $this->configRepository->model()->create($data);
            } else {
                $configuration->update(['configuration_value' => $value]);
            }
        }

        return redirect()->back()->with('notificationText', 'All Configuration saved!');
    }
}
