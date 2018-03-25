<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\AdminMenu\Facade as AdminMenu;

class AdminNavComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $adminMenus = (array) AdminMenu::getMenuItems();
        $view->with('adminMenus', $adminMenus);
    }
}
