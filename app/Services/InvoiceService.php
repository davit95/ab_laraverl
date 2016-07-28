<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService {
	

	public function __construct(Invoice $invoice) 
	{
		$this->invoice = $invoice;
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

	
}