<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
 
    /**
     * Show the user account dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('account.dashboard');
    }
}
