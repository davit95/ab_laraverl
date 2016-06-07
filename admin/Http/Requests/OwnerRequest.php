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
            'name' => 'required|unique:owners,name,'.$this->id,
            'phone' => 'required|numeric',
            'fax' => 'required|numeric',
            //'url' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'postal_code' => 'required|numeric',
            'address1' => 'required',
            'city' => 'required',
            'region' => 'required',
            'us_state' => 'required',
            'country' => 'required'
        ];
    }
}
