<?php

namespace AvoRed\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class PropertyRequest extends Request
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
        $validationRule['sort_order'] = 'required';
        $validationRule['field_type'] = 'required';
        if ($this->getMethod() == 'POST') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash|unique:properties';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash';
        }

        return $validationRule;
    }
}
