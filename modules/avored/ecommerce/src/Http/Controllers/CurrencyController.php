<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use AvoRed\Ecommerce\Models\Database\Country;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the currency resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('avored-ecommerce::currency.index');
    }

}
