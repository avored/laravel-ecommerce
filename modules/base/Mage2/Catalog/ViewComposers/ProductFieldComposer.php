<?php

namespace Mage2\Catalog\ViewComposers;

use Illuminate\Support\Collection;
use Mage2\Catalog\Models\ProductOption;
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
        $productOptions = Collection::make(['' => 'Please Select'])->union(ProductOption::all()->pluck('title', 'id'));
        $view->with('productOptions', $productOptions);
    }

}
