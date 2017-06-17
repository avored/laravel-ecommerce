<?php

namespace Mage2\Framework\Theme\Facades;

use Illuminate\Support\Facades\Facade;

class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
