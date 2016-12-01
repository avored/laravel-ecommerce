<?php

namespace Mage2\Paypal\Payment;

use Mage2\System\Models\Configuration;
use Mage2\Framework\Payment\Payment as PaymentFramework;
use Mage2\Framework\Payment\PaymentInterface;
use Mage2\Framework\Shipping\Facades\Shipping;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Links;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Sale;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Paypal extends PaymentFramework implements PaymentInterface
{
    protected $identifier;
    protected $title;
    private $_apiContext;

    public function __construct()
    {
        $this->identifier = 'paypal';
        $this->title = 'Paypal';
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /*
     * Nothing to do
     *
     */

    public function process($orderData, $cartProducts = [])
    {
        $this->setApiContext();

        $this->_apiContext->setConfig([
            'mode'                   => Configuration::getConfiguration('paypal_payment_mode'),
            'service.EndPoint'       => Configuration::getConfiguration('paypal_payment_url'), //paypal_payment_log
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => Configuration::getConfiguration('paypal_payment_log'),
            'log.FileName'           => storage_path('logs/paypal.log'),
            'log.LogLevel'           => 'FINE',
        ]);


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();
        $subTotal = 0;
        $taxTotal = 0;
        foreach ($cartProducts as $product) {
            $item = new Item();
            $model = $product['model'];

            $item->setName($model->title)
                    ->setCurrency('USD')
                    ->setQuantity($product['qty'])
                    ->setSku($model->sku) // Similar to `item_number` in Classic API
                    ->setPrice($product['price']);
            $itemList->addItem($item);
            $subTotal += $product['price'] * $product['qty'];
            $taxTotal += $product['tax_amount'] * $product['qty'];
        }

        $total = $subTotal + $taxTotal;

        $shippingOption = $orderData['shipping_method'];

        $shipping = Shipping::get($shippingOption);

        $details = new Details();
        $details->setShipping($shipping->getAmount())
                ->setTax($taxTotal)
                ->setSubtotal($subTotal);


        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal($total)
                ->setDetails($details);



        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Payment description')
                ->setInvoiceNumber(uniqid());


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.store'));
        $redirectUrls->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions([$transaction]);

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return $redirectUrl;
    }

    public function setApiContext($clientId = null, $clientSecret = null, $requestId = null)
    {
        if (null === $clientId) {
            //$clientId  = config('paypal.api-client-d');

            $clientId = Configuration::getConfiguration('paypal_client_id');
        }
        if (null === $clientSecret) {
            //$clientSecret = config('paypal.api-client-secret');
            $clientSecret = Configuration::getConfiguration('paypal_client_secret');
        }

        $credentials = new OAuthTokenCredential($clientId, $clientSecret);

        $this->_apiContext = new ApiContext($credentials, $requestId);

        return $this;
    }
}
