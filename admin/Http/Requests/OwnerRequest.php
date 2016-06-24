<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class OwnerRequest extends Request
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
            'company_name' => 'required',
            //'name' => 'required|unique:owners,name,'.$this->id,
            'phone' => 'phone_or_fax',
            'fax' => 'required|phone_or_fax',
            //'url' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'postal_code' => 'required|numeric',
            'address1' => 'required',
            'city' => 'required',
            //'region' => 'required',
            'us_state' => 'required',
            //'country' => 'required'
        ];
    }

    public function messages() {
        return [
            'phone.phone_or_fax'            => '"Phone must contain only numbers and "-" character',
            'fax.phone_or_fax'            => '"Fax must contain only numbers and "-" character',
            
        ];
    }

}
