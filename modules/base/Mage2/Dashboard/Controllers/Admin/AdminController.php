<?php

namespace Mage2\Dashboard\Controllers\Admin;

use Mage2\System\Controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('adminauth');
        
    }

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
