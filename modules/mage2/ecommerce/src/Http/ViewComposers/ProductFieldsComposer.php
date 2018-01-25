<?php
namespace Mage2\Ecommerce\Http\ViewComposers;

use Mage2\Ecommerce\Models\Database\Category;
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

        $categoryOptions = Category::pluck('name', 'id');
        $storageOptions = [];//Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions',$storageOptions);

    }

}
