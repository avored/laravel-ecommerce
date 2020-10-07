<?php

namespace AvoRed\Wishlist\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;
    /**
     * @var \AvoRed\Wishlist\Database\Repository\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * home controller construct.
     */
    public function __construct(
        ProductModelInterface $productRepository,
        WishlistModelInterface $wishlistRepository
    ) {
        $this->productRepository = $productRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Construct for the  Wishlist Controller
     * @param \Illuminate\Http\Request $request
     * @param string $productSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = $this->productRepository->findBySlug($request->get('slug'));
        $customer = Auth::guard('customer')->user();
        
        if (!$this->wishlistRepository->customerHasProduct($customer, $product->id)) {
            $data = ['product_id' => $product->id, 'customer_id' => Auth::guard('customer')->user()->id];
            $this->wishlistRepository->create($data);
        }
        
        return redirect()
            ->back()
            ->with('notificationText', __('a-wishlist.wishlist.saveNotificationText'));
    }

    /**
     * Construct for the  Wishlist Controller
     * @param \Illuminate\Http\Request $request
     * @param string $productSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $product = $this->productRepository->findBySlug($request->get('slug'));
        $customer = Auth::guard('customer')->user();
        $this->wishlistRepository->getWishlistByProductId($customer, $product->id)->delete();
        
        return redirect()
            ->back()
            ->with('notificationText', __('a-wishlist.wishlist.destroyNotificationText'));
    }
}
