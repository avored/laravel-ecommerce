<?php

namespace Mage2\Checkout\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentOptionRequest extends FormRequest
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
        return [
            'payment_option' => 'required'
        ];
    }
}
