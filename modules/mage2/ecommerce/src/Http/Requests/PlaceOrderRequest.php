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
use Illuminate\Support\Facades\Auth;

class PlaceOrderRequest extends Request
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
        $validation['billing.first_name'] = 'required|max:255';
        $validation['billing.last_name'] = 'required|max:255';
        $validation['billing.phone'] = 'required|max:255';



        if (!Auth::check()) {
            //$validation['user.email'] = 'required|email|max:255|unique:users';
            $validation['user.email'] = 'required|email|max:255';

            //$validation['user.password'] = 'required|min:6|confirmed';
        }

        if (null === $this->request->get('billing.id')) {
            $validation['billing.address1'] = 'required|max:255';
            $validation['billing.address2'] = 'required|max:255';
            $validation['billing.country_id'] = 'required|max:255';
            $validation['billing.state'] = 'required|max:255';
            $validation['billing.city'] = 'required|max:255';
            $validation['billing.postcode'] = 'required|max:255';
        }

        if (null !== $this->request->get('use_different_shipping_address')) {
            $validation['shipping.address1'] = 'required|max:255';
            $validation['shipping.address2'] = 'required|max:255';
            $validation['shipping.country_id'] = 'required|max:255';
            $validation['shipping.state'] = 'required|max:255';
            $validation['shipping.city'] = 'required|max:255';
            $validation['shipping.postcode'] = 'required|max:255';
        }

        $validation['shipping_option'] = 'required';
        $validation['payment_option'] = 'required';
        $validation['agree'] = 'required';

        //dd($validation);
        return $validation;

    }
}
