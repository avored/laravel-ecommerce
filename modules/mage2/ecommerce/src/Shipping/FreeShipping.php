<?php
namespace Mage2\Ecommerce\Shipping;

use Illuminate\Support\Facades\Session;

class FreeShipping extends Shipping implements ShippingInterface
{
    /**
     * Identifier for the Shipping Options
     * @var string
     */
    protected $identifier;

    /**
     * Title for the Shipping Options
     * @var string
     */

    protected $title;

    /**
     * Amount for the Shipping Options
     * @var string
     */
    protected $amount;

    /**
     * Set up default title and identifier
     *
     * return @void
     */
    public function __construct()
    {
        $this->identifier = 'freeshipping';
        $this->title = 'Free Shipping';
    }

    /**
     * Get the identifier
     *
     * return string $identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get the Title
     *
     * return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Calculate and Return the Amount
     *
     * return float $amount
     */
    public function getAmount()
    {
        $orderData = Session::get('order_data');
        $cartProducts = Session::get('cart');
        $this->process($orderData, $cartProducts);

        return $this->amount;
    }

    /**
     * Processing Amount for this Shipping Option
     *
     * return float $amount
     */
    public function process($orderData, $cartProducts)
    {
        //execute the shipping api here
        $this->amount = 0.00;
        return $this;
    }
}
