<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
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
