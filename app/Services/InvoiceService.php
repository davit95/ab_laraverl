<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\AdminClients;
use App\Models\ExtraCharge;
use Carbon\Carbon;

class InvoiceService {
	

	public function __construct(Invoice $invoice, AdminClients $adminClients, ExtraCharge $extraCharge) 
	{
		$this->invoice = $invoice;
		$this->adminClients = $adminClients;
		$this->extraCharge = $extraCharge;
	}

	public function getAllInvoices()
	{
		return $this->invoice->with('customer')->get();
	}

	public function getPendingInvoices()
	{
		return $this->invoice->with('customer')->get();
	}

	public function createInvoices($invoices)
	{
		return $this->invoice->insert($invoices);
	}

	public function getInvoiceById($id)
	{
		return $this->invoice->where('id', $id)->with('customer')->first();
	}

	public function getNewInvoices()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->whereNotIn('id', $invoice_ids)->where('basic_invoice_id', 0)->get();
	}

	public function getYourInvoices()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->whereIn('id', $invoice_ids)->get();
	}

	public function makeAdminCustomer($id)
	{
		$invoice = $this->invoice->find($id);
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		if(!in_array($invoice->id, $invoice_ids->toArray())) {
			return $this->adminClients->create(['admin_id' => \Auth::id(), 'invoice_id' => $invoice->id]);
		}
		return true;
	}

	public function checkStatus()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->whereNotIn('id', $invoice_ids)->lists('id')->toArray();
	}

	public function getChargeParams($extra_charge) 
	{
		$params = $extra_charge->toArray();
		$params['step'] ++;
		$params['invoice_id'] ++;
		unset($params['created_at']);
		unset($params['updated_at']);
		return $params;

	}

	public function createExtraCharge($invoice_id)
	{
		$extra_charges = $this->extraCharge->where('invoice_id', $invoice_id)->get();
		foreach ($extra_charges as $charge) {
			if($charge->period != $charge->step) {
				$extra_charge = $this->getChargeParams($charge);
				$this->extraCharge->create($extra_charge);
			}
		}
	}

	public function createInvoice($id)
	{
		//return true;
		$invoice = $this->invoice->find($id);
		//dd($invoice);
		if($invoice->recurring_attempts != $invoice->recurring_period_within_month  && $invoice->type != 'mr') {
			if($invoice->basic_invoice_id != 0) {
				$id = $invoice->basic_invoice_id;
			} else {
				$id = $invoice->id;
			}
			$invoices = $this->invoice
				->where('payment_type', 'initial')
				->where('basic_invoice_id', $id)
				->where('status', '<>', 'declined')
				->get()
				->toArray();
			$params = $this->getInvoiceParams($invoice, 'pending' , $id);
			//dd($params, $invoice);
			return $this->invoice->create($params);
		}

		return false;
	}

	public function getInvoiceParams($invoice, $payment_type, $basic_invoice_id)
	{
		if($invoice->basic_invoice_id == 0) {
			$invoice_recurring_attempt = $invoice->recurring_attempts;
			$invoice_recurring_attempt ++;
		} else {
			$invoice_recurring_attempt = $this->invoice
				->where('payment_type', 'initial')
				->where('status', $payment_type)
				->where('basic_invoice_id', $basic_invoice_id)
				->orderBy('id', 'DESC')->first()->recurring_attempts;
			$invoice_recurring_attempt++;
		}
		$invoice_params = $invoice->toArray();
		$invoice_params['basic_invoice_id'] = $basic_invoice_id;
		$invoice_params['recurring_attempts'] = $invoice_recurring_attempt;
		$invoice_params['payment_type'] = 'initial';
		return $invoice_params;
	}

	public function createDeclineInvoice($id)
	{
		$invoice = $this->invoice->find($id)->toArray();
		if($invoice['basic_invoice_id'] != 0) {
			$id = $invoice['basic_invoice_id'];
		}
		$invoice['basic_invoice_id'] = $id;
		$invoice['payment_type'] = 'initial';
		$invoice['status'] = 'declined';
		return $this->invoice->create($invoice);
	}

	public function updateInvoiceParams($id, $payments_response)
	{
		//dd($id);
		$invoice = $this->invoice->where('id', $id)->first();
		if($invoice->basic_invoice_id != 0) {
			$invoice_recurring_attempt = $invoice->recurring_attempts;
			$invoice_recurring_attempt++;
			$basic_invoice = $this->invoice->find($invoice->basic_invoice_id);
			$basic_invoice->update([ 'recurring_attempts' =>  $invoice_recurring_attempt]);
		} else {
			$invoice_recurring_attempt = $invoice->recurring_attempts;
		}
		
		$invoice_recurring_attempt++;
		$invoice_perriod = $invoice->recurring_period_within_month;
		$status = 'approved';
		$invoice->update(['status' => $status, 'payment_response' => $payments_response, 'payment_type' => 'recurring']);
		return $invoice;
	}

	public function updateInvoiceParamsById($id, $payments_response)
	{
		$invoice = $this->invoice->find($id);
		$invoice->update(['payment_type' => 'recurring', 'payment_response' => $payments_response, 'status' => 'approved']);
		return $invoice;
	}

	public function getAllPendingInvoicesByCustomerId($customer_id)
	{
		return $this->invoice->where('customer_id', $customer_id)->where('payment_type', 'initial')->where('status', '<>', 'declined')->get();
	}

	public function getAllNextInvoices()
	{
		$invoices = $this->invoice->where('payment_type', 'initial')->where('status', 'pending')->with('customer')->get();
		return $invoices;
	}

	// public function getAllNextInvoicesByPaginate()
	// {
	// 	//dd(count($this->invoice->with('customer')->get()));
	// 	return $this->invoice->with('customer')->get();
	// }

	public function getInvoiceProratedAmount($invoice)
	{
		$extra_charge_price = $this->getExtraChargesPrice($invoice);
		$month_days_to_seconds = date("t") * 24 * 60 * 60;
	    $one_second_price = $invoice->price + $extra_charge_price / $month_days_to_seconds;

	    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $invoice->created_at);
	    $clone_created_at = clone $created_at;
	    $last_day_of_month = $clone_created_at->endOfMonth();
	    $time_diff_by_seconds = $created_at->diffInSeconds($last_day_of_month);

	    $last_days_price = $invoice->price;

	    if($time_diff_by_seconds != 0 && ($invoice->recurring_attempts == 0 || $invoice->recurring_attempts == 6)) {
	        $last_days_price = $time_diff_by_seconds * $one_second_price;
	        if($invoice->recurring_attempts == 6) {
	            $last_days_price = ($month_days_to_seconds - $time_diff_by_seconds) * $one_second_price;
	        }
	    } 
	    $price = $last_days_price;
	    $price = round($price, 0, PHP_ROUND_HALF_UP);
	    
	    return $price;
	}

	public function addExtraCharge($id, $params)
	{
		$params['invoice_id'] = $id;
		$params['service'] = strtolower($params['service']);
		$params['service_other'] = strtolower($params['service_other']);
		$extra_charge = $this->extraCharge->create($params);
		return $extra_charge;
	}

	public function getExtraChargesPrice($invoice)
	{
		$price = 0;
		if(!empty($invoice->extra_charge)) {
			foreach ($invoice->extra_charge as $extra_charge) {
				$price = $price + $extra_charge->amount;
			}
		}
		return $price;
	}

	public function getInvoiceExtraCharges($invoice)
	{
		return $this->extraCharge->where('invoice_id', $invoice->id)->get();
	}

	
}