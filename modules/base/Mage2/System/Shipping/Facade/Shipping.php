<?php

namespace Mage2\System\Shipping\Facade;

use Illuminate\Support\Facades\Facade;

class Shipping extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\System\Shipping\ShippingManager';
    }
}
