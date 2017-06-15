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
namespace Mage2\Feature\Helpers;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVarcharValue;
use Illuminate\Support\Collection;
use Mage2\Product\Models\Product;


class FeatureProductHelper
{

    public function getFeaturedProducts()
    {
        $products = Collection::make([]);
        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->first();

        $attributeDropdownOption = $attribute->attributeDropdownOptions()->where('product_attribute_id', '=', $attribute->id)->where('display_text', '=', 'Yes')->first();

        $productIds = ProductVarcharValue::where('value', '=', $attributeDropdownOption->id)->get()->pluck('product_id');

        foreach ($productIds as $productId) {

            $product = Product::findorfail($productId);

            $products->push($product);
        }

        return $products;

    }
}
