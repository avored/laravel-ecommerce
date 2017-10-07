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
namespace Mage2\Order\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Order\Mail\OrderInvoicedMail;
use Mage2\Order\Models\Order;
use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\UpdateOrderStatusRequest;
use Mage2\User\Models\User;
use Mage2\Order\Mail\UpdateOrderStatusMail;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Illuminate\Support\Facades\File;


class OrderController extends AdminController
{

    public function index()
    {
        $dataGrid = DataGrid::model(Order::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('shipping_option')
            ->column('payment_option')
            ->linkColumn('order_status',['label' => 'Order Status'], function($model) {
                return $model->orderStatus->name;
            })
            ->linkColumn('view',[], function($model) {
                return "<a href='". route('admin.order.view', $model->id)."' >View</a>";
            });

        return view('mage2-order::order.index')->with('dataGrid', $dataGrid);
    }

    public function view($id)
    {
        $order = Order::findorfail($id);
        $view = view('mage2-order::order.view')->with('order', $order);

        return $view;
    }

    public function sendEmailInvoice($id)
    {
        $order = Order::findorfail($id);
        $user = User::find($order->user_id);

        $view = view('mail.order.pdf')->with('order', $order);

        $folderPath = public_path('uploads/order/invoice');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, '0775', true);
        }
        $path = $folderPath . DIRECTORY_SEPARATOR . $order->id . '.pdf';
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));

        return redirect()->back()->with('notificationText', "Email Sent Successfully!!");
    }

    public function changeStatus($id)
    {
        $order = Order::findorfail($id);

        $orderStatus = OrderStatus::all()->pluck('title', 'id');

        $view = view('mage2-order::order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    public function updateStatus($id, UpdateOrderStatusRequest $request)
    {
        $order = Order::findorfail($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->order_status_title;

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
