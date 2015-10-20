<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mage2\Core\Model\Category;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home() {
        $category = new Category();
        return view('front.cms.home');
    }
}
