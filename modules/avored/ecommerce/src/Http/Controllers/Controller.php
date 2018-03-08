<?php
namespace AvoRed\Ecommerce\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use AvoRed\Ecommerce\Models\Database\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct()
    {
        if (Schema::hasTable('configurations')) {

            $path = realpath(Configuration::getConfiguration('active_theme_path'));

            $fileViewFinder = View::getFinder();
            $fileViewFinder->prependLocation($path);
        }
    }
}
