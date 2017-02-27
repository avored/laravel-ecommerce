<?php

namespace Mage2\Catalog\Requests;

use Mage2\Catalog\Models\ProductAttribute;
use Illuminate\Foundation\Http\FormRequest as Request;

class ProductRequest extends Request
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

        //@todo validation is not working yet??
        $rule['title']              = "required|max:255";
        $rule ['price']             = "required|max:8|regex:/^-?\\d*(\\.\\d+)?$/";
        $rule['sku']                = "required|max:255";
        $rule['slug']               = "required|max:255|alpha_dash";
        $rule['page_title']         = "max:255";
        $rule['page_description']   = "max:255";
        $rule['description']        = "required";
        $rule['status']             = "required";
        $rule['is_taxable']         = "required";
        $rule['in_stock']           = "required";
        $rule['track_stock']        = "required";

        //@todo category validation

        return $rule;

        //return [
        //      'title' => 'required|max:255',
        //      'identifier' => 'required|max:255|unique:product_attributes,id,' . $this->get('id'),
        //      'type' => 'required',
        //      'user.email' => 'required|email|unique:users,email,' . $user->id,
        //];
    }
}
