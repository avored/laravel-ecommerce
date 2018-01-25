<?php
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Mage2\Ecommerce\Models\Database\OrderStatus;
use Mage2\Ecommerce\Http\Requests\OrderStatusRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class OrderStatusController extends AdminController
{

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataGrid = DataGrid::model(OrderStatus::query())
            ->column('name',['label' => 'Name','sortable' => true])
            ->column('is_default',['sortable' => false])
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.order-status.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-order-status-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.order-status.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-order-status-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('mage2-ecommerce::admin.order-status.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2-ecommerce::admin.order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\OrderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {

        if($request->get('is_default') == 1) {
            OrderStatus::whereIsDefault(1)->update(['is_default' => 0]);
        }
        OrderStatus::create($request->all());

        return redirect()->route('admin.order-status.index');
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

        return view('mage2-ecommerce::admin.order-status.edit')
            ->with('model', $orderStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\OrderStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, $id)
    {
        if($request->get('is_default') == 1) {
            OrderStatus::whereIsDefault(1)->update(['is_default' => 0]);
        }

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
