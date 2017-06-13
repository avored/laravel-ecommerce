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

namespace Mage2\User\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\User\Models\Wishlist;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVarcharValue;

class WishlistController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['frontauth']);
    }

    public function add($slug)
    {

        $id = $this->_getProductIdBySlug($slug);
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('notificationText', "Product Added into your Wishlist Successfully!!");
    }

    public function mylist()
    {
        $wishlists = Wishlist::where([
            'user_id' => Auth::user()->id
        ])->get();


        return view('wishlist.my-account.wishlist')
            ->with('wishlists', $wishlists);
    }

    public function remove($slug)
    {

        $id = $this->_getProductIdBySlug($slug);

        Wishlist::where([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ])->delete();

        return redirect()->back()->with('notificationText', "Product Removed from your Wishlist Successfully!!");;
    }

    private function _getProductIdBySlug($slug)
    {
        $slugAttribute = ProductAttribute::where('identifier', '=', 'slug')->first();
        $productVarcharValue = ProductVarcharValue::where('value', '=', $slug);
        if (!empty($slugAttribute)) {
            $productVarcharValue = $productVarcharValue->where('product_attribute_id', '=', $slugAttribute->id);
        }
        $productVarcharValue = $productVarcharValue->first();

        if (!empty($productVarcharValue)) {
            return $productVarcharValue->product_id;
        }

        $product = Product::where('slug', $slug)->first();
        return $product->id;
    }
}
