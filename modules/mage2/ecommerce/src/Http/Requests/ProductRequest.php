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
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule['name'] = "required|max:255";
        $rule ['price'] = "required|max:14|regex:/^-?\\d*(\\.\\d+)?$/";
        $rule['sku'] = "required|max:255";
        //$rule['page_title'] = "max:255";
        //$rule['page_description'] = "max:255";
        $rule['description'] = "required";
        $rule['status'] = "required";
        $rule['is_taxable'] = "required";
        $rule['in_stock'] = "required";
        $rule['track_stock'] = "required";

        //@todo category validation
        if(strtolower($this->method()) == 'put' || strtolower($this->method()) == 'patch') {

            //$product = Product::find($this->route('product'));
            //$rule['slug'] = "required|max:255|alpha_dash|unique:products,slug," . $product->id;
        }


        return $rule;
    }
}
