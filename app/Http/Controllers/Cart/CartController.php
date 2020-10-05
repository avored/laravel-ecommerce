<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use AvoRed\Framework\Support\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Product Add To Cart.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addToCart(CartRequest $request)
    {
        list($success, $message) = Cart::add(
            $request->get('slug'),
            $request->get('qty'),
            $request->get('attributes')
        );   

        $type = 'error';
        if ($success) {
            $type = 'success';
        }
        Session::flash('type', $type);
        Session::flash('message', $message);
            
        return redirect()
            ->back();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        $cartProducts = Cart::all();
        //var_dump($cartProducts);

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

    /**
     * Apply the Promotion Code into a cart
     * @param string $code
     * @return JsonResponse 
     */
    public function applyPromotionCode(string $code)
    {
        $message = Cart::applyCoupon($code);
    
        return ['message' => $message, 'success' => true];
    }
}
