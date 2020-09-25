<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use AvoRed\Framework\Database\Models\Menu;

class NavComposer
{
    /**
     * @var \AvoRed\Framework\Database\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * home controller construct.
     */
    public function __construct(
        MenuGroupModelInterface $menuGroupRepository
    ) {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compose(View $view)
    {
        if (Auth::guard('customer')->check()) {
            $menus = $this->menuGroupRepository->getTreeByIdentifier('main-auth-menu');
        } else {
            $menus = $this->menuGroupRepository->getTreeByIdentifier('main-menu');
        }

        foreach ($menus as $menu) {
            switch ($menu->type) {
                case Menu::CATEGORY : 
                    $menu->url = route('category.show', $menu->route_info);
                break;
                case Menu::FRONT_MENU : 
                    $menu->url = route($menu->route_info);
                break;
                case Menu::FRONT_MENU : 
                    $menu->url = url($menu->route_info);
                break;
            }
        }
        $view->with(compact('menus'));
    }
}
