<?php

namespace Mage2\Framework\Configuration\Facades;

use Illuminate\Support\Facades\Facade;

class AdminConfiguration extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Configuration\ConfigurationManager';
    }
}
