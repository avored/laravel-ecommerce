<?php

namespace Mage2\Cart\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Product;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVariation;
use Mage2\Framework\System\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

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
