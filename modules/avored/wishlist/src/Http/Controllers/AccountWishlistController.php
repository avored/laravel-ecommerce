<?php

namespace AvoRed\Wishlist\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use Illuminate\Support\Facades\Auth;

class AccountWishlistController extends Controller
{
    /**
     * @var \AvoRed\Wishlist\Database\Repository\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * home controller construct.
     */
    public function __construct(
        WishlistModelInterface $wishlistRepository
    ) {
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Account Wishlist Index Resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $wishlists = $this->wishlistRepository->customerWishlists($customer, 'product');
        
        return view('avored-wishlist::account.wishlist.index')
            ->with('wishlists', $wishlists);
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
