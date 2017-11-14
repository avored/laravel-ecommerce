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
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Ecommerce\Models\Database\Attribute;
use Mage2\Ecommerce\Models\Database\Product;
use Illuminate\Support\Collection;
use Mage2\Ecommerce\Models\Database\ProductAttributeValue;

class CartController extends Controller
{
    /**
     *
     * Add To Cart Product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {


        $cart = (null === Session::get('cart')) ? Collection::make([]) : Session::get('cart');


        $product = Product::where('slug', '=', $request->get('slug'))->first();
        $productAttributes = [];

        if ($product->has_variation == 1 && null === $request->get('attribute')) {
            return redirect()->route('product.view', $product->slug);
        }

        if ($attributes = $request->get('attribute')) {
            foreach ($attributes as $attributeId => $subProductId) {


                $subProduct = Product::find($subProductId);

                $productAttributeValue = ProductAttributeValue::whereProductId($subProductId)->whereAttributeId($attributeId)->first();

                $attribute = Attribute::findorfail($attributeId);
                $option = $attribute->attributeDropdownOptions()->where('id','=',$productAttributeValue->value)->get()->first();

                $productAttributes[] = [
                                'attribute_id' => $attributeId,
                                'attribute_dropdown_option_id' => $productAttributeValue->value,
                                'attribute_price' => $subProduct->price,
                                'attribute_tax_amount' => $subProduct->getTaxAmount(),
                                'variation_display_text' => $option->display_text
                            ];
            }
        }

        $qty = (null === $request->get('qty')) ? 1 : $request->get('qty');


        if ($cart->has($product->id)) {

            $item = $cart->pull($product->id);
            $item['qty'] += $qty;
            $cart->put($product->id, $item);

        } else {

            $tmp  = (isset($productAttributes [0])) ? $productAttributes[0] : null;

            $subProductPrice = ($tmp['attribute_price'] !== NULL) ? $tmp['attribute_price'] : 0.00;
            $price = $product->price;
            $finalPrice = $price + $subProductPrice;

            $subProductTaxAmount = ($tmp['attribute_tax_amount'] !== NULL) ? $tmp['attribute_tax_amount'] : 0.00;
            $taxAmount = $product->getTaxAmount();
            $finalTaxAmount = $taxAmount+ $subProductTaxAmount;


            $cart->put($product->id, [
                'id' => $product->id,
                'qty' => $qty,
                'price' => $price,
                'final_price' => $finalPrice,
                'tax_amount' => $finalTaxAmount,
                'image' => $product->image->smallUrl,
                'name' => $product->name,
                'slug' => $product->slug,
                'attributes' => $productAttributes,
            ]);
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('notificationText', 'Product Added to Cart Successfully!');
    }

    public function view()
    {
        $cartProducts = Session::get('cart');

        return view('cart.view')
            ->with('cartProducts', $cartProducts);
    }

    public function update(Request $request)
    {
        $cartData = Session::get('cart');

        if ($request->get('qty') == 0) {
            //unset($cartData[$request->get('id')]);
            $cartData->pull($request->get('id'));

        } else {

            $item = $cartData->pull($request->get('id'));
            $item['qty'] = $request->get('qty');
            $cartData->put($request->get('id'), $item);
        }
        Session::put('cart', $cartData);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $cartData = Session::get('cart');
        $cartData->pull($id);

        Session::put('cart', $cartData);

        return redirect()->back();
    }
}
