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
             'first_name'   => 'required',
             'company_name' => 'required',
             'last_name'    => 'required',
            // 'phone'        => 'required',
            'email'         => 'required|email|max:255|unique:users,'.$this->id,
            'password'      => 'required|min:6',
            'username'      => 'required',
            // 'address1'     =>'required',
            // 'address2'     => 'required'
        ];
    }

    /**
     * Get the validation messages for request.
     *
     * @return array
     */
    public function messages() {
        return [
            'first_name.required'          => '"OWNER-USER INFORMATION" section: First Name  field is required.',
            'company_name.required'        => '"OWNER-USER INFORMATION" section: Company Name  field is required.',
            'last_name.required'           => '"OWNER-USER INFORMATION" section: Last Name  field is required.',
            'email.required'               => '"OWNER-USER INFORMATION" section: We need to know your e-mail address!.',
            'password.required'            => '"OWNER-USER INFORMATION" section: Password  field is required and must be contain min 6 symvols.',
            'username.required'            => '"OWNER-USER INFORMATION" section: User Name  field is required.',
        ];
    }
}
