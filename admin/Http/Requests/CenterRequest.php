<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class CenterRequest extends Request
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
            'building_name' => 'required',
            'address1' => 'required',
            'city_name' => 'required',
            'postal_code' => 'required',
            'lat' => 'required',
            'lng' => 'required'  
        ];
    }
}
