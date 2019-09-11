<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;

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
        if (Auth::check()) {
            $menus = $this->menuGroupRepository->getTreeByIdentifier('main-auth-menu');
        } else {
            $menus = $this->menuGroupRepository->getTreeByIdentifier('main-menu');
        }

        $view->with(compact('menus'));
    }
}
