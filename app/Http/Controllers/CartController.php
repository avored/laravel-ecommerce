<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use App\Http\Requests\CartRequest;
use AvoRed\Framework\Support\Facades\Cart;

class CartController extends Controller
{
    /**
     * Product Add To Cart
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addToCart(CartRequest $request)
    {
        Cart::add($request->get('slug'), $request->get('qty'));

        return redirect()
            ->back()
            ->with('success', __('Product Added to cart successfully!'));
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $cartProducts = Cart::all();

        return view('cart.show')->with('cartProducts', $cartProducts);
    }
}
