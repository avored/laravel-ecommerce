<?php

namespace AvoRed\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class ContactRequest extends Request
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
        $validation['name']     = 'required|max:255';
        $validation['email']    = 'required|email|max:255';
        $validation['phone']    = 'required|min:6';
        $validation['message']  = 'required|min:6';

        return $validation;
    }
}
