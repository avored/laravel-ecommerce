<?php
namespace Mage2\Product\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Mage2\Product\Models\Product;
use Mage2\Product\Requests\ProductRequest;


class ProductSavedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product = null;

    public $request = null;

    /**
     * Create a new event instance.
     *
     * @param \Mage2\Product\Models\Product $product
     * @param \Mage2\Product\Requests\ProductRequest $request
     */
    public function __construct(Product $product, ProductRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }
}
