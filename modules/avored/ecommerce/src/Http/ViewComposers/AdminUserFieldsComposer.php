<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Role;
use Illuminate\View\View;

class AdminUserFieldsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $roles = Role::all();
        $view->with('roles', $roles);
    }
}
