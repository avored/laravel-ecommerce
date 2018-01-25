<?php
namespace Mage2\Ecommerce\Permission;

use Illuminate\Support\Collection;

class Manager {
    
    /**
     * Collect all the Permissions from all the modules
     * 
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;
    
    public function __construct() {
        $this->permissions = Collection::make([]);
    }

    public function all() {

        //dd($this->permissions);
        return $this->permissions;
    }
    /**
     * Add Permission Array into Collection
     * 
     * @param array $item
     * @return \Mage2\Ecommerce\Permission\Manager
     */
    public function add($item) {
        //$this->permissions->push($item);
        return $this;
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */

    public function get($key) {

        if($this->permissions->has($key)) {
            return $this->permissions->get($key);
        }

        return $collection = Collection::make([]);

    }
    /**
     * Get Permission Collection if exists or Return Empty Collection
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */

    public function set($key , $permissionCollection) {

        //dd($permissionCollection);
        $this->permissions->put($key, $permissionCollection);
        return $this;

    }

}