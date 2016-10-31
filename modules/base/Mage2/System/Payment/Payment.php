<?php

namespace Mage2\System\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}
