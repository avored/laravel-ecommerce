<?php

namespace Mage2\Common\Controllers;

use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Framework\View\Facades\AdminConfiguration;

class AdminConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminauth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = AdminConfiguration::getAll();

        return view('admin.config.index')->with('configs',$configs);
    }
}
