<?php

namespace AvoRed\Promotion\Http\Controllers;

use AvoRed\Promotion\DataGrid\PromotionDataGrid;
use AvoRed\Promotion\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;
use AvoRed\Promotion\Models\Database\Promotion;
use AvoRed\Framework\System\Controllers\Controller;

class PromotionController extends Controller
{
    public function index() {

        $dataGrid = new PromotionDataGrid(Promotion::query());
        return view('avored-promotion::promotion.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    public function create() {

        return view('avored-promotion::promotion.create');
    }

    public function store(PromotionRequest $request) {

        PromotionModel::create($request->all());

        return redirect()->route('admin.promotion.index');
    }
}