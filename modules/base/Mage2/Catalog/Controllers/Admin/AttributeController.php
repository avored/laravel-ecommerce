<?php

namespace Mage2\Catalog\Controllers\Admin;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Mage2\Catalog\Requests\AttributeRequest;
use Mage2\Catalog\Models\AttributeDropdownOption;

class AttributeController extends AdminController
{
    public function index()
    {

        $model = new ProductAttribute();
        $model = $model->where('is_system','=', 0);

        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Id'));
        $dataGrid->addColumn(DataGrid::textColumn('title', 'Title'));
        $dataGrid->addColumn(DataGrid::textColumn('identifier', 'Identifier'));
        $dataGrid->addColumn(DataGrid::textColumn('field_type', 'Field Type'));

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.attribute.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.attribute.edit', $row->id) . "'>Edit</a>";
            }));
        }

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.attribute.destroy"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.attribute.destroy', $row->id) . "'>" .
                "<input type='hidden' name='_method' value='delete'/>" .
                csrf_field() .
                '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                "</form>";
            }));
        }

        return view('mage2catalog::admin.catalog.attribute.index')->with('dataGrid', $dataGrid);

    }

    public function create() {
        return view('mage2catalog::admin.catalog.attribute.create');
    }

    public function store(AttributeRequest $request) {

        $request->merge(['validation' => implode("|", $request->get('validation'))]);
        $productAttribute = ProductAttribute::create($request->all());


        foreach($request->get('dropdown-options') as $key => $val) {
                if($key == "__RANDOM_STRING__") {
                    continue;
                }
            if(!is_int($key)) {
                $productAttribute->attributeDropdownOptions()->create($val);
            }
        }

        return redirect()->route('admin.attribute.index');


    }

    public function edit($id) {

        $attribute = ProductAttribute::find($id);
        return view('mage2catalog::admin.catalog.attribute.edit')->with('attribute', $attribute);

    }

    public function update(AttributeRequest $request,$id) {

        $request->merge(['validation' => implode("|", $request->get('validation'))]);
        $attribute = ProductAttribute::find($id);
        $attribute->update($request->all());


        foreach($request->get('dropdown-options') as $key => $val) {

            if($key == "__RANDOM_STRING__") {
                continue;
            }
            if(!is_int($key)) {
                $attribute->attributeDropdownOptions()->create($val);
            } else {

                $dropdownOption = AttributeDropdownOption::findorfail($key);
                $dropdownOption->update($val);

            }
        }

        return redirect()->route('admin.attribute.index');

    }

    public function destroy($id) {

        ProductAttribute::destroy($id);

        return redirect()->route('admin.attribute.index');
    }
}
