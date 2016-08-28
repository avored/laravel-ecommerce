<?php

namespace App\Http\Controllers;

use Mage2\Admin\Eloquents\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Mage2\Admin\Eloquents\Models\Order;

class OrderController extends Controller {

    public function index() {
        $orderData = Session::get('order_data');

        Session::forget('cart');
        Session::forget('order_data');

        $orderStatus = OrderStatus::where('is_default','=',1)->get()->first();
        $orderData['order_status_id'] = $orderStatus->id;
        $order = Order::create($orderData);

        return redirect()->route('order.success', $order->id);
    }

    public function success($id) {

        $order = Order::findorfail($id);
        return view($this->theme . '.order.success')
                        ->with('order', $order);
    }

}
