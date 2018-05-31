<?php
namespace AvoRed\Ecommerce\Models\Repository;

use AvoRed\Ecommerce\Models\Contracts\AdminUserInterface;
use AvoRed\Ecommerce\Models\Database\AdminUser;

class AdminUserRepository implements AdminUserInterface{

    /**
     * Find an Admin User by given Id
     * 
     * @param $id
     * @return \AvoRed\Ecommerce\Models\AdminUser
     */
    public function find($id) 
    {
       return AdminUser::find($id); 
    }
    
    /**
     * Find an Admin User by given Id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() 
    {
        return AdminUser::all(); 
    }

    /**
     * Paginate Admin User
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10) 
    {
        return AdminUser::paginate($noOfItem); 
    }

    /**
     * Find an Admin User Query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() 
    {
        return AdminUser::query(); 
    }

    /**
     * Find an Admin User Query
     * 
     * @return \AvoRed\Ecommerce\Models\AdminUser
     */
    public function create($data) 
    {
        return AdminUser::create($data); 
    }

}