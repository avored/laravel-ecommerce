<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Database\Order;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value = Configuration::getConfiguration('avored_user_total');
        $totalRegisteredUser = (null === $value) ? 0 : $value;

        $totalOrder = Order::all()->count();

        return view('avored-ecommerce::home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('totalOrder', $totalOrder);
    }
}
