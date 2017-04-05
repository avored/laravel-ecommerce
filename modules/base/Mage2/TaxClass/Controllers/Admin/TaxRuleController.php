<?php

namespace Mage2\TaxClass\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\TaxClass\Models\TaxRule;
use Mage2\TaxClass\Requests\TaxRuleRequest;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class TaxRuleController extends AdminController
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $taxRules = TaxRule::paginate(10);

        return view('mage2taxclass::admin.tax-rule.index')
                ->with('taxRules', $taxRules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2taxclass::admin.tax-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\TaxClass\Requests\TaxRuleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRuleRequest $request)
    {
        TaxRule::create($request->all());

        return redirect()->route('admin.tax-rule.index');
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
        $taxRule = TaxRule::findorfail($id);

        return view('mage2taxclass::admin.tax-rule.edit')
                    ->with('taxRule', $taxRule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\TaxClass\Requests\TaxRuleRequest $request
     * @param int                                $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRuleRequest $request, $id)
    {
        $taxRule = TaxRule::findorfail($id);
        $taxRule->update($request->all());

        return redirect()->route('admin.tax-rule.index');
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
        TaxRule::destroy($id);

        return redirect()->route('mage2taxclass::admin.tax-rule.index');
    }
}
