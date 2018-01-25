<?php
namespace Mage2\Ecommerce\Theme;

use Illuminate\Support\Facades\Facade as LaraveFacade;

class Facade extends LaraveFacade
{
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
