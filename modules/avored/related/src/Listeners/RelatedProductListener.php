<?php

namespace AvoRed\Related\Listeners;

use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Related\Models\Contracts\RelatedProductInterface;

class RelatedProductListener
{
    /**
     * Handle the event.
     *
     * @param  \AvoRed\Framework\Events\ProductAfterSave  $event
     * @return void
     */
    public function handle(ProductAfterSave $event)
    {
        $productId = $event->product->id;
        $relatedProducts = isset($event->data['related']) ? $event->data['related'] : [];

        if (count($relatedProducts) > 0) {
            $relatedProductRepository = app(RelatedProductInterface::class);
            $row = $relatedProductRepository->findByProductId($productId);
            $row->delete();

            foreach ($relatedProducts as $relatedId => $checkedValue) {
                if ($checkedValue == 1) {
                    $relatedProductRepository->create([
                        'product_id' => $productId,
                        'related_id' => $relatedId
                        ]);
                }
            }
        }
    }
}
