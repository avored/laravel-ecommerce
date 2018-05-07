<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use AvoRed\Framework\Models\Database\Product as ProductModel;
use AvoRed\Framework\Cart\Facade as Cart;

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

        $slug   = $request->get('slug');
        $qty    = $request->get('qty', 1);


        Cart::add($slug, $qty);

        $productModel   = ProductModel::whereSlug($slug)->first();
        $isTaxEnabled   = Configuration::getConfiguration('tax_enabled');

        if($isTaxEnabled && $productModel->is_taxable) {

            $percentage = Configuration::getConfiguration('tax_percentage');
            $taxAmount = ($percentage * $productModel->price / 100);

            Cart::hasTax(true);
            Cart::updateProductTax($slug, $taxAmount);
        }

        return redirect()->back()->with('notificationText', 'Product Added to Cart Successfully!');


        $cart = (null === Session::get('cart')) ? Collection::make([]) : Session::get('cart');

        $product = ProductModel::whereSlug($slug)->first();

        $requestQty = $request->get('qty', 1);

        if (!$product->canAddtoCart($requestQty)) {

            return redirect()->back()->with('errorNotificationText', 'Not Enough Qty Available please try with less Qty!');
        }

        $productAttributes = [];

        if ($product->type == 'VARIATION' && null === $request->get('attribute')) {
            return redirect()->route('product.view', $product->slug);
        }

        if ($attributes = $request->get('attribute')) {
            foreach ($attributes as $attributeId => $subProductId) {


                $subProduct = ProductModel::find($subProductId);

                $productAttributeValue = ProductAttributeIntegerValue::whereProductId($subProductId)->whereAttributeId($attributeId)->first();

                $attribute = Attribute::findorfail($attributeId);
                $option = $attribute->attributeDropdownOptions()->where('id', '=', $productAttributeValue->value)->get()->first();

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

            $tmp = (isset($productAttributes [0])) ? $productAttributes[0] : null;

            $subProductPrice = ($tmp['attribute_price'] !== NULL) ? $tmp['attribute_price'] : 0.00;
            $price = $product->price;
            $finalPrice = $price + $subProductPrice;

            $subProductTaxAmount = ($tmp['attribute_tax_amount'] !== NULL) ? $tmp['attribute_tax_amount'] : 0.00;
            $taxAmount = $product->getTaxAmount();
            $finalTaxAmount = $taxAmount + $subProductTaxAmount;


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


    }

    public function view()
    {
        $cartProducts = Cart::all();

        return view('cart.view')
            ->with('cartProducts', $cartProducts);
    }

    public function update(Request $request)
    {

        Cart::update($request->get('slug'), $request->get('qty',1));

        return redirect()->back();
    }

    public function destroy($slug)
    {

        Cart::destroy($slug);

        return redirect()->back();
    }
}
