<?php

namespace AvoRed\Promotion\Http\Controllers;

use AvoRed\Promotion\DataGrid\PromotionDataGrid;
use AvoRed\Promotion\Http\Requests\PromotionRequest;
use AvoRed\Promotion\Models\Database\Promotion;
use AvoRed\Framework\System\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * Display all Promotion datagrid
     *
     * @return \Illuminate\View\View $response
     */
    public function index()
    {
        $dataGrid = new PromotionDataGrid(Promotion::query());
        return view('avored-promotion::promotion.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Create a promotion for store product or cart
     *
     * @return \Illuminate\View\View $response
     */
    public function create()
    {
        return view('avored-promotion::promotion.create');
    }

    /**
     * Store promotion into a database and redirect back to list all page
     *
     * @return \Illuminate\Http\RedirectResponse $redirect
     */
    public function store(PromotionRequest $request)
    {
        Promotion::create($request->all());

        return redirect()->route('admin.promotion.index');
    }
}
