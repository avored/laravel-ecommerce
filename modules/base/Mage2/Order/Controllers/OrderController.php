<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Order\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mage2\Product\Models\Product;
use Mage2\Catalog\Models\ProductVariation;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Order\Mail\OrderInvoicedMail;
use Mage2\Order\Models\Order;
use Mage2\Order\Requests\PlaceOrderRequest;
use Mage2\Sale\Models\OrderStatus;
use Mage2\User\Models\User;
use Mage2\Order\Models\OrderProductVariation;

;
use Mage2\UserAddress\Models\Address;

class OrderController extends Controller
{
    public function adminindex()
    {
        $orders = Order::paginate(10);

        return view('order.index')
            ->with('orders', $orders);
    }

    public function place(PlaceOrderRequest $request)
    {

        $orderProductData = Session::get('cart');


        $user = $this->_getUser($request);

        $billingAddress = $this->_getBillingAddress($request);
        $shippingAddress = $this->_getShippingAddress($request);

        $orderStatus = OrderStatus::whereTitle('Pending')->get()->first();

        $data['shipping_address_id'] = $shippingAddress->id;
        $data['billing_address_id'] = $billingAddress->id;
        $data['user_id'] = $user->id;
        $data['shipping_option'] = $request->get('shipping_option');
        $data['payment_option'] = $request->get('payment_option');
        $data['order_status_id'] = $orderStatus->id;

        $order = Order::create($data);

        $this->syncOrderProductData($order, $orderProductData);

        Session::forget('cart');
        Session::forget('order_data');

        return redirect()->route('order.success', $order->id);

    }

    private function _getUser(Request $request)
    {
        if (Auth::check()) {
            return Auth::user();
        }


        $userData = $request->get('user');

        $user = User::where('email', '=', $userData['email'])->first();

        if (null === $user) {

            //register guest user as user with random password

        }


        Auth::login($user);

        return $user;

    }


    private function _getBillingAddress(Request $request)
    {

        $shippingData = $request->get('billing');

        $shippingData['type'] = 'BILLING';
        $shippingData['user_id'] = Auth::user()->id;

        if (isset($shippingData['id']) && $shippingData['id'] > 0) {
            $address = Address::findorfail($shippingData['id']);
            //$address->update($shippingData);
        } else {
            $address = Address::create($shippingData);
        }

        return $address;
    }


    private function _getShippingAddress(Request $request)
    {

        if (null == $request->get('use_different_shipping_address')) {
            $shippingData = $request->get('billing');
        } else {
            $shippingData = $request->get('shipping');
        }


        $shippingData['type'] = 'SHIPPING';
        $shippingData['user_id'] = Auth::user()->id;

        if (isset($shippingData['id']) && $shippingData['id'] > 0) {
            $address = Address::findorfail($shippingData['id']);
            //$address->update($shippingData);
        } else {
            $address = Address::create($shippingData);
        }

        return $address;
    }


    public function index()
    {
        $orderData = Session::get('order_data');
        $orderProductData = Session::get('cart');


        $orderStatus = OrderStatus::whereTitle('Pending')->get()->first();
        $orderData['order_status_id'] = $orderStatus->id;


        //$order = Order::create($orderData);
        $order = Order::find(1);

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

            if (isset($orderProduct['attributes'])) {
                foreach ($orderProduct['attributes'] as $attribute) {
                    $data = ['order_id' => $order->id, 'product_id' => $i, 'product_variation_id' => $attribute['variation_id']];

                    $productVariation = ProductVariation::findorfail($attribute['variation_id']);

                    $productVariation->update(['qty' => ($productVariation->qty - $orderProduct['qty'])]);
                    OrderProductVariation::create($data);
                }
            } else {

                $product = Product::findorfail($i);
                $product->update(['qty' => ($product->qty - $orderProduct['qty'])]);
            }

            unset($orderProduct['title']);
            unset($orderProduct['slug']);
            unset($orderProduct['image']);
            unset($orderProduct['id']);
            unset($orderProduct['attributes']);
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

        $path = public_path('/uploads/order/invoice/' . $order->id . '.pdf');
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));
        //Mail::send();
        //dd($view->render());die;
        //PDF::loadHTML($view->render())->save('my_stored_file.pdf')->stream('download.pdf');

        //return redirect()->back();
    }
}
