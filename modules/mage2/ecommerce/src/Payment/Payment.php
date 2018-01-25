<?php
namespace Mage2\Ecommerce\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}
