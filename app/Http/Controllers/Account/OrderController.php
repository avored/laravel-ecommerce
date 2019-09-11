<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;

class OrderController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $orderRepository;

    /**
     * Order Controller construct.
     * @param \AvoRed\Framework\Database\Repository\CountryRepository $countryRepository
     * @param \AvoRed\Framework\Database\Repository\OrderRepository $orderRepository
     */
    public function __construct(
        OrderModelInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userOrders = $this->orderRepository->findByUserId(Auth::user()->id);

        return view('account.order.index')
            ->with(compact('userOrders'));
    }

    /**
     * Display the specified resource.
     *
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('account.order.show')
            ->with(compact('order'));
    }
}
