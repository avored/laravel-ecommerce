<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Models\Contracts\MenuGroupInterface;

class MyAccountSidebarComposer
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    public function __construct(MenuGroupInterface $menuGroupRepository)
    {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menuGroup = $this->menuGroupRepository->query()->whereIdentifier('my-account')->first();
        $view->withUser(Auth::user())
            ->withMenus($menuGroup->menus);
    }
}
