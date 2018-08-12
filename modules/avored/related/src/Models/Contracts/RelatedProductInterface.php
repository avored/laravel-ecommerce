<?php

namespace AvoRed\Related\Models\Contracts;

interface RelatedProductInterface
{
    /**
     * Find a Related Product by given Id which returns Related Product Model
     *
     * @param $id
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function find($id);

    /**
     * Find a Related Product by given Product Id which returns Related Product Model
     *
     * @param $productId
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function findByProductId($productId);

    /**
     * Find an All RelatedProduct which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * RelatedProduct Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Related Product Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an RelatedProduct
     *
     * @param array $data
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function create($data);
}
