<?php

namespace AvoRed\Ecommerce\Models\Contracts;

interface RoleInterface
{
    /**
     * Find an Role by given Id which returns Role
     *
     * @param $id
     * @return \AvoRed\Ecommerce\Models\Role
     */
    public function find($id);

    /**
     * Find an All Role which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Role Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Role Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a Role
     *
     * @param array $data
     * @return \AvoRed\Ecommerce\Models\Role
     */
    public function create($data);
}
