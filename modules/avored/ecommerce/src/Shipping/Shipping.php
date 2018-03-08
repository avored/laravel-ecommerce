<?php
namespace AvoRed\Ecommerce\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
