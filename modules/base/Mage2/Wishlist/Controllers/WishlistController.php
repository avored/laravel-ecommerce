<?php

namespace Mage2\Wishlist\Controllers;

use Mage2\Wishlist\Models\Wishlist;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware(['frontauth']);
    }

    public function add($id) {
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'website_id' => $this->websiteId,
            'product_id' => $id
        ]);

        return redirect()->back();
    }

    public function mylist() {
        $wishlists = Wishlist::where([
                    'user_id' => Auth::user()->id,
                    'website_id' => $this->websiteId
                ])->get();



        return view('my-account.wishlist')
                    ->with('wishlists', $wishlists);
    }

    public function remove($id) {
        Wishlist::where([
            'user_id' => Auth::user()->id,
            'website_id' => $this->websiteId,
            'product_id' => $id
        ])->delete();

        return redirect()->back();
    }
}
