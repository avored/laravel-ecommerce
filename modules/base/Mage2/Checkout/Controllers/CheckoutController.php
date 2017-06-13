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
namespace Mage2\Checkout\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mage2\User\Models\Address;
use Mage2\User\Requests\AddressRequest;
use Mage2\Checkout\Requests\CheckoutUserRequest;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Framework\Payment\Facades\Payment;
use Mage2\Framework\Shipping\Facades\Shipping;
use Mage2\TaxClass\Models\Country;
use Mage2\User\Models\User;
use Mage2\Checkout\Requests\ShippingOptionRequest;
use Mage2\Checkout\Requests\PaymentOptionRequest;

class CheckoutController extends Controller
{
    public function index()
    {

        $user = NULL;
        $shippingOptions = Shipping::all();
        $paymentOptions = Payment::all();
        $countries = [null => 'Please Select'] + Country::all()->pluck('name', 'id')->toArray();

        $cartItems = Session::get('cart');

        return view('checkout.new-index')
            ->with('cartItems', $cartItems)
            ->with('countries', $countries)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions);

        return view('checkout.index');
    }

}
