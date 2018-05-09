<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

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
        $cart   = (null === Session::get('cart')) ? 0 : count(Session::get('cart'));
        $menus  = Menu::all();
        $metaTitle          = Configuration::getConfiguration('general_site_title');
        $metaDescription    = Configuration::getConfiguration('general_site_description');

        $view->with('menus', $menus)
            ->with('cart', $cart)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }
}
