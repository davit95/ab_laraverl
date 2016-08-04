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

	public function updateInvoiceStatus($id, $payments_response)
	{
		$invoice = $this->invoice->where('id', $id)->first();
		$invoice->update(['status' => 'approved', 'payment_response' => $payments_response]);
		return $invoice;
	}

	public function getNewInvoices()
	{
		$invoice_ids = $this->adminClients->where('admin_id', \Auth::id())->lists('invoice_id');
		return $this->invoice->whereNotIn('id', $invoice_ids)->get();
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

	
}