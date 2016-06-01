<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MyAccountController extends Controller
{
    public function __construct() {
        $this->middleware('customer');
    }
    
    public function index(){
        return view('my-account.index');
    }
}
