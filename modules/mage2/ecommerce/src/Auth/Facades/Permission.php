<?php
namespace Mage2\Framework\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Auth\Access\PermissionManager';
    }
}