<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderPlaced extends Event
{
    use SerializesModels;

    public $products;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($products = array())
    {
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
