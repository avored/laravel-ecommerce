<?php
namespace AvoRed\Ecommerce\Models\Contracts;

interface AdminUserInterface {


    /**
     * Find an Admin User by given Id which returns Admin User
     * 
     * @param $id
     * @return \AvoRed\Ecommerce\Models\AdminUser
     */
    public function find($id);


    /**
     * Find an All Admin Users which returns Eloquent Collection
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();


    /**
     * Admin User Collection with Limit which returns paginate class
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Admin User Query 
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();


    /**
     * Create anAdmin User 
     * 
     * @param array $data
     * @return \AvoRed\Ecommerce\Models\AdminUser
     */
    public function create($data);

}