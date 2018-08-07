<?php

namespace AvoRed\Banner\Models\Repository;

use AvoRed\Banner\Models\Database\Banner;
use AvoRed\Banner\Models\Contracts\BannerInterface;

class BannerRepository implements BannerInterface
{
    /**
     * Find a Banner by given Id
     *
     * @param $id
     * @return \AvoRed\Banner\Models\Banner
     */
    public function find($id)
    {
        return Banner::find($id);
    }

    /**
     * Find a Banner by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Banner::all();
    }

    /**
     * Paginate Banner
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Banner::paginate($noOfItem);
    }

    /**
     * Find a Banner Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Banner::query();
    }

    /**
     * Find a Banner Query
     *
     * @return \AvoRed\Banner\Models\Banner
     */
    public function create($data)
    {
        return Banner::create($data);
    }
}
