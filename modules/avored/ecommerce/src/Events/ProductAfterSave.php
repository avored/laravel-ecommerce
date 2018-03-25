<?php

namespace AvoRed\Ecommerce\Events;

use Illuminate\Queue\SerializesModels;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use AvoRed\Ecommerce\Http\Requests\ProductRequest;

class ProductAfterSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product = null;

    public $request = null;

    /**
     * Create a new event instance.
     *
     * @param \AvoRed\Ecommerce\Models\Database\Product $product
     * @param \AvoRed\Ecommerce\Http\Requests\ProductRequest $request
     */
    public function __construct(Product $product, ProductRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }
}
