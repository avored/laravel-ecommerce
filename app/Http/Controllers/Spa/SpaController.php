<?php

namespace App\Http\Controllers\Spa;


class SpaController
{
    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('spa.index');
    }
}
