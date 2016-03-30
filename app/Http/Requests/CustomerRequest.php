<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'first_name'            => 'required',
			'last_name'             => 'required',
			'email'                 => 'required',
			'phone'                 => 'required',
			'company_name'          => 'required',
			'address1'              => 'required',
			'postal_code'           => 'required',
			/*'mf_first_name'         => 'required',
			'mf_last_name'          => 'required',
			'mf_address1'           => 'required',
			'mf_company_name'       => 'required',
			'mf_country_id'         => 'required',*/
			//'mf_postal_code'        => 'required',//_if_attribute:email_flag,!=,""
			'password'              => 'required',
			'password_confirmation' => 'required',
			'agree'                 => 'required'
		];
	}

	/**
	 * Get the validation messages for request.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'first_name.required'            => '"BILLING INFORMATION" section: First Name field is required.',
			'last_name.required'             => '"BILLING INFORMATION" section: Last Name field is required.',
			'email.required'                 => '"BILLING INFORMATION" section: Email field is required.',
			'phone.required'                 => '"BILLING INFORMATION" section: Phone field is required.',
			'company_name.required'          => '"BILLING INFORMATION" section: Company Name field is required.',
			'address1.required'              => '"BILLING INFORMATION" section: Address 1 field is required.',
			'postal_code.required'           => '"BILLING INFORMATION" section: Postal Code field is required.',
			'mf_first_name.required'         => '"MAIL FORWARDING INFORMATION" section: First Name field is required.',
			'mf_last_name.required'          => '"MAIL FORWARDING INFORMATION" section: Last Name field is required.',
			'mf_address1.required'           => '"MAIL FORWARDING INFORMATION" section: Address 1 field is required.',
			'mf_company_name.required'       => '"MAIL FORWARDING INFORMATION" section: Company Name field is required.',
			'mf_country_id.required'         => '"MAIL FORWARDING INFORMATION" section: Country field is required.',
			'mf_postal_code.required'        => '"MAIL FORWARDING INFORMATION" section: Postal Code field is required.',
			'password.required'              => '"ACCOUNT PASSWORD INFORMATION" section: Password field is required.',
			'password_confirmation.required' => '"ACCOUNT PASSWORD INFORMATION" section: Confirm Password field is required.',
			'agree.required'                 => 'You must aggre Terms of Service to continue.'
		];
	}
}
