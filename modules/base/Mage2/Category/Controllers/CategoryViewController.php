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
namespace Mage2\Category\Controllers;

use Illuminate\Http\Request;
use Mage2\Category\Models\Category;
use Mage2\Product\Models\Product;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\Controller;

class CategoryViewController extends Controller
{

    public function view(Request $request, $slug)
    {
        $productsOnCategoryPage = Configuration::getConfiguration('mage2_catalog_no_of_product_category_page');
        //$productsOnCategoryPage = 1;

        $category = Category::where('slug', '=', $slug)->get()->first();

        $collections = Product::getCollection()
            ->addCategoryFilter($category->id);

        foreach ($request->except(['page']) as $attributeIdentifier => $value) {
            $attribute = ProductAttribute::where('identifier', '=', $attributeIdentifier)->first();

            $collections->addAttributeFilter($attribute->id, $value);
        }

        $categoryProducts = $collections->paginateCollection($productsOnCategoryPage);

        //$categoryProducts->withPath(route('category.view', [$slug]))->appends($request->except(['page']));

        return view('catalog.category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $categoryProducts);

    }
}
