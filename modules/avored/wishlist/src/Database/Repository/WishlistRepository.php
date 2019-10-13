<?php

namespace AvoRed\Wishlist\Database\Repository;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Wishlist\Database\Models\Wishlist;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use Illuminate\Support\Facades\Auth;

class WishlistRepository implements WishlistModelInterface
{
    /**
     * Create Wishlist Resource into a database.
     * @param array $data
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function create(array $data): Wishlist
    {
        return Wishlist::create($data);
    }

    /**
     * Find Wishlist Resource into a database.
     * @param int $id
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function find(int $id): Wishlist
    {
        return Wishlist::find($id);
    }

    /**
     * Delete Wishlist Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Wishlist::destroy($id);
    }

    /**
     * Get all the wishlistes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $wishlists
     */
    public function all() : Collection
    {
        return Wishlist::all();
    }

    /**
     * Get all the wishlistes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $wishlists
     */
    public function userWishlists() : SupportCollection
    {
        $user = Auth::user();
        if ($user) {
            return Wishlist::whereUserId($user->id)->get();
        }

        return SupportCollection::make([]);
    }

    /**
     * Find Wishlist Resource into a database.
     * @param int $productId
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function getWishlistByProductId(int $productId) : Wishlist
    {
        $user = Auth::user();
        if ($user === null) {
            return null;
        }
        return Wishlist::select('id')->whereProductId($productId)->whereUserId($user->id)->first();
    }
    /**
     * Find Wishlist Resource into a database.
     * @param int $productId
     * @return bool
     */
    public function userHasProduct(int $productId) : bool
    {
        $user = Auth::user();
        if ($user === null) {
            return false;
        }
        $count =  Wishlist::select('id')->whereProductId($productId)->whereUserId($user->id)->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }
}
