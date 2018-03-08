<?php
namespace AvoRed\Ecommerce\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Models\Database\Product;
use AvoRed\Ecommerce\Models\Database\GiftCoupon;

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
