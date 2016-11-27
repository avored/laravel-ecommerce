<?php

namespace Mage2\Wishlist\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Wishlist\Models\Wishlist;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Attribute\Models\ProductVarcharValue;

class WishlistController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware(['frontauth']);
    }

    public function add($slug) {
        
        $id = $this->_getProductIdBySlug($slug);
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'website_id' => $this->websiteId,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('notificationText', "Product Added into your Wishlist Successfully!!");
    }

    public function mylist() {
        $wishlists = Wishlist::where([
                    'user_id' => Auth::user()->id,
                    'website_id' => $this->websiteId,
                ])->get();




        return view('wishlist.my-account.wishlist')
                        ->with('wishlists', $wishlists);
    }

    public function remove($slug) {
        
        $id = $this->_getProductIdBySlug($slug);
        
        Wishlist::where([
            'user_id' => Auth::user()->id,
            'website_id' => $this->websiteId,
            'product_id' => $id,
        ])->delete();

        return redirect()->back()->with('notificationText', "Product Removed from your Wishlist Successfully!!");
        ;
    }

     private function _getProductIdBySlug($slug)
    {
        $slugAttribute = ProductAttribute::where('identifier', '=', 'slug')->get()->first();
        $productVarcharValue = ProductVarcharValue::where('product_attribute_id', '=', $slugAttribute->id)
                                                ->where('value', '=', $slug)
                                                ->where('website_id', '=', $this->websiteId)->get()->first();


        return $productVarcharValue->product_id;

    }
}
