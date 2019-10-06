<?php

namespace AvoRed\Review\Database\Repository;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Review\Database\Models\ProductReview;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;

class ProductReviewRepository implements ProductReviewModelInterface
{
    /**
     * Create ProductReview Resource into a database.
     * @param array $data
     * @return \AvoRed\Review\Database\Models\ProductReview $review
     */
    public function create(array $data): ProductReview
    {
        return ProductReview::create($data);
    }

    /**
     * Find ProductReview Resource into a database.
     * @param int $id
     * @return \AvoRed\Review\Database\Models\ProductReview $review
     */
    public function find(int $id): ProductReview
    {
        return ProductReview::find($id);
    }

    /**
     * Delete ProductReview Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return ProductReview::destroy($id);
    }

    /**
     * Get all the reviewes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $reviews
     */
    public function all() : Collection
    {
        return ProductReview::all();
    }

    /**
     * Get all the reviewes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $reviews
     */
    public function getAllReviewsByProductId(int $productId) : SupportCollection
    {
        return ProductReview::whereProductId($productId)->get();
    }
}
