<?php

namespace Mage2\Order\Requests;

use Mage2\Framework\Http\Request;

class OrderStatusRequest extends Request
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
        $rules = [];
        $rules['title'] = 'required|max:255';
        $rules['is_default'] = 'required|max:1';


        return $rules;
    }
}
