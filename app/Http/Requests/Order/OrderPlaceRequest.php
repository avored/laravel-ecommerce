<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OrderPlaceRequest extends FormRequest
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
        $rules = [];
        $request = $this->request->all();
        
        if (!Auth::guard('customer')->check()) {
            $rules['first_name'] = 'required|max:255';
            $rules['last_name'] = 'required|max:255';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        if (Arr::get($request, 'use_different_address')) {
            $rules['billing.first_name'] = 'required|max:255';
            $rules['billing.last_name'] = 'required|max:255';
            $rules['billing.company_name'] = 'required|max:255';
            $rules['billing.phone'] = 'required|max:255';
            $rules['billing.address1'] = 'required|max:255';
            $rules['billing.address2'] = 'required|max:255';
            $rules['billing.country_id'] = 'required';
            $rules['billing.state'] = 'required';
            $rules['billing.city'] = 'required|max:255';
            $rules['billing.postcode'] = 'required|max:255';
        }

        if (!Arr::get($request, 'shipping.address_id')) {
            $rules['shipping.first_name'] = 'required|max:255';
            $rules['shipping.last_name'] = 'required|max:255';
            $rules['shipping.company_name'] = 'required|max:255';
            $rules['shipping.phone'] = 'required|max:255';
            $rules['shipping.address1'] = 'required|max:255';
            $rules['shipping.address2'] = 'required|max:255';
            $rules['shipping.country_id'] = 'required';
            $rules['shipping.state'] = 'required';
            $rules['shipping.city'] = 'required|max:255';
            $rules['shipping.postcode'] = 'required|max:255';
        }

        $rules['payment_option'] = 'required';
        $rules['shipping_option'] = 'required';

        return $rules;
    }
}
