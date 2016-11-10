<?php

namespace Mage2\Home\ViewComposers;

use Illuminate\View\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;

class AdminNavComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $adminMenus = (array) AdminMenu::getMenuItems();
        $view->with('adminMenus', $adminMenus);
    }

}
