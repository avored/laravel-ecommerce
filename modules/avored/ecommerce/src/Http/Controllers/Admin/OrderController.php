<?php
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Mage2\Ecommerce\Mail\OrderInvoicedMail;
use Mage2\Ecommerce\Models\Database\Order;
use Mage2\Ecommerce\Models\Database\OrderStatus;
use Mage2\Ecommerce\Http\Requests\UpdateOrderStatusRequest;
use Mage2\Ecommerce\Models\Database\User;
use Mage2\Ecommerce\Mail\UpdateOrderStatusMail;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use Illuminate\Support\Facades\File;

class OrderController extends AdminController
{
    public function index()
    {
        $dataGrid = DataGrid::model(Order::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('shipping_option',['label' => 'Shipping Option'])
            ->column('payment_option',['label' => 'Payment Option'])
            ->linkColumn('order_status',['label' => 'Order Status'], function($model) {
                return $model->orderStatus->name;
            })
            ->linkColumn('view',[], function($model) {
                return "<a href='". route('admin.order.view', $model->id)."' >View</a>";
            });

        return view('mage2-ecommerce::admin.order.index')->with('dataGrid', $dataGrid);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        $view = view('mage2-ecommerce::admin.order.view')->with('order', $order);

        return $view;
    }

    public function sendEmailInvoice($id)
    {

        $order = Order::findorfail($id);
        $user = User::find($order->user_id);

        $view = view('mage2-ecommerce::admin.mail.order-pdf')->with('order', $order);

        $folderPath = public_path('uploads/order/invoice');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, '0775', true, true);
        }
        $path = $folderPath . DIRECTORY_SEPARATOR . $order->id . '.pdf';
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));

        return redirect()->back()->with('notificationText', "Email Sent Successfully!!");
    }

    public function changeStatus($id)
    {
        $order = Order::findorfail($id);

        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('mage2-ecommerce::admin.order.view')
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
        $orderStatusTitle = $order->orderStatus->name;

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
