<?php

namespace Mage2\Catalog\Requests;

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
        $validationRule['title'] = 'required|max:255';
        $validationRule['field_type'] = 'required';
        $validationRule['type'] = 'required';
        $validationRule['sort_order'] = 'required';


        if(null !== $this->request->get('dropdown-options') ) {

            foreach ($this->request->get('dropdown-options') as $key => $val) {
                if ($key == "__RANDOM_STRING__") {
                    continue;
                }
                $validationRule['dropdown-options.' . $key . ".display_text"] = 'required';

            }
        }


        if ($this->getMethod() == 'POST') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash|unique:product_attributes';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['identifier'] = 'required|max:255|alpha_dash';
        }

        //dd($validationRule);
        return $validationRule;
    }
}
