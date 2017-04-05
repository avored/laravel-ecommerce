<?php

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
        if ($request->get('is_default') == 1) {
            foreach (OrderStatus::where('is_default', '=', 1)->get() as $orderStatus) {
                $orderStatus->is_default = 0;
                $orderStatus->update();
            }
        }
        if ($request->get('is_last_stage') == 1) {
            foreach (OrderStatus::where('is_last_stage', '=', 1)->get() as $orderStatus) {
                $orderStatus->is_last_stage = 0;
                $orderStatus->update();
            }
        }

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
