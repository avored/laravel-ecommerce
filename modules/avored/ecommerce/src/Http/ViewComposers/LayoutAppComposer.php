<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Models\Database\Category;
use Illuminate\View\View;
use AvoRed\Ecommerce\Models\Database\Configuration;

class LayoutAppComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $cart = (null === Session::get('cart')) ? 0 : count(Session::get('cart'));
        $categoryModel = new Category();
        $baseCategories = $categoryModel->getAllCategories();

        $metaTitle = Configuration::getConfiguration('general_site_title');
        $metaDescription = Configuration::getConfiguration('general_site_description');


        $view->with('categories', $baseCategories)
            ->with('cart', $cart)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }

}
