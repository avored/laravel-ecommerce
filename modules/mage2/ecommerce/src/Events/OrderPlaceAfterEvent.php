<?php
namespace Mage2\Ecommerce\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Mage2\Order\Models\Order;

class OrderPlaceAfterEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /***
     * Mage2 Order Model
     *
     * @var \Mage2\Ecommerce\Models\Database\Order
     *
     */
    public $order = NULL;

    public $orderProducts = NULL;

    public $request = NULL;
    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(Order $order, $orderProducts , $request)
    {
        $this->order = $order;
        $this->orderProducts = $orderProducts;
        $this->request = $request;
    }
}
