<?php

namespace Mage2\Framework\AdminMenu\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMenu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\AdminMenu\AdminMenuBuilder';
    }
}
