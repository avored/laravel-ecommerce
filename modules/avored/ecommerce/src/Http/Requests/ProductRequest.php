<?php

namespace AvoRed\Ecommerce\Http\Requests;

use AvoRed\Framework\Models\Database\Product;
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
        if ($this->request->get('product_id', null) !== null) {
            $product = Product::findorfail($this->request->get('product_id'));
        }

        if (isset($product) && $product->type == 'VARIABLE_PRODUCT') {
            $rule['name'] = 'required|max:255';
            $rule ['price'] = 'required|max:14|regex:/^-?\\d*(\\.\\d+)?$/';
            $rule['sku'] = 'required|max:255';
            $rule['qty'] = 'required';
        } else {
            $rule['name'] = 'required|max:255';
            $rule ['price'] = 'required|max:14|regex:/^-?\\d*(\\.\\d+)?$/';
            $rule['sku'] = 'required|max:255';
            //$rule['page_title'] = "max:255";
            //$rule['page_description'] = "max:255";
            $rule['description'] = 'required';
            $rule['status'] = 'required';
            $rule['is_taxable'] = 'required';
            $rule['in_stock'] = 'required';
            $rule['track_stock'] = 'required';

            //@todo category validation
            if (strtolower($this->method()) == 'put' || strtolower($this->method()) == 'patch') {

                //$product = Product::find($this->route('product'));
                //$rule['slug'] = "required|max:255|alpha_dash|unique:products,slug," . $product->id;
            }
        }

        return $rule;
    }
}
