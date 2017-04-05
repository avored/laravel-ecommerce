<?php

namespace Mage2\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadUserImageRequest extends FormRequest
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
        
        $validation['profile_image'] = 'required|image';
     
        return $validation;
    }
}
