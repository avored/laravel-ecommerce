<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mage2\HelloWrld\Components\Todo;
use Mage2\HelloWrld\HelloWorld;

class IndexController extends Controller
{
    public function index() {

        $helloWorld  = new HelloWorld();
        $hello = $helloWorld->helloworld();
        return view('admin.index.index')->with('hello', $hello);
    }

}
