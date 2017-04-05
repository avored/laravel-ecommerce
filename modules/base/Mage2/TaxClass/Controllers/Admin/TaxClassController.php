<?php

namespace Mage2\TaxClass\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\TaxClass\Models\TaxClass;
use Mage2\TaxClass\Requests\TaxClassRequest;

class TaxClassController extends AdminController
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxClasses = TaxClass::paginate(10);

        return view('admin.tax-class.index')
                ->with('taxClasses', $taxClasses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tax-class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TaxClassRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxClassRequest $request)
    {
        TaxClass::create($request->all());

        return redirect()->route('admin.tax-class.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxClass = TaxClass::findorfail($id);

        return view('admin.tax-class.edit')
                    ->with('taxClass', $taxClass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\TaxClassRequest $request
     * @param int                                $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxClassRequest $request, $id)
    {
        $taxClass = TaxClass::findorfail($id);
        $taxClass->update($request->all());

        return redirect()->route('admin.tax-class.index');
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
        TaxClass::destroy($id);

        return redirect()->route('admin.tax-class.index');
    }
}
