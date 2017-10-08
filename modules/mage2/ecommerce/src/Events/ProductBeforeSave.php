<?php
namespace Mage2\Ecommerce\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Mage2\Ecommerce\Http\Requests\ProductRequest;

class ProductBeforeSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product = null;

    public $request = null;

    /**
     * Create a new event instance.
     *
     * @param \Mage2\Ecommerce\Http\Requests\ProductRequest $request
     */
    public function __construct(ProductRequest $request)
    {
        $this->request = $request;
    }
}
