<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use CrazyCommerce\Admin\Models\Order;

class OrderController extends Controller {

    public function index() {
        $orderData = Session::get('order_data');

        Session::forget('cart');
        Session::forget('order_data');

        $order = Order::create($orderData);

        return redirect()->route('order.success', $order->id);
    }

    public function success($id) {

        $order = Order::findorfail($id);
        return view($this->theme . '.order.success')
                        ->with('order', $order);
    }

}
