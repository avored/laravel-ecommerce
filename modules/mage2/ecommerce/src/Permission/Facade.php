<?php
namespace Mage2\Ecommerce\Permission;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Ecommerce\Permission\Manager';
    }
}