<?php

namespace App\Http\Requests;

use illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest as Request;

class CartRequest extends Request
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
            'qty' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! $value >= 1) {
                        $fail($attribute.' is invalid');
                    }
                },
            ],
        ];
    }
}
