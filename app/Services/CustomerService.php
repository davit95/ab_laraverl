<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\UsState;
use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\File;
use App\Models\Role;
use App\User;

class CustomerService {
	public function __construct(Customer $customer, 
		User $user, 
		Center $center,
		City $city,
		Country $country,
		Role $role,
		UsState $usState,
		File $file
		) {
		$this->customer = $customer;
		$this->user = $user;
		$this->center = $center;
		$this->city = $city;
		$this->country = $country;
		$this->role = $role;
		$this->usState = $usState;
		$this->file = $file;
	}

	public function test($id,$admin_id)
	{
		return $this->customer->where('id', $id)->update(['admin_id' => $admin_id]);
	}

	public function createCustomer($data, $center)
	{
		$params = $this->getCustomerParams($data, $center);
		//dd($params);
		return $this->user->create($params);
	}

	public function getCustomerParams($data, $center)
	{
		//dd($data);
		$data = array_merge($data,$center);
		$city = $this->city->where('name', $data['city'])->first();
		if($city) {
			$city_id = $city->id;
			$data['city_id'] = $city_id;
		} else {
			$data['city_id'] = null;
		}
		$state = $this->usState->where('name', $data['state'])->first();
		if($state) {
			$state_id = $state->id;
			$data['us_state_id'] = $state_id;
		} else {
			$data['us_state_id'] = null;
		}
		if($data['country_id'] == '') {
			$data['country_id'] = null;
		}
		
		
		$data['password'] = bcrypt($data['password']);
		$role_id = $this->role->where('name', 'client_user')->first()->id;
		$data['role_id'] = $role_id;
		unset($data['city']);
		unset($data['state']);
		unset($data['country']);
		return $data;
	}

	public function getCustomerByIdAndRole($id,$role_name)
	{
		//$role_id = $this->getUserRoleIdByRoleName($role_name);
		//$client_id = $this->getUserRoleIdByRoleName('client_user');
		//$admin_id = $this->getUserRoleIdByRoleName('admin');
		//dd($admin_id);
		if($role_name === 'super_admin') {
			return $this->customer->where('id', $id)->first();
		} elseif($role_name === 'client_user') {
			return $this->user->where('id', $id)->where('role_id', $role_id)->first();
		} elseif($role_name === 'admin') {
			return $this->customer->where('id', $id)->first();
		}
		
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
		//$city_id = $this->city->where('name', $inputs['city'])->first()->id;
		//$state_id = $this->usState->where('name', $inputs['state'])->first()->id;
		//$inputs['city_id'] = $city_id;
		//$inputs['us_state_id'] = $state_id;
		unset($inputs['city']);
		unset($inputs['state']);
	    unset($inputs['country']);
	    //dd($inputs);
		return $this->customer->where('id', $customer_id)->update($inputs);
	}

	public function uploadFile($id, $params, $files)
	{
		$file_params = $this->getFilesParams($files,$params, $id);
		$files = $this->file->create($file_params);
		return $files;
	}

	public function getCustomerFiles($id)
	{
		return $this->file->where('user_id', $id)->get();
	}

	// public function uploadFile($id, $params, $files)
	// {
	// 	$file_params = $this->getFilesNames($files, $params);
	// 	$files = $this->file->create($file_params);
	// 	if($files) {	
	// 		$this->user->find($id)->user_files()->attach($this->getFilesIds($files));
	// 	}	
	// }

	// /**
	//  * return photos ids
	//  *
	//  * @param $files (file)
	//  * @return ids
	//  */
	// public function getFilesIds($files)
	// {
	// 	$file_ids = [];
	// 	$max_file_id = $this->file->max('id');
	// 	$ids = $this->file->where('id', '>', $max_file_id - count($files))->lists('id')->toArray();
	// 	return $ids;
	// }

	/**
	 * upload images for virtual office
	 *
	 * @param $files (file)
	 * @return filenames
	 */
	public function getFilesParams($files, $params, $id)
	{
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
	        	$filename = str_random(20).".".$file->getClientOriginalExtension();
	        	$filenames['path'] = $filename;
	        	$filenames['file_category'] = $params['file_category'];
	        	$filenames['user_id'] = $id;
	        	$filenames['file_type'] = $file->getClientOriginalExtension();
	        	$file->move(public_path().'/files', $filename);
			}
	        return $filenames;
		}
		return '';
	}

	public function getAllCustomersWithAdmin($id)
	{
		return $this->customer->where('admin_id', $id)->get();
	}

	public function getAllCustomersWithoutAdmin($id)
	{
		return $this->customer->where('admin_id', '<', 1)->get();
	}

	// public function updateCustomer($id, $inputs)
	// {
	// 	// dd($params);
	// 	// return $this->user->where('id', $id)->update($params);
	// 	$inputs = \Input::except('_method', '_token');
	// 	$city_id = $this->city->where('name', $inputs['city'])->first()->id;
	// 	//dd($city_id);
	// 	$state_id = $this->usState->where('name', $inputs['state'])->first()->id;
	// 	$inputs['city_id'] = $city_id;
	// 	$inputs['us_state_id'] = $state_id;
	// 	unset($inputs['city']);
	// 	unset($inputs['state']);
	// 	unset($inputs['country']);
	// 	return $this->user->where('id', $id)->update($inputs);
	// }

}
