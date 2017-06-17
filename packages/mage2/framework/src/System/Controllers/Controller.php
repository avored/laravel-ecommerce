<?php

namespace Mage2\Framework\System\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mage2\System\Models\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    //public $theme;

    public function __construct()
    {
        if (Schema::hasTable('configurations')) {
            $path = realpath(Configuration::getConfiguration('active_theme_path'));
            View::addLocation($path);
        }

    }
}
