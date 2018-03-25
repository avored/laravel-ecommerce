<?php

namespace AvoRed\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class AttributeRequest extends Request
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

        if (null !== $this->request->get('dropdown-options')) {
            foreach ($this->request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }
                $validationRule['dropdown-options.'.$key.'.display_text'] = 'required';
            }
        }

        if ($this->getMethod() == 'POST') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash|unique:attributes';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash';
        }

        return $validationRule;
    }
}
