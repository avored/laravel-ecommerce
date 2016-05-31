<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class OrderController extends Controller {

    public function index() {

        $sessionProducts = Session::get('products');
        return view('order.index')->with('products', $sessionProducts);
    }

}
