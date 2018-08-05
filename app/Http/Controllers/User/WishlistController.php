<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\Wishlist;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($slug)
    {
        $product = Product::whereSlug($slug)->first();
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('notificationText', 'Product Added into your Wishlist Successfully!!');
    }

    /**
     * Display Wishlist List inside my account page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mylist()
    {
        $wishlists = Wishlist::whereUserId(Auth::user()->id)->get();

        return view('wishlist.my-account.wishlist')
            ->with('wishlists', $wishlists);
    }

    /**
     *  Destroy Product from user Wish list.
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $product = Product::whereSlug($slug)->first();

        Wishlist::whereUserId(Auth::user()->id)->whereProductId($product->id)->delete();

        return redirect()->back()->with('notificationText', 'Product Removed from your Wishlist Successfully!!');
    }
}
