<?php

namespace Mage2\System\Payment\Facade;

use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\System\Payment\PaymentManager';
    }
}
