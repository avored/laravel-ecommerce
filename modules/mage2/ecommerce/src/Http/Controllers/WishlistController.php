<?php
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Ecommerce\Models\Database\Product;
use Mage2\Ecommerce\Models\Database\Wishlist;

class WishlistController extends Controller
{
    /**
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($slug)
    {

        $product = Product::getProductBySlug($slug);
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('notificationText', "Product Added into your Wishlist Successfully!!");
    }

    /**
     * Display Wishlist List inside my account page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mylist()
    {
        $wishlists = Wishlist::where([
            'user_id' => Auth::user()->id
        ])->get();


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
        $product = Product::getProductBySlug($slug);

        Wishlist::where([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ])->delete();

        return redirect()->back()->with('notificationText', 'Product Removed from your Wishlist Successfully!!');
    }

}
