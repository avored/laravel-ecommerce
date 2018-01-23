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

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use Mage2\Ecommerce\Models\Database\Property;
use Mage2\Ecommerce\Http\Requests\PropertyRequest;

class PropertyController extends AdminController
{

    /**
     * Display a listing of the Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataGrid = DataGrid::model(Property::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->column('identifier')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.property.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-property-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.property.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-property-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('mage2-ecommerce::admin.property.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2-ecommerce::admin.property.create');
    }

    /**
     * Store a newly created property in database.
     *
     * @param \Mage2\Ecommerce\Http\Requests\PropertyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        Property::create($request->all());

        return redirect()->route('admin.property.index');
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::findorfail($id);

        return view('mage2-ecommerce::admin.property.edit')->with('model', $property);
    }

    /**
     * Update the specified property in database.
     *
     * @param \Mage2\Ecommerce\Http\Requests\Property $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::findorfail($id);
        $property->update($request->all());

        return redirect()->route('admin.property.index');
    }

    /**
     * Remove the specified property from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Property::destroy($id);

        return redirect()->route('admin.property.index');
    }



    /**
     * Get the Element Html in Json Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getElementHtml(Request $request)
    {
        $properties = Property::whereIn('id',$request->get('property_id'))->get();



        $tmpString = str_random();
        $view = view('mage2-ecommerce::admin.property.get-element')
                        ->with('properties', $properties)
                        ->with('tmpString', $tmpString);


        return new JsonResponse(['success' => true,'content' => $view->render()]);
    }
}
