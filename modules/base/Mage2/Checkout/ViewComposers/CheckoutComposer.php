<?php

namespace Mage2\Checkout\ViewComposers;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cartProducts = Session::get('cart');
        $view->with('cartProducts',$cartProducts);
    }
}