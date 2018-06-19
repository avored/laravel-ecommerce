<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Ecommerce\DataGrid\SiteCurrencyDataGrid;
use AvoRed\Ecommerce\Http\Requests\SiteCurrencyRequest;



class SiteCurrencyController extends Controller
{
    /**
     * 
     * @var \AvoRed\Ecommerce\Models\Repository\SiteCurrencyRepository
     */
    protected $repository;

    public function __construct(SiteCurrencyInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteCurrencyGrid = new SiteCurrencyDataGrid($this->repository->query());

        return view('avored-ecommerce::site-currency.index')->with('dataGrid', $siteCurrencyGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::site-currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\SiteCurrencyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SiteCurrencyRequest $request)
    {

        $this->repository->create($request->all());

        return redirect()->route('admin.site-currency.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Ecommerce\Models\Database\SiteCurrency $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repository->find($id);
        return view('avored-ecommerce::site-currency.edit')
                    ->with('model', $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\SiteCurrencyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SiteCurrencyRequest $request, $id)
    {  
       
        $siteCurrency = $this->repository->find($id);
        $siteCurrency->update($request->all());

        return redirect()->route('admin.site-currency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siteCurreny = $this->repository->find($id);
        $siteCurreny->delete();
        return redirect()->route('admin.site-currency.index');
    }

}
