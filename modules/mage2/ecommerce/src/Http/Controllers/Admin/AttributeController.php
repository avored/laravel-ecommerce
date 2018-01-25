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

use Mage2\Ecommerce\Models\Database\Attribute;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use Mage2\Ecommerce\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;

class AttributeController extends AdminController
{




    public function index()
    {
        $dataGrid = DataGrid::model(Attribute::query())
            ->column('name',['label' => 'Name','sortable' => true])
            ->column('identifier',['sortable' => true])
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.attribute.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-attribute-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.attribute.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-attribute-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

//        return view('mage2-framework::category.index')->with('dataGrid', $dataGrid);


        return view('mage2-ecommerce::admin.attribute.index')->with('dataGrid', $dataGrid);
    }

    public function create()
    {

        return view('mage2-ecommerce::admin.attribute.create');
    }

    public function store(AttributeRequest $request)
    {

        $attribute = Attribute::create($request->all());
        //$this->_saveDropdownOptions($attribute , $request);

        return redirect()->route('admin.attribute.index');


    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('mage2-ecommerce::admin.attribute.edit')->with('model', $attribute);

    }

    public function update(AttributeRequest $request, $id)
    {

        $attribute = Attribute::find($id);
        $attribute->update($request->all());
        //$this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');

    }

    /**
     *
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        Attribute::destroy($id);

        return redirect()->route('admin.attribute.index');
    }


    public function getAttribute(Request $request)
    {
        $attribute = Attribute::findorfail($request->get('id'));

        return view('mage2-ecommerce::admin.attribute.attribute-card-values')
            ->with('attribute', $attribute);

    }


    private function _saveDropdownOptions($attribute, $request)
    {

        if (null !== $request->get('dropdown-options')) {

            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }
                if (!is_int($key)) {
                    $attribute->attributeDropdownOptions()->create($val);
                }

                // Update existing value
                if(is_int($key)) {
                    $dropdownOption = OptionDropdownOption::find($key);
                    $dropdownOption->update($val);
                }
            }
        }
    }
}
