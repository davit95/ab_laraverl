<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'address1' => 'required',
            'postal_code' => 'required',
            'mf_first_name' => 'required',
            'mf_last_name' => 'required',
            'mf_address1' => 'required',
            'mf_company_name' => 'required',
            'mf_country_id' => 'required',
            'mf_postal_code' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ];
    }
}
