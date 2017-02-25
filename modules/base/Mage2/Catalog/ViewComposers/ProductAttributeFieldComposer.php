<?php

namespace Mage2\Catalog\ViewComposers;

use Illuminate\View\View;
use Mage2\Catalog\Models\ProductAttributeGroup;
use Mage2\Catalog\Models\ProductOption;

class ProductAttributeFieldComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {

        $productAttributeGroupOptions  =  ProductAttributeGroup::where('identifier','=','extra-attributes')->pluck('title','id');




            $view
                    ->with('productAttributeGroupOptions', $productAttributeGroupOptions)
                ;

    }

}
