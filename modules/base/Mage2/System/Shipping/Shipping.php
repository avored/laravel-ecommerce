<?php

namespace Mage2\System\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
