<?php

namespace App\Http\Controllers;

use Mage2\Admin\Eloquents\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

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
