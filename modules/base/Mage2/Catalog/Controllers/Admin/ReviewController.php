<?php

namespace Mage2\Catalog\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Catalog\Models\Review;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Illuminate\Support\Facades\Gate;
use Mage2\User\Models\AdminUser;

class ReviewController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new Review());
    }


    public function index()
    {
        /**
        $model = new Review();
        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Id'));
        $dataGrid->addColumn(DataGrid::textColumn('user_name', 'User Name'));
        $dataGrid->addColumn(DataGrid::textColumn('product_title', 'Product Title'));
        $dataGrid->addColumn(DataGrid::textColumn('star', 'Product Title'));
        $dataGrid->addColumn(DataGrid::textColumn('status', 'Status'));

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.review.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.review.edit', $row->id) . "'>Edit</a>";
            }));
        }


        if (Gate::allows('hasPermission', [AdminUser::class, "admin.review.destroy"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.review.destroy', $row->id) . "'>" .
                "<input type='hidden' name='_method' value='delete'/>" .
                csrf_field() .
                '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                "</form>";
            }));
        }
         */

        return view('mage2catalog::admin.review.index');
    }

    public function edit($id)
    {
        $review = Review::find($id);

        return view('mage2catalog::admin.review.edit')->with('review', $review);
    }

    public function update($id, Request $request)
    {
        $review = Review::find($id);
        $review->update($request->all());

        return redirect()->route('admin.review.index');
    }
}
