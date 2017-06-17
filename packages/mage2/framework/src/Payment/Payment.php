<?php

namespace Mage2\Framework\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}
