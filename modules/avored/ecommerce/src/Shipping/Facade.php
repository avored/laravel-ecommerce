<?php
namespace AvoRed\Ecommerce\Shipping;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'AvoRed\Ecommerce\Shipping\Manager';
    }
}
