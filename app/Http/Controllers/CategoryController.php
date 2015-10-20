<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mage2\Core\Model\Category;

class CategoryController extends Controller
{
    public function view($slug) {


        $model = new Category();
        $category = $model->where('slug' , '=' , $slug)->get()->first();
        return view('front.category.view')->with('category', $category);
    }
}
