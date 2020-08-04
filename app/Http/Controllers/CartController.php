<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use AvoRed\Framework\Support\Facades\Cart;
use Illuminate\Support\Facades\Session;
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
        if ($request->get('promotion_code') !== null) {
            Cart::applyCoupon($request->get('promotion_code'));

			// Add an if-else condition into the applyCoupon function 
			// to check the return value of promotionModel variable.
			// If the return value is not null, the applyCoupon codes keep executing.
			// Else the return value is null, the webpage will trigger the alert box
            // to inform the user regarding the invalid coupon.

            // The modified code is displayed at below as the changes could not be done
            // directly to the package service provider
            //The path of this function is found at :
            // C:\wamp64\www\YC\laravel-ecommerce\vendor\avored\framework\src\Cart\Manager.php

            // public function applyCoupon(string $code)
            // {
            //     $promotionModel = $this->promotionCodeRepository->findByCode($code);
                
            //     if($promotionModel!=null)
            //     {
            //     $this->promotionList->push($promotionModel);
        
            //     $message = __('avored::catalog.promotion_code_errot_notification');
            //     if ($promotionModel->type === 'FIXED') {
            //         $this->totalDiscount = $promotionModel->amount;
            //         $message = __('avored::catalog.promotion_code_success_notification');
            //     }
        
            //     $this->sessionManager->put(
            //         $this->getPromotionKey(),
            //         ['total' => $this->totalDiscount, 'list' => $this->promotionList]
            //     );
        
            //     return $message;
            //     }
            //     else
            //     {
            //         echo '<script>alert("Invalid Coupon")</script>';
            //     }
            // }

			
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
