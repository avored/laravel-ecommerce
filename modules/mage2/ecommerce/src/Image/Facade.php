<?php
namespace Mage2\Ecommerce\Image;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'image';
    }
}
