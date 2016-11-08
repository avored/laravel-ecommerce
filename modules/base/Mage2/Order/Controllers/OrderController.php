<?php

namespace Mage2\Order\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Order\Mail\OrderInvoicedMail;
use Mage2\Order\Models\Order;
use Mage2\Order\Models\OrderStatus;
use Mage2\User\Models\User;

class OrderController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function adminindex()
    {
        $orders = Order::paginate(10);

        return view('order.index')
                ->with('orders', $orders);
    }

    public function index()
    {
        $orderData = Session::get('order_data');
        $orderProductData = Session::get('cart');


        $orderStatus = OrderStatus::where('is_default', '=', 1)->get()->first();
        $orderData['order_status_id'] = $orderStatus->id;



        $order = Order::create($orderData);

        $this->syncOrderProductData($order, $orderProductData);

        Session::forget('cart');
        Session::forget('order_data');

        return redirect()->route('order.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::findorfail($id);

        return view('order.success')
            ->with('order', $order);
    }

    public function syncOrderProductData($order, $orderProducts)
    {
        //Only use pivot fields only @latner on use Collection and then use pluck method rather then foreach
        foreach ($orderProducts as $i => $orderProduct) {
            unset($orderProduct['model']);
            unset($orderProduct['id']);
            $orderProducts[$i] = $orderProduct;
        }

        $order->products()->sync($orderProducts);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        //$view = view('order.view')->with('order', $order);


        $view = view('order.view')->with('order', $order);

        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        return $view;
    }

    public function myAccountOrderList()
    {
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id', '=', $user->id)->get();
        $view = view('order.my-account-order-list')->with('orders', $orders);

        return $view;
    }

    public function myAccountOrderView($id)
    {
        $order = Order::find($id);
        $view = view('order.my-account-order-view')->with('order', $order);

        return $view;
    }

    public function sendEmailInvoice($id)
    {
        $order = Order::findorfail($id);

        $user = User::find($order->user_id);



        $view = view('order.pdf')->with('order', $order);

        $path = public_path('/uploads/order/invoice/'.$order->id.'.pdf');
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));
        //Mail::send();
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        //return redirect()->back();
    }
}
