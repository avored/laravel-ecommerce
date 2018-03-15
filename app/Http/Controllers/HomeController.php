<?php
namespace App\Http\Controllers;

use AvoRed\Ecommerce\Repository\Config;
use AvoRed\Ecommerce\Repository\Page;

class HomeController extends Controller
{


    /**
     * AvoRed Product Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Page
     */
    protected $pageRepository;

    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Config
     */
    protected $configRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\Page $repository
     * @param \AvoRed\Ecommerce\Repository\Config $configRepository
     * @return void
     */
    public function __construct(Page $repository, Config $configRepository)
    {
        $this->pageRepository   = $repository;
        $this->configRepository = $configRepository;
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageModel = null;
        $pageId = $this->configRepository->model()->getConfiguration('general_home_page');


        if(null !== $pageId) {
            $pageModel = $this->pageRepository->model()->find($pageId);
        }

        return view('home.index')->with('pageModel', $pageModel);

    }
}
