<?php

namespace Mage2\TaxClass\Controllers;


use Mage2\TaxClass\Models\TaxClass;
use Mage2\TaxClass\Requests\TaxClassRequest;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\TaxClass\Models\Country;
class TaxClassController extends Controller
{

    public function __construct(){
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxClasses = TaxClass::paginate(10);
        return view('tax-class.index')
                ->with('taxClasses' , $taxClasses)
                ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax-class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaxClassRequest  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxClass = TaxClass::findorfail($id);
        return view('tax-class.edit')
                    ->with('taxClass', $taxClass)
                    ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TaxClassRequest  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TaxClass::destroy($id);

        return redirect()->route('admin.tax-class.index');
    }
}
