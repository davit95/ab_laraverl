<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\UsState;
use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class CustomerAuthService extends Guard {
	public function __construct(UserProvider $provider){
		//parent::__construct();
		$this->provider = $provider;
		\Config::set('auth.model', App\Models\Customer::class);
        \Config::set('auth.table', 'customers');
	}

	

}
