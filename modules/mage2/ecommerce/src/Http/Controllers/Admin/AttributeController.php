<?php
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
        $this->_saveDropdownOptions($attribute , $request);

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
        $this->_saveDropdownOptions($attribute, $request);

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
