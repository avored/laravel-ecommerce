<?php
namespace Mage2\Framework\Auth\Access;

use Illuminate\Support\Collection;

class PermissionManager
{

    /**
     * Collect all the Permissions from all the modules
     *
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;

    public function __construct()
    {
        $this->permissions = Collection::make([]);
    }

    public function all()
    {
        return $this->permissions;
    }

    /**
     * Add Permission Array into Collection
     *
     * @param array $item
     * @return \Mage2\Framework\Auth\Access\Permission
     */
    public function add($item)
    {
        $this->permissions->push($item);
        return $this;
    }
}