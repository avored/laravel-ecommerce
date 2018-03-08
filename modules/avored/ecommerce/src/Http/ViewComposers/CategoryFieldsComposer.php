<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Category;
use Illuminate\View\View;

class CategoryFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::getCategoryOptions('name', 'id');
        $view->with('categoryOptions', $categoryOptions);
    }

}
