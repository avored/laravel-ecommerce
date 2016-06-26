<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Mage2\Ecommerce\Models\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlacedListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        foreach($event->products as $product) {
            $productModel = Product::findorfail($product['id']);
            $productModel->qty = $productModel->qty - $product['qty'];
            $productModel->update();
        }
    }
}
