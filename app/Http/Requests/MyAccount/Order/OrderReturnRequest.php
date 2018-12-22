<?php

namespace App\Http\Requests\MyAccount\Order;

use Illuminate\Foundation\Http\FormRequest as Request;

class OrderReturnRequest extends Request
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
        $rules['comment'] = 'required';
        $rules['products'] = 'required|array';

        foreach ($this->request->get('products') as $slug => $productValues) {
            $rules['products.' . $slug . '.slug'] = 'required|max:255';
            $rules['products.' . $slug . '.qty'] = 'required|digits_between:1,100000';
            $rules['products.' . $slug . '.reason'] = 'required|max:255';
        }

        return $rules;
    }
}
