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

namespace Mage2\Wishlist\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Product\Models\Product;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Wishlist\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($slug)
    {

        $id = $this->getProductIdBySlug($slug);
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('notificationText', "Product Added into your Wishlist Successfully!!");
    }

    /**
     * @return mixed
     */
    public function mylist()
    {
        $wishlists = Wishlist::where([
            'user_id' => Auth::user()->id
        ])->get();


        return view('wishlist.my-account.wishlist')
            ->with('wishlists', $wishlists);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Wishlist::where([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ])->delete();

        return redirect()->back()->with('notificationText', 'Product Removed from your Wishlist Successfully!!');;
    }

    /**
     * Return Product By Slug
     * @param $slug
     * @return null
     */
    protected function getProductIdBySlug($slug)
    {
        $product = Product::whereSlug($slug)->first();

        if (!empty($product)) {
            return $product->id;
        }

        return null;
    }
}
