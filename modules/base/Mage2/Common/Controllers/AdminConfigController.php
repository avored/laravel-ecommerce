<?php

namespace Mage2\Common\Controllers;

use Mage2\Framework\Http\Controllers\Controller;

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
        return view('admin.config.index');
    }
}
