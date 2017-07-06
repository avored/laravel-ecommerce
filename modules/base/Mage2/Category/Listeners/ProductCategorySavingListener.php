<?php
namespace Mage2\Category\Listeners;


class ProductCategorySavingListener
{
    /**
     * Handle the event.
     *
     * @param  mag2 .user.registered  $event
     * @return void
     */
    public function handle($event)
    {

        $product = $event->product;
        $request = $event->request;

        if (count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
    }
}
