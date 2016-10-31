<?php

namespace Mage2\TaxClass\Requests;

use Mage2\System\Requests\Request;

class TaxClassRequest extends Request
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
            'title'        => 'required|max:255',
            'country_code' => 'required|max:255',
            'percentage'   => 'required|max:255',
        ];
    }
}
