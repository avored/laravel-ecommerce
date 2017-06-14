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

namespace Mage2\OrderReturn\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mage2\OrderReturn\Models\OrderReturnRequest;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Mage2\OrderReturn\Models\OrderReturnRequestMessage;

class OrderReturnController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new OrderReturnRequest());
    }

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mage2orderreturn::admin.order-return.index');
    }

    /**
     * Admin Show Order Return Request so Admin Can take decision on it.
     *
     * @param $id
     *
     */
    public function show($id) {

        $orderReturnRequet = OrderReturnRequest::find($id);

        return view('mage2orderreturn::admin.order-return.show')
                        ->with('orderReturnRequest', $orderReturnRequet);
    }

    public function update(Request $request, $id) {

        $user = Auth::user();


        $orderReturnRequest = OrderReturnRequest::find($id);

        $orderReturnRequest->update(['status' => $request->get('status')]);

        OrderReturnRequestMessage::create(['order_return_request_id' => $orderReturnRequest->id,
                                            'message_text' => $request->get('message_text'),
                                            'user_id' => $user->id,
                                            'user_type' => 'ADMIN_USER'
                                        ]);

        return redirect()->route('admin.order-return.index');
    }
}
