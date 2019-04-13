<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;
use illuminate\Support\Facades\Auth;

class AddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (strtolower($this->method()) == 'put' || strtolower($this->method()) == 'patch') {
            $address = $this->address;
            $user = Auth::user();

            return $user->addresses->pluck('id')->contains($address->id);
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address1' => 'required|max:255',
            'city' => 'required|max:255',
            'country_id' => 'required',
            'phone' => 'required|max:255',
        ];
    }
}
