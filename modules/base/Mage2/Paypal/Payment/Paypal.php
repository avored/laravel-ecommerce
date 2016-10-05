<?php

namespace Mage2\Paypal\Payment;

use Mage2\Framework\Payment\PaymentInterface;
use Mage2\Framework\Payment\Payment as PaymentFramework;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Redirect;
use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;
use PayPal\Api\CreditCard;
use PayPal\Api\CreditCardToken;
use PayPal\Api\FlowConfig;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\InputFields;
use PayPal\Api\Links;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\PaymentHistory;
use PayPal\Api\Presentation;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Refund;
use PayPal\Api\RelatedResources;
use PayPal\Api\Sale;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Api\Transactions;
use PayPal\Api\WebProfile;
use PayPal\Core\PayPalConfigManager as PPConfigManager;
use PayPal\Rest\ApiContext;
use Mage2\Common\Models\Configuration;

class Paypal extends PaymentFramework implements PaymentInterface {

    protected $identifier;
    protected $title;
    private $_apiContext;

    public function __construct() {
        $this->identifier = "paypal";
        $this->title = "Paypal";
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getTitle() {
        return $this->title;
    }

    /*
     * Nothing to do
     * 
     */

    public function process($orderData, $cartProducts = []) {


        $this->setApiContext();

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $itemList = new ItemList();
        $total = 0;
        foreach ($cartProducts as $product) {
            $item = new Item();
            $model = $product['model'];
            
            $item->setName($model->title)
                    ->setCurrency('USD')
                    ->setQuantity($product['qty'])
                    ->setSku($model->sku) // Similar to `item_number` in Classic API
                    ->setPrice($product['price']);
            $itemList->addItem($item);
            $total += $product['price'];
        }

       

        $details = new Details();
        $details->setShipping(0.00)
                //->setTax(1.3)
                ->setSubtotal($total);


        $amount = new Amount();
        $amount->setCurrency("USD")
                ->setTotal($total)
                ->setDetails($details);



        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.store'));
        $redirectUrls->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return $redirectUrl;
    }

    public function setApiContext($clientId = null, $clientSecret = null, $requestId = null) {
        if (null === $clientId) {
            //$clientId  = config('paypal.api-client-d');

            $clientId = Configuration::getConfiguration('paypal_client_id');
            ;
        }
        if (null === $clientSecret) {
            //$clientSecret = config('paypal.api-client-secret');
            $clientSecret = Configuration::getConfiguration('paypal_client_secret');
            ;
            ;
        }

        $credentials = new OAuthTokenCredential($clientId, $clientSecret);

        $this->_apiContext = new ApiContext($credentials, $requestId);
        return $this;
    }

}
