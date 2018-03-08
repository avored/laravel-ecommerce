<?php
namespace AvoRed\Ecommerce\Modules;

use Illuminate\Support\Facades\Facade as LaraveFacade;

class Facade extends LaraveFacade
{
    protected static function getFacadeAccessor()
    {
        return 'module';
    }
}
