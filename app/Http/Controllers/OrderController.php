<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Address;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class OrderController extends Controller {


    public function index() {
        $orders = Order::paginate(10);

        return view('order.index')->with('orders', $orders);
    }
    public function checkoutPage() {

        $sessionProducts = Session::get('products');
        return view('order.checkout-page')->with('products', $sessionProducts);
    }

    public function placeOrder(Request $request) {

        $customer           = $this->_saveCustomer($request);
        $shippingAddress    = $this->_saveShippingAddress($request);
        $billingAddress     = $this->_saveBillingAddress($request);

        $request->merge(['customer_id' => $customer->id, 'shipping_address_id' => $shippingAddress->id,  'billing_address_id' => $billingAddress->id]);

        Order::create($request->all());

        return redirect('/checkout/order-successfull');
    }

    public function success() {
        return view('order.success');
    }

    /**
     * @param Request $request
     * @return \App\Customer
     *
     */
    private function _saveCustomer(Request $request) {

        $data =  $request->all();

        $customer = Customer::where('email','=',$data['email'])->get()->first();

        if(NULL !== $customer) {
            return $customer;
        }

        $data['first_name'] = $data['shipping']['first_name'];
        $data['last_name'] = $data['shipping']['last_name'];


        if(!isset($data['password']) && $data['password'] == "") {
            $data['password'] = str_random('6');
            $data['system_user'] = 1;
        }
        $data['password'] = bcrypt($data['password']);

        return Customer::create($data);
    }

    /**
     * @param $request
     * @return \App\Address
     *
     */

    private function _saveShippingAddress(Request $request) {

        return Address::create($request->get('shipping'));
    }

    /**
     * @param $request
     * @return \App\Address
     *
     */

    private function _saveBillingAddress(Request $request) {

        if($request->get('use_same_for_shipping') == 1) {
            return Address::create($request->get('shipping'));
        } else {
            dd('Should NOT BE HERE. FEATURE NOT IMPLEMENTED. PLEASE FIX THIS');
            return Address::create($request->get('billing'));
        }
    }
}
