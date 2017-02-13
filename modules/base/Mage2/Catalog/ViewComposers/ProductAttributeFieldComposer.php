<?php

namespace Mage2\Catalog\ViewComposers;

use Illuminate\View\View;
use Mage2\Catalog\Models\ProductAttributeGroup;

class ProductAttributeFieldComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {

        $productAttributeGroupOptions  =  ProductAttributeGroup::all()->pluck('title','id');


            $view
                    ->with('productAttributeGroupOptions', $productAttributeGroupOptions);

    }

}
