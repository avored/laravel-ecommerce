<?php

namespace AvoRed\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class CategoryRequest extends Request
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
        if ($this->getMethod() == 'POST') {
            $validationRule['slug'] = 'required|max:255|alpha_dash|unique:categories';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['slug'] = 'required|max:255|alpha_dash';
        }

        return $validationRule;
    }
}
