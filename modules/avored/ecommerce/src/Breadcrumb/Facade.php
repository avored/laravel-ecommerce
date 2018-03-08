<?php
namespace AvoRed\Ecommerce\Breadcrumb;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
