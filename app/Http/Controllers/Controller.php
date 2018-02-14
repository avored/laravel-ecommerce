<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Mage2\Ecommerce\Models\Database\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        if (Schema::hasTable('configurations')) {

            $path = realpath(Configuration::getConfiguration('active_theme_path'));

            $fileViewFinder = View::getFinder();
            $fileViewFinder->prependLocation($path);
        }
    }
}


