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
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Catalog\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Catalog\Models\Review;
use Mage2\Framework\DataGrid\Facades\DataGrid;

class ReviewController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new Review());
    }


    public function index()
    {
        /**
         * $model = new Review();
         * $dataGrid = DataGrid::make($model);
         *
         * $dataGrid->addColumn(DataGrid::textColumn('id', 'Id'));
         * $dataGrid->addColumn(DataGrid::textColumn('user_name', 'User Name'));
         * $dataGrid->addColumn(DataGrid::textColumn('product_title', 'Product Title'));
         * $dataGrid->addColumn(DataGrid::textColumn('star', 'Product Title'));
         * $dataGrid->addColumn(DataGrid::textColumn('status', 'Status'));
         *
         * if (Gate::allows('hasPermission', [AdminUser::class, "admin.review.edit"])) {
         * $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
         * return "<a href='" . route('admin.review.edit', $row->id) . "'>Edit</a>";
         * }));
         * }
         *
         *
         * if (Gate::allows('hasPermission', [AdminUser::class, "admin.review.destroy"])) {
         * $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
         * return "<form method='post' action='" . route('admin.review.destroy', $row->id) . "'>" .
         * "<input type='hidden' name='_method' value='delete'/>" .
         * csrf_field() .
         * '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
         * "</form>";
         * }));
         * }
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
