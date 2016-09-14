<?php

namespace Mage2\Catalog\Controllers;

use Mage2\Catalog\Models\Category;
use Mage2\Framework\Http\Controllers\Controller;

class CategoryViewController extends Controller
{


    public function __construct(){

        parent::__construct();
    }

    public function view($slug) {

        $category = Category::where('slug','=',$slug)->get()->first();

        return view('category.view')
                    ->with('category', $category)
            ;

    }
}
