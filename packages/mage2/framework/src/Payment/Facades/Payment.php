<?php

namespace Mage2\Framework\Payment\Facades;

use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Payment\PaymentManager';
    }
}
