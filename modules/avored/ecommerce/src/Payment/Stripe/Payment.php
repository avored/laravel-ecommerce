<?php

namespace AvoRed\Ecommerce\Payment\Stripe;

use Stripe\Charge;
use Stripe\Stripe;
use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Framework\Payment\Payment as PaymentEcommerce;
use AvoRed\Framework\Payment\Contracts\Payment as PaymentContracts;

class Payment extends PaymentEcommerce implements PaymentContracts
{
    /**
     * Payment Option Identifier.
     *
     * @var string
     */
    protected $identifier = 'stripe';

    /**
     * Payment Option Name.
     *
     * @var string
     */
    protected $name = 'Stripe';

    /**
     * Payment Option View.
     *
     * @var string
     */
    protected $view = 'avored-ecommerce::payment.stripe.index';

    public function enable()
    {
        $model = new Configuration();
        $isEnabled = $model->getConfiguration('avored_stripe_enabled');
        if (null === $isEnabled || false == $isEnabled) {
            return false;
        }

        return true;
    }

    public function identifier()
    {
        return $this->identifier;
    }

    public function name()
    {
        return $this->name;
    }

    public function view()
    {
        return $this->view;
    }

    public function with()
    {
        $token = Configuration::getConfiguration('avored_stripe_publishable_key');
        $data = ['token' => $token];

        return $data;
    }

    /*
     * Nothing to do
     *
     */
    public function process($orderData, $cartProducts, $request)
    {
        $subTotal = 0;
        $taxTotal = 0;

        foreach ($cartProducts as $product) {
            $subTotal += $product['price'] * $product['qty'];
            $taxTotal += $product['tax_amount'] * $product['qty'];
        }

        $total = (round($subTotal, 2) + round($taxTotal, 2)) * 100;

        $totalCents = (int) $total;
        $apiKey = Configuration::getConfiguration('avored_stripe_secret_key');

        Stripe::setApiKey($apiKey);

        $response = Charge::create([
            'amount' => $totalCents,
            'currency' => 'nzd',
            'source' => $request->get('stripeToken'), // obtained with Stripe.js
            'description' => 'AvoRed E commerce',
        ]);

        return $response;
    }
}
