<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Models\Database\Order as Model;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Ecommerce\Mail\OrderInvoicedMail;
use AvoRed\Ecommerce\Mail\UpdateOrderStatusMail;
use AvoRed\Ecommerce\DataGrid\Order as OrderGrid;
use AvoRed\Ecommerce\Http\Requests\UpdateOrderStatusRequest;

class OrderController extends Controller
{

    public function index()
    {
        $orderGrid = new OrderGrid(Model::query()->orderBy('id', 'desc'));

        return view('avored-ecommerce::order.index')->with('dataGrid', $orderGrid->dataGrid);
    }

    public function view($id)
    {
        $order  = Model::find($id);
        
        return view('avored-ecommerce::order.view')->with('order', $order);
    }

    public function sendEmailInvoice($id)
    {
        $order  = Model::find($id);
        $user   = $order->user;

        $view = view('avored-ecommerce::mail.order-pdf')->with('order', $order);

        $folderPath = public_path('uploads/order/invoice');
        if (! File::exists($folderPath)) {
            File::makeDirectory($folderPath, '0775', true, true);
        }
        $path = $folderPath.DIRECTORY_SEPARATOR.$order->id.'.pdf';
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));

        return redirect()->back()->with('notificationText', 'Email Sent Successfully!!');
    }

    public function changeStatus($id)
    {
        $order = Model::find($id);

        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('avored-ecommerce::order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = Model::find($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
