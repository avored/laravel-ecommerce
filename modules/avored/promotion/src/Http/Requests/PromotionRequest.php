<?php
namespace AvoRed\Promotion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class PromotionRequest extends Request
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

        $validation['name'] = 'required|max:255';
        if($this->method() == "POST" ) {
            //$validation['image'] = 'mimes:jpeg,bmp,png,gif';
        }
        $validation['discount_type'] = 'max:255';
        $validation['amount'] = 'regex:/^\d*(\.\d{2})?$/';


        return $validation;

    }
}
