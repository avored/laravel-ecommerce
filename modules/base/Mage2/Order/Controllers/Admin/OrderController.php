<?php

namespace Mage2\Order\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Mage2\System\Controllers\AdminController;
use Mage2\Order\Mail\OrderInvoicedMail;
use Mage2\Order\Models\Order;
use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\UpdateOrderStatusRequest;
use Mage2\User\Models\User;

class OrderController extends AdminController
{

    public function index()
    {
        $orders = Order::paginate(10);

        return view('admin.order.index')
                ->with('orders', $orders);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        //$view = view('order.view')->with('order', $order);


        $view = view('admin.order.view')->with('order', $order);

        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        return $view;
    }

    public function sendEmailInvoice($id)
    {
        $order = Order::findorfail($id);
        $user = User::find($order->user_id);

        $view = view('admin.order.pdf')->with('order', $order);
        $path = public_path('/uploads/order/invoice/'.$order->id.'.pdf');
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));
    }

    public function changeStatus($id)
    {
        $order = Order::findorfail($id);

        $orderStatus = OrderStatus::all()->pluck('title', 'id');

        $view = view('admin.order.view')
                ->with('order', $order)
                ->with('orderStatus', $orderStatus)
                ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = Order::findorfail($id);
        $order->update($request->all());

        return redirect()->route('admin.order.index');
    }
}
