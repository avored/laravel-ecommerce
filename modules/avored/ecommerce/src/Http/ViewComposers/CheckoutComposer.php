<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Repository\Page;
use AvoRed\Ecommerce\Repository\Config;
use Illuminate\Support\Facades\Session;

class CheckoutComposer
{
    /*
    * AvoRed Framework Category Repository
    *
    * @var \AvoRed\Framework\Repository\Product
    */
    public $configRepository;

    /*
   * AvoRed Framework Category Repository
   *
   * @var \AvoRed\Ecommerce\Repository\Page
   */
    public $pageRepository;

    public function __construct(Page $repository, Config $configRepository)
    {
        $this->pageRepository = $repository;
        $this->configRepository = $configRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $termConditionPageUrl = '#';

        $user = Auth::user();

        $pageId = $this->configRepository->model()->getConfiguration('general_term_condition_page');

        if (null !== $pageId) {
            $page = $this->pageRepository->findPageById($pageId);
            $termConditionPageUrl = route('page.show', $page->slug);
        }

        $cartProducts = Session::get('cart');
        $view->with('cartProducts', $cartProducts)
            ->with('user', $user)
            ->with('termConditionPageUrl', $termConditionPageUrl);
    }
}
