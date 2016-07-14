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
		return $this->invoice->where('status', 'pending')->with('customer')->get();
	}

	public function createInvoices($invoices)
	{
		return $this->invoice->insert($invoices);
	}

	public function getInvoiceById($id)
	{
		return $this->invoice->where('id', $id)->with('customer')->first();
	}

	
}