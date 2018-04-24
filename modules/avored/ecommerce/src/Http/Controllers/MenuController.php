<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Http\Controllers\Admin\AdminController;
use AvoRed\Framework\Models\Database\Category;

class MenuController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('avored-ecommerce::menu.index')
                    ->with('categories', $categories);
    }

}
