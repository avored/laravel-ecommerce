<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\Country;
use AvoRed\Ecommerce\Models\Database\TaxRule;
use AvoRed\Ecommerce\Http\Requests\TaxRuleRequest;
use AvoRed\Ecommerce\DataGrid\Facade as DataGrid;

class TaxRuleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(TaxRule::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.tax-rule.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-tax-rule-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.tax-rule.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-tax-rule-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('avored-ecommerce::admin.tax-rule.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryOptions = Country::getCountriesOptions(true);
        return view('avored-ecommerce::admin.tax-rule.create')->with('countryOptions', $countryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\TaxRuleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRuleRequest $request)
    {
        TaxRule::create($request->all());

        return redirect()->route('admin.tax-rule.index');
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
        $countryOptions = [null => 'Please Select'] + Country::all()->pluck('name', 'id')->toArray();
        $taxRule = TaxRule::findorfail($id);

        return view('avored-ecommerce::admin.tax-rule.edit')
            ->with('model', $taxRule)
            ->with('countryOptions', $countryOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\TaxRuleRequest $request
     * @param int $id
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
        return redirect()->route('admin.tax-rule.index');
    }
}