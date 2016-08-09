<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Website;

class WebsiteRequest extends Request
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
        $rules['name'] = 'required|max:255';

        if($this->method() == "POST") {
            $rules ['host'] =  'required|max:255|unique:websites';
        }

        if($this->method() == "PUT" ) {
            $website = Website::findorfail($this->get('id'));
            $rules ['host'] =  'required|max:255|unique:websites,host,' . $website->id;
        }
        return $rules;
    }
}
