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
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Mage2\Ecommerce\Models\Database\Attribute;
use Mage2\Ecommerce\Models\Database\Option;
use Mage2\Ecommerce\Http\Requests\OptionRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use Mage2\Ecommerce\Models\Database\OptionDropdownOption;
use Mage2\Ecommerce\Models\Database\Product;
use Mage2\Ecommerce\Models\Database\AttributeDropdownOption;
use Mage2\Ecommerce\Models\Database\ProductCombination;


class OptionController extends AdminController
{


    public function optionCombinationModal(Request $request) {

        $options = Collection::make([]);

        $productId = $request->get('product_id');
        $optionIds = $request->get('attributes');

        foreach ($optionIds as $optionId) {
            $options->push(Attribute::findorfail($optionId));
        }

        return view('mage2-ecommerce::admin.product.option-combination')
                ->with('options', $options)
                ->with('productId', $productId);
    }

    public function optionCombinationUpdate(Request $request){

        $attributeIds = Collection::make([]);
        $productId = $request->get('product_id');
        $parentProduct = Product::findorfail($productId);

        $name = $parentProduct->name;

        foreach ($request->get('attributes_specification') as  $attributeId => $value) {
            $attribute = Attribute::findorfail($attributeId);

            if($attribute->field_type == 'SELECT') {
                $attributeOptionModel  = AttributeDropdownOption::findorfail($value);
                $name .= " " . $attributeOptionModel->display_text;
            }

            $attributeIds->push($attributeId);
        }

        $combinationProduct = Product::create(['name' => $name,'type' => 'VARIATION-COMBINATION']);

        $parentProduct->attributes()->sync($attributeIds);
        ProductCombination::create(['product_id' => $productId,'combination_id' => $combinationProduct->id]);
        $combinationProduct->saveProduct($request);

        return redirect()->route('admin.product.edit', $productId);

    }

}
