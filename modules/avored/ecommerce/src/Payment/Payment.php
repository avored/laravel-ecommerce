<?php
namespace AvoRed\Ecommerce\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts, $request);
}
