<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use AvoRed\Ecommerce\Repository\Config;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Config
     */
    protected $configRepository;


    public function __construct(Config $repository)
    {
        if (Schema::hasTable('configurations')) {

            $this->configRepository = $repository;

            $themeViewPath = realpath($this->configRepository->model()->getConfiguration('active_theme_path'));

            $fileViewFinder = View::getFinder();
            $fileViewFinder->prependLocation($themeViewPath);
        }
    }
}


