<?php

namespace App\Events;

use Mage2\Ecommerce\Models\Order;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderPlaced extends Event
{
    use SerializesModels;

    public $products;
    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order , $products = array())
    {
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
