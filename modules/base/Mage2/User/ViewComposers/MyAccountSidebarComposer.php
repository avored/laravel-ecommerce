<?php

namespace Mage2\User\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MyAccountSidebarComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
         $user = Auth::user();
            $view->with('user', $user);
    }

}
