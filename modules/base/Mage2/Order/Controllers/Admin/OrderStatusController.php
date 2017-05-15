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
namespace Mage2\Order\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\OrderStatusRequest;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Illuminate\Support\Facades\Gate;
use Mage2\User\Models\AdminUser;

class OrderStatusController extends AdminController
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model  = new OrderStatus();
        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Order ID'));
        $dataGrid->addColumn(DataGrid::textColumn('title', 'Title'));
        $dataGrid->addColumn(DataGrid::textColumn('is_default', 'Is Default'));
        $dataGrid->addColumn(DataGrid::textColumn('is_last_stage', 'Is Last Stage'));
        if (Gate::allows('hasPermission', [AdminUser::class, "admin.order-status.edit"])) {

            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.order-status.edit', $row->id) . "'>Edit</a>";
            }));
        }
         if (Gate::allows('hasPermission', [AdminUser::class, "admin.order-status.destroy"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.order-status.destroy', $row->id) . "'>" .
                        "<input type='hidden' name='_method' value='delete'/>" .
                        csrf_field() .
                        '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                        "</form>";
            }));
        } 


        return view('mage2order::admin.order-status.index')
                ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2order::admin.order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Order\Requests\orderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        OrderStatus::create($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $orderStatus = OrderStatus::findorfail($id);

        return view('mage2order::admin.order-status.edit')
            ->with('orderStatus', $orderStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Order\Requests\orderStatusRequest $request
     * @param int                                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(orderStatusRequest $request, $id)
    {
        $orderStatus = OrderStatus::findorfail($id);

        $orderStatus->update($request->all());

        return redirect()->route('admin.order-status.index');
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
        OrderStatus::destroy($id);

        return redirect()->route('admin.order-status.index');
    }
}
