<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Framework\Models\Database\Category;
use Illuminate\View\View;

class CategoryFieldsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::getCategoryOptions();
        $view->with('categoryOptions', $categoryOptions);
    }
}
