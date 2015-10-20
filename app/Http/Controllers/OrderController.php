<?php
/*
Copyright (c) 2015, Purvesh
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

* Neither the name of Mage2 nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

namespace App\Http\Controllers;

use Mage2\Core\Model\Customer;
use Mage2\Core\Model\Address;
use Mage2\Core\Model\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(Request $request)
    {

        $customer   = $this->_createCustomer($request);
        $address    = $this->_createAddress($customer , $request);
        $order      = $this->_createOrder($customer, $address, $request);

        return view('front.order.success')->with('order', $order);


    }


    /**
     *
     * Create Row into Order Table
     * @todo insert empty cart and insert products IDs into order_item table
     *
     * @param $customer
     * @param $address
     * @param $request
     * @return static
     *
     */
    private function _createOrder($customer, $address, $request) {

        $orderData = [
            'customer_id' => $customer->id,
            'shipping_address_id' => $address->id,
            'billing_address_id' => $address->id,
            'shipping_type' => '',
            'payment_type' => '',
            'notes' => $request->get('notes')
        ];

        return Order::create($orderData);
    }


    /**
     * create customer with random password
     * @param $request
     * @return mixed
     *
     */
    private function _createCustomer($request) {
        $request->merge(['password' => str_random(8)]);
        //$customer = Customer::create($request->all());
        $customer = Customer::findorfail(1);
        return $customer;
    }

    /**
     * Create Customer address with Shipping And billing type
     * @todo add shipping type Address too
     *
     * @param $customer
     * @param $request
     * @return mixed
     *
     */
    private function _createAddress($customer , $request) {

        $request->merge(['customer_id' => $customer->id]);
        //$address = Address::create($request->all());

        $address = Address::findorfail(1);
        return $address;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */


    public function indexOld(Request $request)
    {

        //@todo remove comments & delete below line


        if ($request->get('customer_id')) {
            $customer = Customer::findorfail($request->get('customer_id'));
        } else {
            if (Customer::ofEmail($request->get('email'))->count() <= 0) {
                if ($request->get('password') != "") {
                    $request->merge(['password' => str_random(6)]);
                }
                $customer = Customer::create($request->all());
            } else {
                $customer = Customer::ofEmail($request->get('email'))->get()->first();
            }
        }


        /* SHIPPING SAVE STEP */
        if ($request->get('step') == 'billing') {
            //SAVE or CREATE Billing ADDRESS 

            $request->merge(['type' => 'billing']);
            $request->merge(['customer_id' => $customer->id]);
            $address = Address::create($request->all());

            $orderData = ['customer_id' => $customer->id, 'billing_address_id' => $address->id];
            $order = Order::create($orderData);

            //DATA EXIST IF USER LOGGED IN....
            $data = $customer->toArray();
            $address = Address::Shipping()->ofCustomerId($customer->id)->get()->first();
            $data += (isset($address)) ? $address->toArray() : array();

            $data['address_id'] = (isset($address->id)) ? $address->id : "";
            $data['customer_id'] = $customer->id;
            //@TODO Create ORDER HERE
            return view('mage2::front.order.shipping-step')->with('data', $data)->with('order', $order);
        }

        /* SHIPPING SAVE STEP */
        if ($request->get('step') == 'shipping') {
            //SAVE or CREATE Billing ADDRESS 
            $order = Order::findorfail($request->get('order_id'));

            $request->merge(['type' => 'SHIPPING']);
            $request->merge(['customer_id' => $customer->id]);
            $address = Address::create($request->all());

            $orderData = ['shipping_address_id' => $address->id];
            $order->update($orderData);
            //DATA EXIST IF USER LOGGED IN....
            $data = [];
            $config = Config::get('mage2');
            return view('mage2::front.order.shipping-method')
                ->with('data', $data)
                ->with('order', $order)
                ->with('config', $config);
        }

        /* SHIPPING  METHOD SAVE STEP */
        if ($request->get('step') == 'shipping-method') {

            $order = Order::find($request->get('order_id'));
            $order->update($request->all());

            //DATA EXIST IF USER LOGGED IN....
            $data = [];
            $config = Config::get('mage2');
            return view('mage2::front.order.payment-method')
                ->with('data', $data)
                ->with('order', $order)
                ->with('config', $config);
        }

        /* PAYMENT METHOD SAVE STEP */
        if ($request->get('step') == 'payment-method') {

            $cart = (Session::get('cart')) ? Session::get('cart') : array();

            $order = Order::find($request->get('order_id'));
            $order->update($request->all());

            //DATA EXIST IF USER LOGGED IN....
            $data = [];

            return view('mage2::front.order.order-review')
                ->with('data', $data)
                ->with('cart', $cart)
                ->with('order', $order);

        }

        /* SHIPPING  METHOD SAVE STEP */
        if ($request->get('step') == 'order-review') {

            $order = Order::find($request->get('order_id'));
            $order->update($request->all());

            Session::forget('cart');

            return view('front.order.success')->with('order', $order);
        }
    }

}
