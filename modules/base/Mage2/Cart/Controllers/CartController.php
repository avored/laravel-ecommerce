<?php

namespace Mage2\Cart\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addToCart(Request $request, $id)
    {
        
        $cart = Session::get('cart');
        $product = Product::findorfail($id);

        if(null !== $request->get('qty') && !isset($cart[$id])) {
             $cart [$id] = ['id'          => $id,
                            'qty'        => $request->get('qty'),
                            'price'      => $product->price,
                            'tax_amount' => $product->getTaxAmount(),
                            'model'      => $product,
                        ];
        } elseif (null !== $request->get('qty') && isset($cart[$id])) {
            $cart[$id]['qty'] += $request->get('qty');
        } elseif(null === $request->get('qty') && isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart [$id] = ['id'          => $id,
                            'qty'        => 1,
                            'price'      => $product->price,
                            'tax_amount' => $product->getTaxAmount(),
                            'model'      => $product,
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
