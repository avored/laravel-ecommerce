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

namespace Mage2\Cart\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Product;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVariation;
use Mage2\Framework\System\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $cart = Session::get('cart');
        $product = Product::where('slug', '=', $request->get('slug'))->first();
        $attribute = [];

        if ($product->has_variation == 1 && null === $request->get('attribute')) {
            return redirect()->route('product.view', $product->slug);
        }

        if ($attributes = $request->get('attribute')) {
            foreach ($attributes as $attributeId => $subProductId) {

                $subProduct = Product::find($subProductId);
                $productVariation = ProductVariation::where('product_attribute_id', '=', $attributeId)
                    ->where('sub_product_id', '=', $subProductId)->first();

                $attribute[] = ['attribute_id' => $attributeId,
                    'variation_id' => $productVariation->id,
                    'variation_display_text' => $subProduct->title
                ];
            }
        }

        if (null !== $request->get('qty') && !isset($cart[$product->id])) {
            $cart [$product->id] = ['id' => $product->id,
                'qty' => $request->get('qty'),
                'price' => $product->price,
                'tax_amount' => $product->getTaxAmount(),
                'image' => $product->image,
                'title' => $product->title,
                'slug' => $product->slug,
                'attributes' => $attribute,
            ];
        } elseif (null !== $request->get('qty') && isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $request->get('qty');
        } elseif (null === $request->get('qty') && isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += 1;
        } else {
            $cart [$product->id] = ['id' => $product->id,
                'qty' => 1,
                'price' => $product->price,
                'tax_amount' => $product->getTaxAmount(),
                'image' => $product->image,
                'title' => $product->title,
                'slug' => $product->slug,
                'attributes' => $attribute,
            ];
        }
        Session::put('cart', $cart);

        return redirect()->back()->with('notificationText', 'Product Added to Cart Successfully!');
    }

    public function view()
    {
        $cartProducts = Session::get('cart');

        return view('cart.cart.view')
            ->with('cartProducts', $cartProducts);
    }

    public function update(Request $request)
    {
        $cartData = Session::get('cart');

        if ($request->get('qty') == 0) {
            unset($cartData[$request->get('id')]);
        } else {
            $cartData[$request->get('id')] ['qty'] = $request->get('qty');
        }
        Session::put('cart', $cartData);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $cartData = Session::get('cart');
        unset($cartData[$id]);

        Session::put('cart', $cartData);

        return redirect()->back();
    }
}
