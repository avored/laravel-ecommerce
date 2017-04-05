<?php

namespace Mage2\TaxClass\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class TaxRuleRequest extends Request
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
            'state_code' => 'required|max:255',
            'post_code' => 'required|max:255',
            'percentage'   => 'required|max:255',
        ];
    }
}
