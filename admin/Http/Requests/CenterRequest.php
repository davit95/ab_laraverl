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
            'sites' => 'required',
            'name' => 'required',
            'address1' => 'required',
            'subhead' => 'required',
            'sentence1' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'h1' => 'required',
            'h2' => 'required',
            'h3' => 'required',
            'seo_footer' => 'required',
            'meta_description' => 'required',
            'city_name' => 'required',
            //'abcn_title' => 'required',
            'abcn_description' => 'required',
            //'price' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            //'countries' => 'required',
            'mr_sentence1' => 'required',
            'mr_avo_description' => 'required',
            'mr_meta_title' => 'required',
            'mr_meta_keywords' => 'required',
            'mr_meta_description' => 'required',
            'mr_h1' => 'required',
            'mr_h2' => 'required',
            'mr_h3' => 'required',
            'mr_seo_footer' => 'required',
            //'mr_abcn_title' => 'required',
            'mr_abcn_description' => 'required',
            'mr_subhead' => 'required'
        ];
    }

    /**
     * Get the validation messages for request.
     *
     * @return array
     */
    public function messages() {
        return [
            'building_name.required'            => '"CENTER INFORMATION" section: Building Name field is required.',
            'sites.required'                    => '"CENTER INFORMATION" section: Sites field is required.',
            'name.required'                     => '"CENTER INFORMATION" section: Center Name field is required.',
            'address1.required'                 => '"CENTER INFORMATION" section: Address 1  field is required.',
            'subhead.required'                  => '"CENTER INFORMATION" section: Subhead field is required.',
            'sentence1.required'                => '"CENTER INFORMATION" section: Sentence 1 field is required.',
            'meta_title.required'               => '"CENTER INFORMATION" section: Meta Title field is required.',
            'meta_keywords.required'            => '"CENTER INFORMATION" section: Meta Keywords  field is required.',
            'h1.required'                       => '"CENTER INFORMATION" section: Headline  field is required.',
            'h2.required'                       => '"CENTER INFORMATION" section: Sub Headline  field is required.',
            'h3.required'                       => '"CENTER INFORMATION" section: Headline 2  field is required.',
            'seo_footer.required'               => '"CENTER INFORMATION" section: Seo Footer field is required.',
            'meta_description.required'         => '"CENTER INFORMATION" section: Meta Description field is required.',
            'city_name.required'                => '"CENTER INFORMATION" section: City Name field is required.',
            'abcn_description.required'         => '"CENTER INFORMATION" section: Abcn Description field is required.',
            'lat.required'                      => '"CENTER INFORMATION" section: Latitude field is required.',
            'lng.required'                      => '"CENTER INFORMATION" section: Longitude field is required.',
            'mr_sentence1.required'             => '"MEETING ROOM INFORMATION" section: Sentnence 1 field is required.',
            'mr_avo_description.required'       => '"MEETING ROOM INFORMATION" section: Avo Description field is required.',
            'mr_meta_title.required'            => '"MEETING ROOM INFORMATION" section: Meta Title field is required.',
            'mr_meta_keywords.required'         => '"MEETING ROOM INFORMATION" section: Meta Keywords field is required.',
            'mr_meta_description.required'      => '"MEETING ROOM INFORMATION" section: Meta Description field is required.',
            'mr_h1.required'                    => '"MEETING ROOM INFORMATION" section: Headline field is required.',
            'mr_h2.required'                    => '"MEETING ROOM INFORMATION" section: Sub Headline field is required.',
            'mr_h3.required'                    => '"MEETING ROOM INFORMATION" section: Headline 2 field is required.',
            'mr_seo_footer.required'            => '"MEETING ROOM INFORMATION" section: Seo Footer field is required.',
            'mr_abcn_description.required'      => '"MEETING ROOM INFORMATION" section: Abcn Description 2 field is required.',
            'mr_subhead.required'               => '"MEETING ROOM INFORMATION" section: Subhead  field is required.',
        ];
    }
}
