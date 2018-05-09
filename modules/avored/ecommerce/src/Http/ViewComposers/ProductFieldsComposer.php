<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Framework\Models\Database\Category;
use Illuminate\View\View;

class ProductFieldsComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::getCategoryOptions();
        $storageOptions = []; //Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions', $storageOptions);
    }
}
