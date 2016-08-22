<?php

namespace Admin\Services;

use Admin\Contracts\UserInterface;
use App\User;
use App\Models\Role;
use App\Models\Owner;
use App\Models\City;
use App\Models\Package;
use App\Models\Invoice;
use App\Models\UsState;
use App\Models\Center;
use App\Models\AdminClients;
use App\Models\TempCartItem;
use Auth;

class UserService implements UserInterface
{
	/**
	 * Create a new user service instance.
	 */
	public function __construct(User $user, Role $role, Owner $owner, Center $center, City $city,Package $package,Invoice $invoice, UsState $usState,AdminClients $adminClients, TempCartItem $tempCartItem) {
		$this->user = $user;
		$this->role = $role;
		$this->owner = $owner;
		$this->center = $center;
		$this->city = $city;
		$this->package = $package;
		$this->invoice = $invoice;
		$this->usState = $usState;
		$this->adminClients = $adminClients;
		$this->tempCartItem = $tempCartItem;
	}

	public function test($id,$admin_id)
	{
		return $this->adminClients->create(['client_id' => $id,'admin_id' => $admin_id]);
	}

	public function getYourCustomers($id)
	{
		$ids = $this->adminClients->where('admin_id', $id)->lists('client_id');
		$customers = $this->user->whereIn('id', $ids)->get();
		return $customers;
	}
	public function getNewCustomers($id)
	{
		$ids = $this->adminClients->where('admin_id', $id)->lists('client_id');
		$customers = $this->user->whereNotIn('id', $ids)->get();
		return $customers;
	}

	/**
	 * Create a new user service instance.
	 */
	public function createUser($input) {
		//dd('ass');
		$input['password'] = bcrypt($input['password']);
		//dd($this->role->where('name', 'owner_user')->first()->id);
		$input['role_id'] = $this->role->where('name', 'owner_user')->first()->id;
		//dd($input);
		$owner = $this->getOwnerByName($input['name']);
		//dd($owner);
		$input['owner_id'] = $owner->id;
		//dd($input);
		return $this->user->create($input);
	}

	public function getOwnerByName($name)
	{
		return $this->owner->where('name', $name)->first();
	}

	/**
	 * get all users
	 */
	public function getAllUsers() {
		return $this->user->get();
	}

	/**
	 * search user bay firstName
	 */
	public function searchUserByFirstName($firstName)
	{
		return $this->user->where('first_name', 'LIKE', '%'.$firstName.'%')->get();
/*		if ( isset($this->filter_params['company_or_owner_name']) ) {
			$this->owner = $this->owner->where(function($owner){
				$owner->where('company_name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%')
					->orWhere('name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%');
			});
		}
		return $this->owner->orderBy('id', 'DESC')->paginate($this->per_page);*/
	}

	public function getAllCustomers()
	{
		//dd('aaaaaaaa');
		$client_user_role_id = $this->role->where('name', 'client_user')->first()->id;
		return $this->user->where('role_id', $client_user_role_id)->get();
	}

	public function getCustomerByIdAndRole($id,$role_name)
	{
		$role_id = $this->getUserRoleIdByRoleName($role_name);
		$client_id = $this->getUserRoleIdByRoleName('client_user');
		$admin_id = $this->getUserRoleIdByRoleName('admin');
		//dd($admin_id);
		if($role_name === 'super_admin' || 'accounting_user') {
			return $this->user->where('id', $id)->where('role_id', $client_id)->first();
		} elseif($role_name === 'client_user') {
			return $this->user->where('id', $id)->where('role_id', $role_id)->first();
		} elseif($role_name === 'admin') {
			return $this->user->where('id', $id)->where('role_id', $client_id)->first();
		}
		
	}

	public function getCustomerCenterById($center_id)
	{
		return $this->center->find($center_id);
	}

	public function updateCustomer($id, $inputs)
	{
		// dd($params);
		// return $this->user->where('id', $id)->update($params);
		$inputs = \Input::except('_method', '_token');
		$city_id = $this->city->where('name', $inputs['city'])->first()->id;
		//dd($city_id);
		$state_id = $this->usState->where('name', $inputs['state'])->first()->id;
		$inputs['city_id'] = $city_id;
		$inputs['us_state_id'] = $state_id;
		unset($inputs['city']);
		unset($inputs['state']);
		unset($inputs['country']);
		return $this->user->where('id', $id)->update($inputs);
	}

	public function getUser($id)
	{
		return $this->user->find($id);
	}

	public function getALlCustomersByOwnerId($id) 
	{
		return $this->user->where('owner_id', $id)->get();
	}

	public function createAllianceUser($inputs)
	{
		$role_id = $this->role->where('name',$inputs['user_type'])->first()->id;
		//dd($role_id);
		$inputs['role_id'] = $role_id;
		$inputs['password'] = bcrypt($inputs['password']);
		return $this->user->create($inputs);
	}

	public function getUserRoleIdByRoleName($role_name)
	{
		return $this->role->where('name', $role_name)->first()->id;
	}

	public function getCsrOrAccountingUsers($request)
	{
		if($request->is('users')) {
			$role_id = $this->role->where('name', 'admin')->first()->id;
			return $this->user->where('role_id', $role_id)->get();
		} else {
			$role_id = $this->role->where('name', 'accounting_user')->first()->id;
			return $this->user->where('role_id', $role_id)->get();
		}
	}


	public function getCusomerInvoice($user_id){
		 $result = $this->tempCartItem->where('user_id', $user_id)->first();
		 if($result != false){
		 	return $result;
		 }else{
		 	return false;
		 }
	}

	public function getPackagePrice($plan){
		 return $this->package->where('name', $plan)->first()->price;
	}

	public function getMailForwardingPrice($part_number){
		 return $this->package->where('part_number' , $part_number)->first();
	}

	public function getCenterAddress($center_id){
		return $this->center->where('id', $center_id)->first();
	}

	public function getMeetingRoomName($mr_id, $center_id){
		return $this->center->where('id' , $center_id)->first()->meeting_rooms->where('id',$mr_id)->first();
	}
	public function getUserById($id)
	{
		return $this->user->find($id);
	}

	public function updateUser($id, $params)
	{
		$user = $this->getUserById($id);
		//dd(\Auth::user()->role->name);
		//if($user->role->name == 'accounting_user');
		$user->update($params);
		return $user;
	}

	public function getCustomerCenterInfo($center_id)
	{
		return $this->center->find($center_id);
	}

	public function destroyUser($id)
	{
		$user = $this->getUserById($id);
		return $user->delete();
	}

	public function getRecurringInvoice($customer_id)
	{
		return $this->getCustomerCompletedInvoices($customer_id)->first();
	}

	public function getCustomerPendingInvoices($customer_id)
	{
		// dd($this->invoice->where('customer_id', $customer_id)->where('payment_type', 'initial')->orWhere(function($q) {
		// 	$q->where('payment_type', 'recurring')->where('status', 'pending');
		// })->where('status', '<>', 'declined')->get());
		return $this->invoice->where('customer_id', $customer_id)->where('payment_type', 'initial')->orWhere(function($q) {
			$q->where('payment_type', 'recurring')->where('status', '<>' ,'approved');
		})->where('status', '<>', 'declined')->get();
	}

	public function getCustomerDeclinedInvoices($customer_id)
	{
		return $this->invoice->where('customer_id', $customer_id)->where('status', 'declined')->get();
	}

	public function getCustomerCompletedInvoices($customer_id)
	{
		
		$basic_invoices = $this->invoice->where('customer_id', $customer_id)->where('status', 'approved')->get();

		// foreach ($basic_invoices as $invoice) {
		// 	if($invoice->recurring_period_within_month == $invoice->recurring_attempts) {
		// 		$pending_invoice_reccuring_attempt = $this->invoice->where('basic_invoice_id', $invoice->id)->orderBy('id', 'DESC')->first()->recurring_attempts;
		// 		if($pending_invoice_reccuring_attempt == $invoice->recurring_period_within_month - 1) {
		// 			$completed_invoices = $this->invoice->where('customer_id', $customer_id)->where('payment_type', 'reccuring')->get();
		// 		}
		// 		if($pending_invoice_reccuring_attempt == 6) {
		// 			$completed_invoices = [];
		// 		}
		// 	}
		// }
		return $basic_invoices;

	}

	public function updateCustomerStatus($id, $status)
	{
		$customer = $this->user->find($id);
		$status = strtolower($status);
		$customer->update(['status' => $status]);
		return $customer;
	}
}