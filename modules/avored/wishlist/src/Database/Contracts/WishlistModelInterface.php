<?php

namespace AvoRed\Wishlist\Database\Contracts;

use AvoRed\Framework\Database\Models\Customer;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Wishlist\Database\Models\Wishlist;

interface WishlistModelInterface
{
    /**
     * Create Wishlist Resource into a database.
     * @param array $data
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function create(array $data) : Wishlist;

    /**
     * Find Wishlist Resource into a database.
     * @param int $id
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function find(int $id) : Wishlist;

    /**
     * Find Wishlist Resource into a database.
     * @param Customer $customer
     * @param int $productId
     * @return \AvoRed\Wishlist\Database\Models\Wishlist $wishlist
     */
    public function getWishlistByProductId(Customer $customer, int $productId) : Wishlist;

    /**
     * Find Wishlist Resource into a database.
     * @param Customer $customer
     * @param int $productId
     * @return bool
     */
    public function customerHasProduct(Customer $customer, int $productId) : bool;

    /**
     * Delete Wishlist Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Wishlist from the database.
     * @return \Illuminate\Database\Eloquent\Collection $wishlists
     */
    public function all() : Collection;

    /**
     * Get All Wishlist of the logged in user.
     * @param Customer $customer
     * @param array $with
     * @return \Illuminate\Support\Collection $wishlists
     */
    public function customerWishlists(Customer $customer, $with = []) : SupportCollection;
}
