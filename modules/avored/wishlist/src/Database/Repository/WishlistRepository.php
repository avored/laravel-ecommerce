<?php

namespace AvoRed\Wishlist\Database\Repository;

use AvoRed\Framework\Database\Models\Customer;
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
     * @param Customer $customer
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Collection $wishlists
     */
    public function customerWishlists(Customer $customer, $with = []) : SupportCollection
    {
        return Wishlist::with($with)->whereCustomerId($customer->id)->get();
    }

    /**
     * Find Wishlist Resource into a database.
     * @param Customer $customer
     * @param int $productId
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function getWishlistByProductId(Customer $customer, int $productId) : Wishlist
    {
        return Wishlist::select('id')
            ->whereProductId($productId)
            ->whereCustomerId($customer->id)
            ->first();
    }
    
    /**
     * Find Wishlist Resource into a database.
     * @param int $productId
     * @return bool
     */
    public function customerHasProduct(Customer $customer, int $productId) : bool
    {
        $count =  Wishlist::select('id')->whereProductId($productId)->whereCustomerId($customer->id)->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }
}
