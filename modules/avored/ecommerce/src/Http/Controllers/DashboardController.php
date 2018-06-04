<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Contracts\OrderInterface;

class DashboardController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderRepository
    */
    protected $repository;

    public function __construct(OrderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value = Configuration::getConfiguration('avored_user_total');
        $totalRegisteredUser = (null === $value) ? 0 : $value;

        $totalOrder = $this->repository->all()->count();

        return view('avored-ecommerce::home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('totalOrder', $totalOrder);
    }
}
