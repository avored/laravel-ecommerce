<?php

namespace Mage2\Catalog\Controllers\Admin;


use Mage2\Framework\System\Controllers\AdminController;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Mage2\Catalog\Models\ProductOption;
use Mage2\Catalog\Requests\OptionRequest;

class OptionController extends AdminController
{
    public function index()
    {

        $model = new ProductOption();
        //$model = $model->where('is_system','=', 0);

        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Id'));
        $dataGrid->addColumn(DataGrid::textColumn('title', 'Title'));
        $dataGrid->addColumn(DataGrid::textColumn('identifier', 'Identifier'));
        $dataGrid->addColumn(DataGrid::textColumn('field_type', 'Field Type'));

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.option.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.option.edit', $row->id) . "'>Edit</a>";
            }));
        }

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.option.destroy"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.option.destroy', $row->id) . "'>" .
                "<input type='hidden' name='_method' value='delete'/>" .
                csrf_field() .
                '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                "</form>";
            }));
        }
        return view('mage2catalog::admin.catalog.option.index')->with('dataGrid', $dataGrid);

    }

    public function create() {

        return view('mage2catalog::admin.catalog.option.create');
    }

    public function store(OptionRequest $request) {

        $request->merge(['validation' => implode("|", $request->get('validation'))]);



        $productOption = ProductOption::create($request->all());

        $this->_saveDropdownOptions($productOption, $request);


        return redirect()->route('admin.option.index');


    }

    public function edit($id) {

        $option = ProductOption::find($id);
        return view('mage2catalog::admin.catalog.option.edit')->with('option', $option);

    }

    public function update(OptionRequest $request,$id) {

        $request->merge(['validation' => implode("|", $request->get('validation'))]);
        $option = ProductOption::find($id);
        $option->update($request->all());


        //@todo fix the edit bug:: delete record for dropdown option if deleted during edit time....
        $this->_saveDropdownOptions($option, $request);

        return redirect()->route('admin.option.index');

    }

    public function destroy($id) {

        ProductOption::destroy($id);

        return redirect()->route('admin.option.index');
    }


    private function _saveDropdownOptions($productOption, $request) {

        if(null !== $request->get('dropdown-options') ) {


            //make sure to delete all existing ones...
            //$productOption->optionDropdownValues()->delete();


            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == "__RANDOM_STRING__") {
                    continue;
                }

                if (!is_int($key)) {
                    $productOption->optionDropdownValues()->create($val);
                } else {
                    //
                    $productOption->optionDropdownValues()->find($key)->update($val);
                }
            }
        }
    }
}
