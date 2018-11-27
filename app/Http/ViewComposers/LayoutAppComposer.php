<?php

namespace App\Http\ViewComposers;

use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\MenuGroupInterface;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;

class LayoutAppComposer
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\SiteCurrencyRepository
     */
    protected $siteCurrencyRepository;

    public function __construct(
        MenuGroupInterface $menuGroupRepository,
        SiteCurrencyInterface $currencyRepository
    ) {
        $this->menuGroupRepository = $menuGroupRepository;
        $this->siteCurrencyRepository = $currencyRepository;
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
        $menuGroup = $this->menuGroupRepository->query()->whereIsDefault(1)->first();
        $currencies = $this->siteCurrencyRepository->options();
        $metaTitle = Configuration::getConfiguration('general_site_title');
        $metaDescription = Configuration::getConfiguration('general_site_description');

        $view->withMenus($menuGroup->menus)
            ->withCart($cart)
            ->withCurrencies($currencies)
            ->withMetaTitle($metaTitle)
            ->withMetaDescription($metaDescription);
    }
}
