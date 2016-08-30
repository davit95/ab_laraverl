<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\User;

class ChangePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, User $user)
    {
        $this->invoice = $invoice;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $braintree_enviorenment = config('braintree.env');
        $braintree_configs = [];
        if($braintree_enviorenment == 'production') {
            $braintree_configs = config('braintree.production_credentials');
        } elseif($braintree_enviorenment == 'sandbox') {
            $braintree_configs = config('braintree.sandbox_credentials');
        } else {
            throw new Exception("Braintree enviorenment was incorrect. must be 'production or sandbox'", 1);
            
        }
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        $tr_id_lists = [];
        $payment_response = $this->invoice
            ->where('status', 'pending')
            ->where('payment_type', 'recurring')
            ->whereNotNull('payment_response')
            ->lists('payment_response', 'id');
        //dd($payment_response);
        foreach ($payment_response as $id => $response) {
            $tr_id_lists[$id] = unserialize($response)->id;
        }

        if(!empty($tr_id_lists)) {
            $collection = \Braintree_Transaction::search([
                    \Braintree_TransactionSearch::ids()->in(
                    array_values($tr_id_lists)
                )
            ]);
            $invoices = [];
            foreach ($collection as $key => $value) {
                if($value->status == 'settled') {
                    $invoices[$value->id] = 'approved';
                } elseif($value->status == 'failed') {
                    $invoices[$value->id] = $value->status;
                    // An error occurred when sending the transaction to the processor
                } elseif($value->status == 'settlement_pending') {
                    $invoices[$value->id] = $value->status;
                    // The transaction has not yet fully settled. This status is rare and is only returned in certain situations.
                } elseif($value->status == 'settlement_declined') {
                    $invoices[$value->id] = $value->status;
                    // The processor declined to settle the sale or refund request, and the result is unsuccessful. 
                } elseif($value->status == 'voided') {
                    $invoices[$value->id] = $value->status;
                    // The transaction was voided
                } elseif($value->status == 'processor_declined') {
                    $invoices[$value->id] = $value->status;
                    // The processor declined the verification. 
                } elseif($value->status == 'gateway_rejected') {
                    $invoices[$value->id] = $value->status;
                    // The gateway rejected the transaction because AVS, CVV, duplicate, or fraud checks failed, or because you have reached the processing limit on your provisional merchant account.
                } elseif($value->status == 'settling') {
                    $invoices[$value->id] = $value->status;
                    // The transaction is in the process of being settled. This is a transitory state. A transaction cannot be voided once it reaches settling status, but can be refunded.
                } elseif($value->status == 'submitted_for_settlement') {
                    $invoices[$value->id] = $value->status;
                    // The transaction has been submitted for settlement and will be included in the next settlement batch. Settlement happens nightly — the exact time depends on the processor.
                } elseif($value->status == 'authorization_expired') {
                    $invoices[$value->id] = $value->status;
                    // The transaction spent too much time in the Authorized status and was marked as expired. American Express authorizations will be marked as expired after 7 days. Visa and Mastercard authorizations will be marked as expired after 10 days. All other authorizations will be marked as expired after 30 days.
                } elseif($value->status == 'authorized') {
                    $invoices[$value->id] = $value->status;
                    // The processor authorized the transaction. Your customer may see a pending charge on his or her account. However, before the customer is actually charged and before you receive the funds, you must submit the transaction for settlement. If you do not want to settle the transaction, you should void it to avoid a misuse of authorization fee.
                }
            }
            $ids = [];
            foreach ($invoices as $tr_id => $status) {
                $ids[array_search($tr_id, $tr_id_lists)] = $status;
            }
            foreach ($ids as $id => $status) {
                $this->invoice->find($id)->update(['status' => $status]);
            }
        }     
    }
}
