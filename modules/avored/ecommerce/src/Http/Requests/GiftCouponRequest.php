<?php

namespace AvoRed\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class GiftCouponRequest extends Request
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
        $validationRule = [];

        $validationRule['name'] = 'required|max:255';
        $validationRule['code'] = 'required|max:255';
        $validationRule['discount'] = 'required|between:0,99.99';

        return $validationRule;
    }
}
