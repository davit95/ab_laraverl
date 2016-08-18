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
        $payment_response = $this->invoice->where('status', 'pending')->whereNotNull('payment_response')->lists('payment_response', 'id');

        foreach ($payment_response as $id => $response) {
            $tr_id_lists[$id] = unserialize($response)->id;
        }

        $collection = \Braintree_Transaction::search([
                \Braintree_TransactionSearch::status()->is(
                \Braintree_Transaction::SETTLED
            )
        ]);

        foreach ($tr_id_lists as $invoice_id => $tr_id) {
            if(in_array($tr_id, $collection->_ids)) {
                $this->invoice->find($invoice_id)->update(['status' => 'approved']);
            }
        }
    }
}
