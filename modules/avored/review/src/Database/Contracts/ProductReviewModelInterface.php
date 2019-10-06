<?php

namespace AvoRed\Review\Database\Contracts;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Review\Database\Models\ProductReview;

interface ProductReviewModelInterface
{
    /**
     * Create ProductReview Resource into a database.
     * @param array $data
     * @return \AvoRed\Review\Database\Models\ProductReview $review
     */
    public function create(array $data) : ProductReview;

    /**
     * Find ProductReview Resource into a database.
     * @param int $id
     * @return \AvoRed\Review\Database\Models\ProductReview $review
     */
    public function find(int $id) : ProductReview;

    /**
     * Delete ProductReview Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All ProductReview from the database.
     * @return \Illuminate\Database\Eloquent\Collection $reviews
     */
    public function all() : Collection;

    /**
     * Get All ProductReview from the database by given Product Id.
     * @return \Illuminate\Support\Collection $reviews
     */
    public function getAllReviewsByProductId(int $productId) : SupportCollection;
}
