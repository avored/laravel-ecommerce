<?php

namespace App\Http\ViewComposers;

use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Models\Contracts\MenuInterface;
use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;

class LayoutAppComposer
{
    /**
     *
     * @var \AvoRed\Ecommerce\Models\Repository\MenuRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Ecommerce\Models\Repository\SiteCurrencyRepository
     */
    protected $curRep;

    public function __construct(MenuInterface $repository, 
                                SiteCurrencyInterface $currencyRepository
                            )
    {
        $this->repository = $repository;
        $this->curRep = $currencyRepository;
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

        $menus      = $this->repository->parentsAll();
        $currencies = $this->curRep->all();

        $metaTitle          = Configuration::getConfiguration('general_site_title');
        $metaDescription    = Configuration::getConfiguration('general_site_description');

        $view->with('menus', $menus)
            ->with('cart', $cart)
            ->with('currencies', $currencies)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }
}
