<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Modules\Facade as Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();

        return view('avored-ecommerce::module.index')
            ->with('modules', $modules);
    }

    /**
     * Display a listing of the modules.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($identifier)
    {
        $module = Module::get($identifier);

        return view('avored-ecommerce::module.show')
            ->with('module', $module);
    }
}
