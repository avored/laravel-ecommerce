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

namespace Mage2\Sale\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Sale\Models\GiftCoupon;

class GiftCouponController extends Controller
{

    public function getCodeDiscount(Request $request)
    {

        $code = $request->get('code');

        if (true == empty($code)) {
            return Response::json(['success' => false, 'message' => "Code Can't be Empty"]);
        }


        $todayCarbonDate = Carbon::now();
        $giftCoupon = GiftCoupon::whereCode($code)->whereStatus('ENABLED')->where('end_date', '>', $todayCarbonDate)->first();
        if (null === $giftCoupon) {
            return Response::json(['success' => false, 'message' => "Invalid Coupon"]);
        }

        $cartItems = Session::get('cart');

        foreach ($cartItems as $id => $item) {

            $product = Product::findorfail($id);

            if (isset($item['gift_coupon_amount'])) {
                $price = $product->price;
            } else {
                $price = $item['price'];
            }


            $couponDiscount = ($price * $giftCoupon->discount / 100);
            $item['price'] = $price - $couponDiscount;
            $item['gift_coupon_code'] = $giftCoupon->code;
            $item['gift_coupon_amount'] = $couponDiscount;
            $item['tax_amount'] = $product->getTaxAmount($item['price']);

            $cartItems[$id] = $item;
        }

        Session::put('cart', $cartItems);
        return Response::json(['success' => true]);


    }
}
