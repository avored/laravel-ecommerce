<?php

namespace Mage2\System\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;

class DashboardController extends AdminController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
}
