<?php
namespace Mage2\Ecommerce\Payment;

interface PaymentInterface
{
    public function getIdentifier();

    public function getTitle();

    public function isEnabled();
}
