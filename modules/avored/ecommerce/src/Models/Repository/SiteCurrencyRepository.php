<?php
namespace AvoRed\Ecommerce\Models\Repository;

use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Ecommerce\Models\Database\SiteCurrency;

class SiteCurrencyRepository implements SiteCurrencyInterface{

    /**
     * Find an Site Currency by given Id
     * 
     * @param $id
     * @return \AvoRed\Ecommerce\Models\SiteCurrency
     */
    public function find($id) 
    {
       return SiteCurrency::find($id); 
    }
    
    /**
     * Find an Site Currency by given Id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() 
    {
        return SiteCurrency::all(); 
    }

    /**
     * Paginate Site Currency
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10) 
    {
        return SiteCurrency::paginate($noOfItem); 
    }

    /**
     * Find an Site Currency Query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() 
    {
        return SiteCurrency::query(); 
    }

    /**
     * Find an Site Currency Query
     * 
     * @return \AvoRed\Ecommerce\Models\SiteCurrency
     */
    public function create($data) 
    {
        return SiteCurrency::create($data); 
    }

}