<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Mage2\Ecommerce\Models\Database\TaxGroup;
use Mage2\Ecommerce\Models\Database\TaxRule;
use Mage2\Ecommerce\Http\Requests\TaxGroupRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

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
        return view('mage2-ecommerce::admin.tax-group.index')
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

        return view('mage2-ecommerce::admin.tax-group.create')->with('taxRulesOptions', $taxRulesOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\TaxGroupRequest $request
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
        return view('mage2-ecommerce::admin.tax-group.edit')
                    ->with('model', $taxGroup)
                    ->with('taxRulesOptions', $taxRulesOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\CountryRequest $request
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
