<?php
namespace Mage2\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Models\Database\Page;
use Illuminate\Support\Facades\Auth;

class CheckoutComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $termConditionPageUrl = "#";

        $user = Auth::user();

        $pageId = Configuration::getConfiguration('general_term_condition_page');

        if (null !== $pageId) {
            $page = Page::find($pageId);
            $termConditionPageUrl = "/page/" . $page->slug;
        }


        $cartProducts = Session::get('cart');
        $view->with('cartProducts', $cartProducts)
            ->with('user', $user)
            ->with('termConditionPageUrl', $termConditionPageUrl);
    }
}