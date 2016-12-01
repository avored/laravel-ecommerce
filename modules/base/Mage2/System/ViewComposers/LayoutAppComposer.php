<?php

namespace Mage2\System\ViewComposers;

use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Category;
use Illuminate\View\View;

class LayoutAppComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $cart = count(Session::get('cart'));
        $categoryModel = new Category();
        $baseCategories = $categoryModel->getAllCategories();

        $view->with('categories', $baseCategories)
                ->with('cart', $cart);
    }

}
