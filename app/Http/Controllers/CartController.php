<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class CartController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ProductRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $configurationRepository;

    public function __construct(ProductInterface $repository, ConfigurationInterface $configRep)
    {
        parent::__construct();

        $this->repository = $repository;
        $this->configurationRepository = $configRep;
    }

    /**
     *
     * Add To Cart Product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        $slug = $request->get('slug');

        $qty = abs($request->get('qty', 1));

        $attribute = $request->get('attribute', null);

        if (!Cart::canAddToCart($slug, $qty, $attribute)) {
            return redirect()->back()
                ->with(
                    'errorNotificationText',
                    'Not Enough Qty Available. Please with less qty or Contact site Administrator!'
                );
        }

        Cart::add($slug, $qty, $attribute);
        $this->setTaxAmount($slug, $qty, $attribute);

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
        $slug = $request->get('slug');
        $qty = abs($request->get('qty', 1));
        if (!Cart::canAddToCart($slug, $qty)) {
            return redirect()->back()->with('errorNotificationText', 'Not Enough Qty Available. Please with less qty or Contact site Administrator!');
        }

        Cart::update($slug, $qty);

        $this->setTaxAmount($slug, $qty);

        return redirect()->back();
    }

    public function destroy($slug)
    {
        Cart::destroy($slug);
        return redirect()->back()->with('notificationText', 'Product has been removed from Cart!');
    }

    /**
     * Set the Tax Amount for the Product
     *
     * @param string $slug
     * @param int $qty
     * @param array $attributes
     * @return self $this
     */
    private function setTaxAmount($slug, $qty = 1, $attributes = [])
    {
        $productModel = $this->repository->findBySlug($slug);
        $isTaxEnabled = $this->configurationRepository->getValueByKey('tax_enabled');

        if ($isTaxEnabled && $productModel->is_taxable) {
            $percentage = $this->configurationRepository->getValueByKey('tax_percentage');

            if (null !== $attributes) {
                foreach ($attributes as $attributeId => $productId) {
                    $productModel = $this->repository->find($productId);
                }
            }

            $taxAmount = ($percentage * $productModel->price / 100) * $qty;
            Cart::hasTax(true);
            Cart::updateProductTax($slug, $taxAmount);
        }

        return $this;
    }
}
