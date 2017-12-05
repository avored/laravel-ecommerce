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
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Models\Database\Order;
use Mage2\Ecommerce\Models\Database\Visitor;

class DashboardController extends AdminController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $visitorLabelCollection = Collection::make([]);
        $visitorValueCollection = Collection::make([]);
        $todaysDateCarbon = Carbon::today();

        for($i = 0; $i<=6; $i++) {

            $visitorCountForThatDay = Visitor::whereDay('created_at','=', $todaysDateCarbon->day)->get()->count();
            $visitorLabelCollection->push('"' .$todaysDateCarbon->format('d-M-y'). '"' );
            $visitorValueCollection->push($visitorCountForThatDay);

            $todaysDateCarbon->subDay(1);

        }

        $value = Configuration::getConfiguration('mage2_user_total');
        $totalRegisteredUser = (null === $value) ? 0 : $value;
        $totalOrder = Order::all()->count();

        return view('mage2-ecommerce::admin.home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('visitorLabelCollection', implode(",", $visitorLabelCollection->all()))
            ->with('visitorValueCollection', implode(",", $visitorValueCollection->all()))
            ->with('totalOrder', $totalOrder)
            ;
    }
}
