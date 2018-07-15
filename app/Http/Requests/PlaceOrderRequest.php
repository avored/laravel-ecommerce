<?php

namespace App\Http\Requests;

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
            $validation['user.email'] = 'required|email|max:255';
        }

        $billingData = $this->request->get('billing');

        if (isset($billingData) && null === array_get($billingData, 'id')) {
            $validation['billing.address1'] = 'required|max:255';
            $validation['billing.address2'] = 'max:255';
            $validation['billing.country_id'] = 'required|max:255';
            $validation['billing.state'] = 'required|max:255';
            $validation['billing.city'] = 'required|max:255';
            $validation['billing.postcode'] = 'required|max:255';
        }

        if (null !== $this->request->get('use_different_shipping_address')) {
            $validation['shipping.address1'] = 'required|max:255';
            $validation['shipping.address2'] = 'max:255';
            $validation['shipping.country_id'] = 'required|max:255';
            $validation['shipping.state'] = 'required|max:255';
            $validation['shipping.city'] = 'required|max:255';
            $validation['shipping.postcode'] = 'required|max:255';
        }

        $validation['shipping_option'] = 'required';
        $validation['payment_option'] = 'required';
        $validation['agree'] = 'required';

        return $validation;
    }
}
