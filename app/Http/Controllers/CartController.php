<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use AvoRed\Framework\Support\Facades\Cart;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    /**
     * Product Add To Cart.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addToCart(CartRequest $request)
    {
        list($success, $message) = Cart::add($request->get('slug'), $request->get('qty'), $request->get('attributes'));

        return redirect()
            ->back()
            ->with(compact('success', 'message'));
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        if ($request->get('promotion_code') !== null) {
            Cart::applyCoupon($request->get('promotion_code'));
        }
        $cartProducts = Cart::all();

        return view('cart.show')->with(compact('cartProducts'));
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request)
    {
        $cartProducts = $request->get('products');
        foreach ($cartProducts as $product) {
            $slug = Arr::get($product, 'slug');
            Cart::destroy($slug);
        }
        
        return response()->json(['success' => true, 'message' => 'Product Destroyed from Cart Successfully']);
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $cartProducts = $request->get('products');
        foreach ($cartProducts as $product) {
            $slug = Arr::get($product, 'slug');
            $qty = Arr::get($product, 'qty');
            Cart::update($slug, $qty);
        }
        
        return response()->json(['success' => true, 'message' => 'Product Update from Cart Successfully']);
    }
}
