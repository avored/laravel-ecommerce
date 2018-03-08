<?php
namespace AvoRed\Ecommerce\Tabs;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'AvoRed\Ecommerce\Tabs\TabsMaker';
    }
}
