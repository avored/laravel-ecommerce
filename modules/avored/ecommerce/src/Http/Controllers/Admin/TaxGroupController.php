<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\TaxGroup;
use AvoRed\Ecommerce\Models\Database\TaxRule;
use AvoRed\Ecommerce\Http\Requests\TaxGroupRequest;
use AvoRed\Framework\DataGrid\Facade as DataGrid;

class TaxGroupController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(TaxGroup::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.tax-group.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-tax-group-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.tax-group.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-tax-group-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('avored-ecommerce::admin.tax-group.index')
                    ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taxRulesOptions = TaxRule::all()->pluck('name', 'id');

        return view('avored-ecommerce::admin.tax-group.create')->with('taxRulesOptions', $taxRulesOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\TaxGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaxGroupRequest $request)
    {
        try {
            $taxGroup = TaxGroup::create($request->all());
            $taxGroup->taxRules()->sync($request->get('tax_rules'));
        } catch(\Exception $e) {
            throw new \Exception('Error While creating Tax Groups');
        }


        return redirect()->route('admin.tax-group.index');
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
        $taxGroup = TaxGroup::findorfail($id);
        $taxRulesOptions = TaxRule::all()->pluck('name', 'id');
        return view('avored-ecommerce::admin.tax-group.edit')
                    ->with('model', $taxGroup)
                    ->with('taxRulesOptions', $taxRulesOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\CountryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaxGroupRequest $request, $id)
    {
        try {

            $taxGroup = TaxGroup::findorfail($id);
            $taxGroup->update($request->all());
            $taxGroup->taxRules()->sync($request->get('tax_rules'));
        } catch(\Exception $e) {
            throw new \Exception('Error While updating Tax Groups');
        }

        return redirect()->route('admin.tax-group.index');
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

        try {
            TaxGroup::destroy($id);
        } catch(\Exception $e) {
            throw new \Exception('Error While destroing Tax Groups');
        }
        return redirect()->route('admin.tax-group.index');
    }
}
