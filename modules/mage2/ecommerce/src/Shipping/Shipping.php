<?php

namespace Mage2\Ecommerce\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
