<?php

namespace Mage2\System\Theme\Facade;

use Illuminate\Support\Facades\Facade;

class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Theme';
    }
}
