<?php

namespace AvoRed\Banner\Models\Contracts;

interface BannerInterface
{
    /**
     * Find a Banner by given Id which returns Banner Model
     *
     * @param $id
     * @return \AvoRed\Banner\Models\Banner
     */
    public function find($id);

    /**
     * Find an All  Banner which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Banner Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Banner Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an Banner
     *
     * @param array $data
     * @return \AvoRed\Banner\Models\Banner
     */
    public function create($data);
}
