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

}
