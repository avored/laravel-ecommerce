<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MyAccountSidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        $view->with('user', $user);
    }
}
