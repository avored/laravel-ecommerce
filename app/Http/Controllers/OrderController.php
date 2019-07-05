<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Models\Order;

class OrderController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\AddressRepository
     */
    protected $addressRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $oderRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $oderStatusRepository;

    /**
     * User Model
     * @var \App\User
     */
    protected $user;

    /**
     * User Shipping Address Model
     * @var \AvoRed\Framework\Database\Models\Address
     */
    protected $shippingAddress;

    /**
     * Order Status Model
     * @var \AvoRed\Framework\Database\Models\OrderStatus
     */
    protected $orderStatus;

    /**
     * User Billing Address Model
     * @var \AvoRed\Framework\Database\Models\Address
     */
    protected $billingAddress;

    /**
     * order controller construct
     * @param \AvoRed\Framework\Database\Contracts\AddressModelInterface
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface
     * @param \AvoRed\Framework\Database\Contracts\OrderStatusModelInterface
     */
    public function __construct(
        AddressModelInterface $addressRepository,
        OrderModelInterface $orderRepository,
        OrderStatusModelInterface $orderStatusRepository
    ) {
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->oderStatusRepository = $orderStatusRepository;
    }

    /**
     * Place the Order .
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place(Request $request)
    {
        $this->user($request);
        $this->shippingAddress($request);
        $this->billingAddress($request);
        $this->orderStatus();

        $orderData = [
            'shipping_option' => $request->get('shipping_option'),
            'payment_option' => $request->get('payment_option'),
            'order_status_id' => $this->orderStatus->id,
            'currency_code' => 'usd',
            'user_id' => $this->user->id,
            'shipping_address_id' => $this->shippingAddress->id,
            'billing_address_id' => $this->billingAddress->id,
        ];
        $order = $this->orderRepository->create($orderData);
        // $this->syncProducts($order, $request);
        
        return redirect()
            ->route('order.successful', $order->id)
            ->with('success', 'Order Placed Successfuly!');
    }

    /**
     * Create/Get User to placed an Order
     * @return self
     */
    public function user($request)
    {
        $email = $request->get('email');

        $this->user = User::whereEmail($email)->first();

        if ($this->user === null) {
            dd('@todo create user');
        }

        return $this;
    }

    /**
     * Create/Get User to placed an Order
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function shippingAddress($request)
    {
        $addressData = $request->get('shipping');
        $addressData['type'] = 'SHIPPING';
        $addressData['user_id'] = $this->user->id;
        
        $this->shippingAddress = $this->addressRepository->create($addressData);
        return $this;
    }

    /**
     * Create/Get User to placed an Order
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function billingAddress($request)
    {
        $flag = $request->get('use_different_address');
        if ($flag == 'true') {
            dd('todo create a billing address here');
        } else {
            $this->billingAddress = $this->shippingAddress;
        }

        return $this;
    }

    /**
     * Set Default Order Status Model
     * @return \AvoRed\Framework\Database\Models\Address $addressModel
     */
    public function orderStatus()
    {
        $this->orderStatus = $this->oderStatusRepository->findDefault();
    }

    /**
     * Successfull Page Display
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return \Illuminate\Response\Renderable
     */
    public function successful(Order $oder)
    {
        return view('order.successful');
    }
}
