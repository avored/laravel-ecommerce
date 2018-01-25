<?php
namespace Mage2\Ecommerce\Http\ViewComposers;

use Mage2\Ecommerce\Models\Database\Category;
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
