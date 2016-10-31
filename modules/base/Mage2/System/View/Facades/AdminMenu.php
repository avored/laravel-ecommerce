<?php

namespace Mage2\System\View\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMenu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminMenu';
    }
}
