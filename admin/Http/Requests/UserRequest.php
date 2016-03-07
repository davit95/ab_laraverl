<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            // 'company_name' => 'required',
             'last_name'  => 'required',
            // 'phone'        => 'required',
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|min:6',
            'username'    => 'required',
            // 'address1'     =>'required',
            // 'address2'     => 'required'
        ];
    }
}
