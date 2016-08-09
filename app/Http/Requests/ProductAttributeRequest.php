<?php

namespace App\Http\Requests;

use App\ProductAttribute;
use App\Http\Requests\Request;

class ProductAttributeRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [];
        //@todo fix this
       
         
         
        $rules['title'] = 'required|max:255';
        $rules['field_type'] = 'required';
        
        if($this->method() == "POST") {
            $rules ['identifier'] =  'required|max:255|unique:product_attributes';
        }
        
        if($this->method() == "PUT" ) {
            $rules ['identifier'] =  'required|max:255|unique:product_attributes,id,' . $this->get('id');
        }
        
        if($this->request->get('field_type') == "SELECT") {
            foreach ($this->request->get('label') as $key => $dropdownOptionLabel) {
                $rules['label.' . $key] = 'required';
            }
            foreach ($this->request->get('value') as $key => $dropdownOptionLabel) {
                $rules['value.' . $key] = 'required';
            }
        } else {
            $rules['type'] = "required";
        }
        
        
        return $rules;
        
        
      
    }

}
