<?php

namespace AvoRed\Review\Models\Repository;

use AvoRed\Review\Models\Contracts\ProductReviewInterface;
use AvoRed\Review\Models\Database\ProductReview;

class ProductReviewRepository implements ProductReviewInterface
{
    /**
     * Find a Review  by given Id
     *
     * @param $id
     * @return \AvoRed\Review\Models\ProductReview
     */
    public function find($id)
    {
        return ProductReview::find($id);
    }
    /**
     * Find a Reviews  by given Product Id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByProductId($productId)
    {
        return ProductReview::whereProductId($productId)->get();
    }

    /**
     * Find all Reviews
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ProductReview::all();
    }

    /**
     * Paginate Product Review
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return ProductReview::paginate($noOfItem);
    }

    /**
     * Query Product Review 
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return ProductReview::query();
    }

    /**
     * Create a Product Record
     *
     * @return \AvoRed\Review\Models\ProductReview
     */
    public function create($data)
    {
        return ProductReview::create($data);
    }
}
