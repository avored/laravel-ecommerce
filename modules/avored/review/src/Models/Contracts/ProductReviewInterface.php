<?php

namespace AvoRed\Review\Models\Contracts;

interface ProductReviewInterface
{
    /**
     * Find a Subscribe User by given Id which returns Subscribe Model
     *
     * @param $id
     * @return \AvoRed\Subscribe\Models\Subscribe
     */
    public function find($id);

    /**
     * Find an All  Subscribe User which returns Eloquent Collection
     *
     * @param $prodctId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByProductId($productId);
    /**
     * Find an All  Subscribe User which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Subscribe Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Subscribe Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an Subscribe
     *
     * @param array $data
     * @return \AvoRed\Subscribe\Models\Subscribe
     */
    public function create($data);
}
