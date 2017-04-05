<?php

namespace Mage2\Catalog\ViewComposers;

use Illuminate\Support\Collection;
use Mage2\Catalog\Models\ProductAttribute;
use Illuminate\View\View;

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
        $productAttributes = Collection::make(['' => 'Please Select'])->union(ProductAttribute::all()->pluck('title', 'id'));

        $extraAttributes = ProductAttribute::where('is_system','=', 0)->where('use_as_variation','=',0)->get();

        $view->with('productAttributes', $productAttributes)
            ->with('extraAttributes', $extraAttributes)
        ;
    }

}
