<?php

namespace Mage2\Ecommerce\Payment\Stripe;

use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Payment\Payment as PaymentEcommerce;
use Mage2\Ecommerce\Payment\PaymentInterface;
use Stripe\Stripe;
use Stripe\Charge;

class Payment extends PaymentEcommerce implements PaymentInterface
{
    /**
     * Payment Option Identifier
     *
     * @var string
     *
     */
    protected $identifier = "stripe";

    /**
     * Payment Option Name
     *
     * @var string
     *
     */
    protected $name = "Stripe";

    /**
     * Payment Option View
     *
     * @var string
     *
     */
    protected $view = "mage2-ecommerce::payment.stripe.index";


    public function isEnabled()
    {
        $isEnabled = Configuration::getConfiguration('mage2_stripe_enabled');
        if (null === $isEnabled || false == $isEnabled) {
            return false;
        }
        return true;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }


    public function getName()
    {
        return $this->name;
    }

    public function view()
    {
        return $this->view;
    }

    public function with()
    {
        $token = Configuration::getConfiguration("mage2_stripe_publishable_key");
        $data = ['token' => $token];
        return $data;
    }



    /*
     * Nothing to do
     *
     */
    public function process($orderData, $cartProducts = [], $request)
    {

        $subTotal = 0;
        $taxTotal = 0;

        foreach ($cartProducts as $product) {

            $subTotal += $product['price'] * $product['qty'];
            $taxTotal += $product['tax_amount'] * $product['qty'];
        }

        $totalCents = (integer)($subTotal + $taxTotal) * 100;
        $apiKey = Configuration::getConfiguration('mage2_stripe_secret_key');

        Stripe::setApiKey($apiKey);

        $response = Charge::create(array(
            "amount" => $totalCents,
            "currency" => "nzd",
            "source" => $request->get('stripeToken'), // obtained with Stripe.js
            "description" => "Mage2 E commerce"
        ));

        return $response;

    }

}