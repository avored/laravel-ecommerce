<?php

namespace Mage2\System\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
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
