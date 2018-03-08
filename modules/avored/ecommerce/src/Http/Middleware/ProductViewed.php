<?php
namespace AvoRed\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\Product;
use AvoRed\Ecommerce\Models\Database\UserViewedProduct;


class ProductViewed
{

    public function handle($request, Closure $next)
    {
        $route = $request->route();
        if('product.view' == $route->getName()) {
            if(Auth::check()) {
                $userId = Auth::user()->id;
                $slug = $route->parameter('slug');
                $product = Product::whereSlug($slug)->first();

                UserViewedProduct::create(['user_id' => $userId, 'product_id' => $product->id]);
            }
        }

        return $next($request);
    }
}
