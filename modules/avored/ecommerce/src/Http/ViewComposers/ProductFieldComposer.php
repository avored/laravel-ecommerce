<?php
namespace AvoRed\Attribute\ViewComposers;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use AvoRed\Attribute\Models\Attribute;
use AvoRed\Framework\Tabs\Facades\Tabs;

class ProductFieldComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        $product = $view->product;
        if ("VARIATION" == $product->type) {

            Tabs::add('product-variation')
                ->setType('product')
                ->setLabel('Variation')
                ->setViewpath('avored-attribute::product.variation');

            $variations = Attribute::whereUseAs('VARIATION')->get();

            $productAttributes = Attribute::whereUseAs('SPECIFICATION')->get();

            $view->with('productAttributes', $productAttributes)
                ->with('variations', $variations);
        }
        /**
         * Tabs::add('product-attribute')
         * ->setType('product')
         * ->setLabel('Attribute')
         * ->setViewpath('avored-attribute::product.product-save');
         *
         *
         *
         *
         * //$productAttributes = Collection::make(['' => 'Please Select'])->union(ProductAttribute::all()->pluck('title', 'id'));
         *
         *
         * ;
         */
    }

}
