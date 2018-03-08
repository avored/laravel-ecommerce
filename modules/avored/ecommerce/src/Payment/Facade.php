<?php
namespace AvoRed\Ecommerce\Payment;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'AvoRed\Ecommerce\Payment\Manager';
    }
}
