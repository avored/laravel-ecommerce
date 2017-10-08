<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Mage2\Ecommerce\Models\Database\Configuration;

class AdminController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;


}
