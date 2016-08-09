<?php

namespace App\Http\Controllers;

use CrazyCommerce\Admin\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryViewController extends Controller
{
    public function view($id) {

        $category = Category::findorfail($id);

        return view($this->theme. '.category.view')
                    ->with('category', $category)
            ;

    }
}
