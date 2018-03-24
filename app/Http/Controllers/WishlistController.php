<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Repository\Product;
use AvoRed\Ecommerce\Repository\User;

class WishlistController extends Controller
{


    /**
     * AvoRed E commerce Product Repository
     *
     * @var \AvoRed\Framework\Repository\Product
     *
     */
    public $productRepository;

    /**
     * AvoRed E commerce User Repository
     *
     * @var \AvoRed\Ecommerce\Repository\User
     *
     */
    public $userRepository;
    /**
     * Wish list  Controller Setting Product Repository Property of Class.
     *
     * @var \AvoRed\Framework\Repository\Product
     * @return void
     */
    public function __construct(Product $repository, User $userRepository)
    {
        parent::__construct();
        $this->middleware('front.auth');

        $this->productRepository    = $repository;
        $this->userRepository       = $userRepository;

    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($slug)
    {

        $product = $this->productRepository->findProductBySlug($slug);
        $this->userRepository->wishlistModel()->create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('notificationText', "Product Added into your Wishlist Successfully!!");
    }

    /**
     * Display Wishlist List inside my account page.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mylist()
    {
        $wishlists = $this->userRepository->wishlistModel()->where([
            'user_id' => Auth::user()->id
        ])->get();


        return view('wishlist.my-account.wishlist')
            ->with('wishlists', $wishlists);
    }

    /**
     *  Destroy Product from user Wish list.
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);

        $this->userRepository->wishlistModel()->where([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ])->delete();

        return redirect()->back()->with('notificationText', 'Product Removed from your Wishlist Successfully!!');
    }

}
