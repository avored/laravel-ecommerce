<?php

namespace App\Http\Controllers;


use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\Http\Request;
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
