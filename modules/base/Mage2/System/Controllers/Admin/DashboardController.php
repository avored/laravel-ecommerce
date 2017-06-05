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

namespace Mage2\System\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Order\Models\OrderStatus;
use Mage2\System\Models\Configuration;
use Mage2\Order\Models\Order;

class DashboardController extends AdminController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalRegisteredUser = Configuration::getConfiguration('mage2_user_total');

        $pendingStatus = OrderStatus::whereTitle('Pending')->first();
        $totalPendingOrders = Order::whereOrderStatusId($pendingStatus->id)->count();

        $processingStatus = OrderStatus::whereTitle('Processing')->first();
        $totalProcessingOrders = Order::whereOrderStatusId($processingStatus->id)->count();
        return view('mage2system::admin.home')
                        ->with('totalRegisteredUser',$totalRegisteredUser)
                        ->with('totalPendingOrders',$totalPendingOrders)
                        ->with('totalProcessingOrders',$totalProcessingOrders);
    }
}
