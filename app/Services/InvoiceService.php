<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\AdminClients;

class InvoiceService {
	

	public function __construct(Invoice $invoice, AdminClients $adminClients) 
	{
		$this->invoice = $invoice;
		$this->adminClients = $adminClients;
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
		return $this->invoice->where('customer_id', $customer_id)->where('payment_type', 'initial')->get();
	}

	public function getAllNextInvoices()
	{
		return $this->invoice->where('payment_type', 'initial')->with('customer')->get();
	}

	// public function getAllNextInvoicesByPaginate()
	// {
	// 	//dd(count($this->invoice->with('customer')->get()));
	// 	return $this->invoice->with('customer')->get();
	// }

	
}