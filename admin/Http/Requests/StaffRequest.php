<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class StaffRequest extends Request
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
            'staff_first_name' => 'required',
            'staff_last_name' => 'required',
            'staff_title' => 'required',
            'staff_email' => 'required|email|max:255',
            'staff_phone' => 'required',
            'staff_ext' => 'required',
            'staff_phone_2' => 'required',
            'staff_ext_2' => 'required',
            'password' => 'required'
        ];
    }
}
