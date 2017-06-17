<?php

namespace Mage2\Framework\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
