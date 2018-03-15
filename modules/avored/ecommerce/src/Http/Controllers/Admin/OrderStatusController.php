<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Framework\Repository\Order;
use AvoRed\Ecommerce\Http\Requests\OrderStatusRequest;
use AvoRed\Framework\DataGrid\Facade as DataGrid;

class OrderStatusController extends AdminController
{


    /**
     * AvoRed Order Repository
     *
     * @var \AvoRed\Framework\Repository\Order
     */
    protected $orderRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Framework\Repository\Order $orderRepository
     * @return void
     */
    public function __construct(Order $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataGrid = DataGrid::model($this->orderRepository->statusModel()->query())
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

        return view('avored-ecommerce::admin.order-status.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin.order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\OrderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {

        if($request->get('is_default') == 1) {
            $this->orderRepository->statusModel()->whereIsDefault(1)->update(['is_default' => 0]);
        }
        $this->orderRepository->statusModel()->create($request->all());

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

        $orderStatus = $this->orderRepository->statusModel()->findorfail($id);

        return view('avored-ecommerce::admin.order-status.edit')
            ->with('model', $orderStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\OrderStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, $id)
    {
        if($request->get('is_default') == 1) {
            $this->orderRepository->statusModel()->whereIsDefault(1)->update(['is_default' => 0]);
        }

        $orderStatus = $this->orderRepository->statusModel()->findorfail($id);

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

        $this->orderRepository->statusModel()->destroy($id);
        return redirect()->route('admin.order-status.index');
    }
}
