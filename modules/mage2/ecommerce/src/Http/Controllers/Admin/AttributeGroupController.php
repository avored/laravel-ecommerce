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

use Mage2\Ecommerce\Models\Database\AttributeGroup;
use Mage2\Ecommerce\Models\Database\Attribute;
use Mage2\Ecommerce\Http\Requests\AttributeGroupRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class AttributeGroupController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(AttributeGroup::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.attribute-group.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-attribute-group-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.attribute-group.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-attribute-group-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('mage2-ecommerce::admin.attribute-group.index')
                    ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesOptions = Attribute::all()->pluck('name', 'id');

        return view('mage2-ecommerce::admin.attribute-group.create')->with('attributesOptions', $attributesOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\AttributeGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeGroupRequest $request)
    {
        try {
            $attributeGroup = AttributeGroup::create($request->all());
            $attributeGroup->attributes()->sync($request->get('attributes'));
        } catch(\Exception $e) {
            throw new \Exception('Error While creating Attribute Groups');
        }


        return redirect()->route('admin.attribute-group.index');
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
        $attributeGroup = AttributeGroup::findorfail($id);
        $attributesOptions = Attribute::all()->pluck('name', 'id');
        return view('mage2-ecommerce::admin.attribute-group.edit')
                    ->with('model', $attributeGroup)
                    ->with('attributesOptions', $attributesOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\CountryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeGroupRequest $request, $id)
    {
        try {

            $attributeGroup = AttributeGroup::findorfail($id);
            $attributeGroup->update($request->all());
            $attributeGroup->attributes()->sync($request->get('attributes'));
        } catch(\Exception $e) {
            throw new \Exception('Error While updating Attribute Groups');
        }

        return redirect()->route('admin.attribute-group.index');
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
            AttributeGroup::destroy($id);
        } catch(\Exception $e) {
            throw new \Exception('Error While destroing Tax Groups');
        }
        return redirect()->route('admin.attribute-group.index');
    }
}
