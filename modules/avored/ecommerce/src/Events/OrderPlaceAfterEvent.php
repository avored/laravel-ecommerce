<?php
namespace AvoRed\Ecommerce\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use AvoRed\Ecommerce\Models\Database\Order;

class OrderPlaceAfterEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /***
     * AvoRed Order Model
     *
     * @var \AvoRed\Ecommerce\Models\Database\Order
     *
     */
    public $order;

    public $orderProducts;

    public $request;
    /**
     * Create a new event instance.
     *
     * @param \AvoRed\Ecommerce\Models\Database\Order $order
     * @param array $orderProducts
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Order $order, $orderProducts , $request)
    {
        $this->order = $order;
        $this->orderProducts = $orderProducts;
        $this->request = $request;
    }
}
