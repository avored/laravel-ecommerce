<?php
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
