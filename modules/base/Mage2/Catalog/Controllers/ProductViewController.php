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
namespace Mage2\Catalog\Controllers;

use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Controllers\Controller;

class ProductViewController extends Controller
{
    public function view($slug)
    {
        $product = $this->_getProductBySlug($slug);


        $view = view('catalog.product.view')
            ->with('metaTitle', 'test')
            ->with('product', $product);

        $title = $product->page_title;
        $description = $product->page_description;

        if ($title != '') {
            $view->with('title', $title);
        }
        if ($description != '') {
            $view->with('description', $description);
        }

        return $view;
    }

    private function _getProductBySlug($slug)
    {
        $product = Product::where('slug', '=', $slug)->get()->first();

        return $product;
    }
}
