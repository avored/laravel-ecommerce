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
        $orderProductData = Session::get('cart');

        Session::forget('cart');
        Session::forget('order_data');

        $orderStatus = OrderStatus::where('is_default','=',1)->get()->first();
        $orderData['order_status_id'] = $orderStatus->id;
        $order = Order::create($orderData);

        $this->syncOrderProductData($order, $orderProductData);

        return redirect()->route('order.success', $order->id);
    }

    public function success($id) {

        $order = Order::findorfail($id);
        return view('order.success')
                        ->with('order', $order);
    }


    public function syncOrderProductData($order, $orderProducts) {
        //Only use pivot fields only @latner on use Collection and then use pluck method rather then foreach
        foreach($orderProducts as $i => $orderProduct) {
            unset($orderProduct['model']);
            unset($orderProduct['id']);
            $orderProducts[$i] = $orderProduct;
        }

        $order->products()->sync($orderProducts);
    }

}
