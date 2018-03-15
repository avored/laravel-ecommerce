<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Repository\Order;
use AvoRed\Ecommerce\Repository\Config;
use AvoRed\Ecommerce\Models\Database\Visitor;

class DashboardController extends AdminController
{
    /**
     * AvoRed Attribute Repository
     *
     * @var \AvoRed\Framework\Repository\Order
     */
    protected $orderRepository;

    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Config
     */
    protected $configRepository;

    /**
     * Cart Controller constructor to Set AvoRed Product Repository Property.
     *
     * @param \AvoRed\Framework\Repository\Order $repository
     * @param \AvoRed\Ecommerce\Repository\Config
     * @return void
     */
    public function __construct(Order $repository, Config $configRepository)
    {
        $this->orderRepository  = $repository;
        $this->configRepository = $configRepository;
    }



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

        $value = $this->configRepository->model()->getConfiguration('avored_user_total');
        $totalRegisteredUser = (null === $value) ? 0 : $value;
        $totalOrder = $this->orderRepository->model()->all()->count();

        return view('avored-ecommerce::admin.home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('visitorLabelCollection', implode(",", $visitorLabelCollection->all()))
            ->with('visitorValueCollection', implode(",", $visitorValueCollection->all()))
            ->with('totalOrder', $totalOrder)
            ;
    }
}
