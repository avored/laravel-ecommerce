<?php

namespace AvoRed\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequst extends FormRequest
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
        $validation ['name'] = 'required|max:255';

        return $validation;
    }
}
