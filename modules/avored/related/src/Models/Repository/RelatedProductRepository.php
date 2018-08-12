<?php

namespace AvoRed\Related\Models\Repository;

use AvoRed\Related\Models\Database\RelatedProduct;
use AvoRed\Related\Models\Contracts\RelatedProductInterface;

class RelatedProductRepository implements RelatedProductInterface
{
    /**
     * Find a Related Product by given Id
     *
     * @param $id
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function find($id)
    {
        return RelatedProduct::find($id);
    }
    /**
     * Find a Related Product by given Product Id
     *
     * @param $productId
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function findByProductId($productId)
    {
        return RelatedProduct::whereProductId($productId)->first();
    }
  

    /**
     * Find all Related Product by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return RelatedProduct::all();
    }

    /**
     * Paginate Related Product
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return RelatedProduct::paginate($noOfItem);
    }

    /**
     * Query Related Product 
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return RelatedProduct::query();
    }

    /**
     * Create a Related Product Record
     *
     * @return \AvoRed\Related\Models\RelatedProduct
     */
    public function create($data)
    {
        return RelatedProduct::create($data);
    }
}
