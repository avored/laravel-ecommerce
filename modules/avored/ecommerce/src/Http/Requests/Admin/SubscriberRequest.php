<?php
namespace AvoRed\Ecommerce\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest as Request;

class SubscriberRequest extends Request
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
            $validationRule['email'] = 'required|email|max:255|unique:subscribers';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['email'] = 'required|email|max:255';
        }



        return $validationRule;
    }
}
