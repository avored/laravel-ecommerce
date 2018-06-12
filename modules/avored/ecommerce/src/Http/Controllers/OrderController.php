<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Ecommerce\Models\Database\User;
use AvoRed\Framework\Models\Database\Order as Model;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Ecommerce\Mail\OrderInvoicedMail;
use AvoRed\Ecommerce\Mail\UpdateOrderStatusMail;
use AvoRed\Ecommerce\DataGrid\Order as OrderGrid;
use AvoRed\Ecommerce\Http\Requests\UpdateOrderStatusRequest;
use AvoRed\Framework\Models\Contracts\OrderInterface;

class OrderController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderRepository
    */
    protected $repository;

    public function __construct(OrderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderGrid = new OrderGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-ecommerce::order.index')->with('dataGrid', $orderGrid->dataGrid);
    }

    /**
     * View an Order Details
     * @param \AvoRed\Ecommerce\Models\Database\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Model $order)
    {
        return view('avored-ecommerce::order.view')->with('order', $order);
    }

    /**
     * Send an Order Invioced PDF to User
     * @param \AvoRed\Ecommerce\Models\Database\Order $order
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmailInvoice(Model $order)
    {
        $user = $order->user;
        $view = view('avored-ecommerce::mail.order-pdf')->with('order', $order);

        $folderPath = public_path('uploads/order/invoice');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, '0775', true, true);
        }
        $path = $folderPath . DIRECTORY_SEPARATOR . $order->id . '.pdf';
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));

        return redirect()->back()->with('notificationText', 'Email Sent Successfully!!');
    }

    /**
     * Edit the Order Status View
     * @param \AvoRed\Ecommerce\Models\Database\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function editStatus(Model $order)
    {
        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('avored-ecommerce::order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    /**
     * Change the Order Status
     * @param \AvoRed\Ecommerce\Models\Database\Order $order
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Model $order, UpdateOrderStatusRequest $request)
    {
        //$order = Model::find($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
