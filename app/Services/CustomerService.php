<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\UsState;
use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\User;

class CustomerService {
	public function __construct(Customer $customer, 
		User $user, 
		Center $center,
		City $city,
		Country $country,
		Role $role,
		UsState $usState
		) {
		$this->customer = $customer;
		$this->user = $user;
		$this->center = $center;
		$this->city = $city;
		$this->country = $country;
		$this->role = $role;
		$this->usState = $usState;
	}

	public function createCustomer($data, $center)
	{
		$params = $this->getCustomerParams($data, $center);
		return $this->user->create($params);
	}

	public function getCustomerParams($data, $center)
	{
		$data = array_merge($data,$center);
		$city_id = $this->city->where('name', $data['city'])->first()->id;
		$state_id = $this->usState->where('name', $data['state'])->first()->id;
		$data['city_id'] = $city_id;
		$data['us_state_id'] = $state_id;
		$data['password'] = bcrypt($data['password']);
		$role_id = $this->role->where('name', 'client_user')->first()->id;
		$data['role_id'] = $role_id;
		unset($data['city']);
		unset($data['state']);
		unset($data['country']);
		return $data;
	}

	public function getAllCustomers()
	{
		return $this->customer->get();
	}

	public function getCustomerById($id)
	{
		return $this->customer->where('id', $id)->first();
	}

	public function updateCustomer($customer_id, $inputs)
	{
		$inputs = \Input::except('_method', '_token');
		//dd($inputs['city']);
		$city_id = $this->city->where('name', $inputs['city'])->first()->id;
		$state_id = $this->usState->where('name', $inputs['state'])->first()->id;
		$inputs['city_id'] = $city_id;
		$inputs['us_state_id'] = $state_id;
		unset($inputs['city']);
		unset($inputs['state']);
		unset($inputs['country']);
		return $this->user->where('id', $customer_id)->update($inputs);
	}

	public function uploadFile($id, $params, $files)
	{
		dd($this->getFilesNames($files));
	}

	/**
	 * upload images for virtual office
	 *
	 * @param $files (file)
	 * @return filenames
	 */
	public function getFilesNames($files)
	{
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
	        	$filename = str_random(20).".".$file->getClientOriginalExtension();
	        	$filenames[]['path'] = $filename;
	        	$file->move(public_path().'/files', $filename);
			}
	        return $filenames;
		}
		return '';
	}

}
