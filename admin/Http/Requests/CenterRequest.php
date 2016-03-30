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
            // 'building_name' => 'required',
            // 'name' => 'required',
            // 'address1' => 'required',
            // 'subhead' => 'required',
            // 'sentence1' => 'required',
            // 'meta_title' => 'required',
            // 'meta_keywords' => 'required',
            // 'h1' => 'required',
            // 'h2' => 'required',
            // 'h3' => 'required',
            // 'seo_footer' => 'required',
            // 'meta_description' => 'required',
            // 'city_name' => 'required',
            // 'abcn_title' => 'required',
            // 'abcn_description' => 'required',
            // //'price' => 'required',
            // 'lat' => 'required',
            // 'lng' => 'required',
            // 'countries' => 'required',
            // 'mr_sentence1' => 'required',
            // 'mr_avo_description' => 'required',
            // 'mr_meta_title' => 'required',
            // 'mr_meta_keywords' => 'required',
            // 'mr_meta_description' => 'required',
            // 'mr_h1' => 'required',
            // 'mr_h2' => 'required',
            // 'mr_h3' => 'required',
            // 'mr_seo_footer' => 'required',
            // 'mr_abcn_title' => 'required',
            // 'mr_abcn_description' => 'required',
            // 'mr_subhead' => 'required'
        ];
    }
}
