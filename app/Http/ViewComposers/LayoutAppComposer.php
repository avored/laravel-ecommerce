<?php

namespace App\Http\ViewComposers;

use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\MenuInterface;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;

class LayoutAppComposer
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\SiteCurrencyRepository
     */
    protected $siteCurrencyRepository;

    public function __construct(
            MenuInterface $repository,
            SiteCurrencyInterface $currencyRepository
        ) {
        $this->repository = $repository;
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

        $menus = $this->repository->parentsAll();
        $currencies = $this->siteCurrencyRepository->options();

        $metaTitle = Configuration::getConfiguration('general_site_title');
        $metaDescription = Configuration::getConfiguration('general_site_description');

        $view->with('menus', $menus)
            ->with('cart', $cart)
            ->with('currencies', $currencies)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }
}
