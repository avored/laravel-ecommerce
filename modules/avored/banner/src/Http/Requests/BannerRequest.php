<?php
namespace AvoRed\Banner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class BannerRequest extends Request
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
        $validation['image'] = 'nullable|image';
        $validation['alt_text'] = 'max:255';
        $validation['url'] = 'max:255';
        $validation['sort_order'] = 'required|integer';

        return $validation;

    }
}
