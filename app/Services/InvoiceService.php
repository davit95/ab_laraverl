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

	public function updateInvoiceParams($id, $payments_response)
	{
		$invoice = $this->invoice->where('id', $id)->first();
		if($invoice->basic_invoice_id != 0) {
			$invoice_reccuring_attempt = $invoice->recurring_attempts;
			$invoice_reccuring_attempt++;
			$basic_invoice = $this->invoice->find($invoice->basic_invoice_id);
			$basic_invoice->update([ 'recurring_attempts' =>  $invoice_reccuring_attempt]);
		} else {
			$invoice_reccuring_attempt = $invoice->recurring_attempts;
		}
		
		$invoice_reccuring_attempt++;
		$invoice_perriod = $invoice->recurring_period_within_month;
		$status = 'approved';
		$invoice->update(['status' => $status, 'recurring_attempts' =>  $invoice_reccuring_attempt, 'payment_response' => $payments_response, 'payment_type' => 'reccuring']);
		return $invoice;
	}

	public function getNewInvoices()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->where('basic_invoice_id', 0)->whereNotIn('id', $invoice_ids)->get();
	}

	public function getYourInvoices()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->where('basic_invoice_id', 0)->whereIn('id', $invoice_ids)->get();
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
		
		$invoice = $this->invoice->find($id);
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
		//dd($invoices);
		//dd($id);
		$params = $this->getInvoiceParams($invoice, 'pending' , $id);
		// if(empty($invoices)) {
		// 	$params = $this->getInvoiceParams($invoice, 'initial' , $id);
		// } else {
		// 	$params = $this->getInvoiceParams($invoice, 'approved' , $id);
		// }
		
		return $this->invoice->create($params);
	}

	public function getInvoiceParams($invoice, $payment_type, $basic_invoice_id)
	{
		if($invoice->basic_invoice_id == 0) {
			$invoice_reccuring_attempt = $invoice->recurring_attempts;
			$invoice_reccuring_attempt ++;
		} else {
			$invoice_reccuring_attempt = $this->invoice
				->where('payment_type', 'initial')
				->where('status', $payment_type)
				->where('basic_invoice_id', $basic_invoice_id)
				->orderBy('id', 'DESC')->first()->recurring_attempts;
			$invoice_reccuring_attempt++;
		}
	
		$invoice_params = $invoice->toArray();
		$invoice_params['basic_invoice_id'] = $basic_invoice_id;
		$invoice_params['recurring_attempts'] = $invoice_reccuring_attempt;
		$invoice_params['payment_type'] = 'initial';
		return $invoice_params;
	}

	public function createDeclineInvoice($id)
	{
		$invoice = $this->invoice->find($id)->toArray();
		if($invoice->basic_invoice_id != 0) {
			$id = $invoice->basic_invoice_id;
		}
		$invoice['basic_invoice_id'] = $id;
		$invoice['payment_type'] = 'initial';
		$invoice['status'] = 'declined';
		return $this->invoice->create($invoice);
	}

	
}