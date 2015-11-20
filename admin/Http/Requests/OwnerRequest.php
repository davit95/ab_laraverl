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
            'name' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'url' => 'required',
            'email' => 'required|email|unique:owners,email,'.$this->id,
            'address1' => 'required',
        ];
    }
}
