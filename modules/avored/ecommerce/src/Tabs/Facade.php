<?php
namespace Mage2\Ecommerce\Tabs;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Ecommerce\Tabs\TabsMaker';
    }
}
