<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MRBookRequest extends Request
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
            'mr_date'      => 'required',
            'mr_start_time' => 'required',
            'mr_end_time'   => 'required',
            'mr_id'        => 'required'
        ];
    }



    public function messages()
    {
        return [
            'mr_date.required' => 'Please set date.',
            'mr_start_time.required' => 'Please set start time.',
            'mr_end_time.required' => 'Please set end time.',
            'mr_id.required' => 'Please select meeting room.',
        ];
    }
}
