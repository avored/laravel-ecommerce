<?php

namespace App\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Models\Contracts\MenuInterface;

class LayoutAppComposer
{
    /**
     *
     * @var \AvoRed\Ecommerce\Models\Repository\MenuRepository
     */
    protected $repository;

    public function __construct(MenuInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $cart = (null === Session::get('cart')) ? 0 : count(Session::get('cart'));

        $menus = $this->repository->parentsAll();

        $metaTitle = Configuration::getConfiguration('general_site_title');
        $metaDescription = Configuration::getConfiguration('general_site_description');

        $view->with('menus', $menus)
            ->with('cart', $cart)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }
}
