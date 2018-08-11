<?php

namespace AvoRed\Subscribe\Models\Repository;

use AvoRed\Subscribe\Models\Database\Subscribe;
use AvoRed\Subscribe\Models\Contracts\SubscribeInterface;

class SubscribeRepository implements SubscribeInterface
{
    /**
     * Find a Subscribe  by given Id
     *
     * @param $id
     * @return \AvoRed\Subscribe\Models\Subscribe
     */
    public function find($id)
    {
        return Subscribe::find($id);
    }

    /**
     * Find all Subscribe by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Subscribe::all();
    }

    /**
     * Paginate Subscribe
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Subscribe::paginate($noOfItem);
    }

    /**
     * Query Subscribe 
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Subscribe::query();
    }

    /**
     * Create a Subscribe Record
     *
     * @return \AvoRed\Subscribe\Models\Subscribe
     */
    public function create($data)
    {
        return Subscribe::create($data);
    }
}
