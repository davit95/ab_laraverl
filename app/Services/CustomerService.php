<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService {
	public function __construct(Customer $customer) {
		$this->customer = $customer;
	}

	public function createCustomer($data)
	{
		$data['password'] = bcrypt($data['password']);
		return $this->customer->create($data);
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
		return $this->customer->where('id', $customer_id)->update($inputs);
	}

}
