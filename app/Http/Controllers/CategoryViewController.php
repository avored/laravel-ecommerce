<?php

namespace App\Http\Controllers;

use Mage2\Admin\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryViewController extends Controller
{
    public function view($slug) {

        $category = Category::where('slug','=',$slug)->get()->first();

        return view($this->theme. '.category.view')
                    ->with('category', $category)
            ;

    }
}
