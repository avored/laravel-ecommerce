<?php

namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Ecommerce\Repository\User;
use AvoRed\Framework\Repository\Order;
use AvoRed\Ecommerce\Mail\OrderInvoicedMail;
use AvoRed\Ecommerce\Mail\UpdateOrderStatusMail;
use AvoRed\Ecommerce\DataGrid\Order as OrderGrid;
use AvoRed\Ecommerce\Http\Requests\UpdateOrderStatusRequest;

class OrderController extends AdminController
{
    /**
     * AvoRed Product Repository.
     *
     * @var \AvoRed\Ecommerce\Repository\User
     */
    protected $userRepository;

    /**
     * AvoRed Order Repository.
     *
     * @var \AvoRed\Framework\Repository\Order
     */
    protected $orderRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\User $repository
     * @param \AvoRed\Framework\Repository\Order $orderRepository
     * @return void
     */
    public function __construct(User $repository, Order $orderRepository)
    {
        $this->userRepository = $repository;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orderGrid = new OrderGrid($this->orderRepository->model()->query()->orderBy('id', 'desc'));

        return view('avored-ecommerce::admin.order.index')->with('dataGrid', $orderGrid->dataGrid);
    }

    public function view($id)
    {
        $order = $this->orderRepository->model()->findorfail($id);
        $view = view('avored-ecommerce::admin.order.view')->with('order', $order);

        return $view;
    }

    public function sendEmailInvoice($id)
    {
        $order = $this->orderRepository->model()->findorfail($id);
        $user = $this->userRepository->model()->find($order->user_id);

        $view = view('avored-ecommerce::admin.mail.order-pdf')->with('order', $order);

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
        $order = $this->orderRepository->model()->findorfail($id);

        $orderStatus = $this->orderRepository->statusModel()->all()->pluck('name', 'id');

        $view = view('avored-ecommerce::admin.order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = $this->orderRepository->model()->findorfail($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
