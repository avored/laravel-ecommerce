<?php

namespace AvoRed\Ecommerce\Models\Contracts;

interface MenuInterface
{
    /**
     * Find an Menu by given Id which returns Menu
     *
     * @param $id
     * @return \AvoRed\Ecommerce\Models\Menu
     */
    public function find($id);

    /**
     * Find an All Menu which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get Collection for All Parents Menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parentsAll();

    /**
     * Get Collection for All Parents Menu
     *
     * @param array $menus
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function truncateAndCreateMenus($menus);

    /**
     * Menu Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Menu Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a Menu
     *
     * @param array $data
     * @return \AvoRed\Ecommerce\Models\Menu
     */
    public function create($data);
}
