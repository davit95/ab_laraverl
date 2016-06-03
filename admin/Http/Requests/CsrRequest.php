<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class CsrRequest extends Request
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
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'required',
            'phone' => 'required|numeric',
            'postal_code' => 'required|numeric'
        ];
    }

    /**
     * Get the validation messages for request.
     *
     * @return array
     */
    public function messages() {
        return [
            
        ];
    }
}
