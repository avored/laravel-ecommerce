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


use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\OrderStatusRequest;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use PayPal\Api\Order;


class OrderStatusController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new OrderStatus());
    }

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('mage2saleadmin::order-status.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('mage2saleadmin::order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Order\Requests\OrderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {

        OrderStatus::create($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $orderStatus = OrderStatus::findorfail($id);

        return view('mage2saleadmin::order-status.edit')
            ->with('orderStatus', $orderStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Order\Requests\OrderStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, $id)
    {
        $orderStatus = OrderStatus::findorfail($id);

        $orderStatus->update($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        OrderStatus::destroy($id);
        return redirect()->route('admin.order-status.index');
    }
}
