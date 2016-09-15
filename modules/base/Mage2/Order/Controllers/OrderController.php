<?php

namespace Mage2\Order\Controllers;

use Mage2\Order\Models\Order;
use Mage2\Framework\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Session;
use Mage2\Order\Models\OrderStatus;

//use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    /**
     * @var CategoryRepository
     */
   

    public function __construct(){
        parent::__construct();
    }

    public function adminindex() {

        $orders = Order::paginate(10);

        return view('order.index')
                ->with('orders', $orders)
            ;
    }
    public function index() {
        $orderData = Session::get('order_data');
        $orderProductData = Session::get('cart');


        $orderStatus = OrderStatus::where('is_default','=',1)->get()->first();
        $orderData['order_status_id'] = $orderStatus->id;



        $order = Order::create($orderData);

        $this->syncOrderProductData($order, $orderProductData);

        Session::forget('cart');
        Session::forget('order_data');

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

    public function view($id) {

        $order = Order::findorfail($id);
        //$view = view('order.view')->with('order', $order);


        $view = view('order.pdf')->with('order', $order);

        PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        return $view;
    }


}
