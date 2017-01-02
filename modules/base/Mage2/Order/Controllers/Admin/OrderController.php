<?php

namespace Mage2\Order\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Order\Mail\OrderInvoicedMail;
use Mage2\Order\Models\Order;
use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\UpdateOrderStatusRequest;
use Mage2\User\Models\User;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
use Mage2\Order\Mail\UpdateOrderStatusMail;
use Mage2\Framework\DataGrid\Facades\DataGrid;

class OrderController extends AdminController
{

    public function index()
    {
        $model  = new Order();
        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Order ID'));
        $dataGrid->addColumn(DataGrid::textColumn('shipping_method', 'Shipping Method'));
        $dataGrid->addColumn(DataGrid::textColumn('payment_method', 'Payment Method'));
        $dataGrid->addColumn(DataGrid::textColumn('order_status_title', 'Order Status'));
        if (Gate::allows('hasPermission', [AdminUser::class, "admin.order.view"])) {

            $dataGrid->addColumn(DataGrid::linkColumn('view', 'View', function ($row) {
                return "<a href='" . route('admin.order.view', $row->id) . "'>View</a>";
            }));
        }

        return view('mage2order::admin.order.index')
                ->with('dataGrid', $dataGrid);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        //$view = view('order.view')->with('order', $order);


        $view = view('mage2order::admin.order.view')->with('order', $order);

        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        return $view;
    }

    public function sendEmailInvoice($id)
    {
        $order = Order::findorfail($id);
        $user = User::find($order->user_id);

        $view = view('mage2order::admin.order.pdf')->with('order', $order);
        $path = public_path('/uploads/order/invoice/'.$order->id.'.pdf');
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));
    }

    public function changeStatus($id)
    {
        $order = Order::findorfail($id);

        $orderStatus = OrderStatus::all()->pluck('title', 'id');

        $view = view('mage2order::admin.order.view')
                ->with('order', $order)
                ->with('orderStatus', $orderStatus)
                ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = Order::findorfail($id);
        $order->update($request->all());
        
        $userEmail = $order->user->email;
        $orderStatusTitle = $order->order_status_title;
        
        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));
        
        return redirect()->route('admin.order.index');
    }
}
