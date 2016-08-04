<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'type', 
                            'item_id', 
                            'basic_invoice_id', 
                            'payment_type', 
                            'price', 
                            'recurring_period_within_month',
                            'recurring_attempts',
                            'customer_id',
                            'status',
                            'payment_response',
                            'is_recurring',
                            ];

    public function customer()
    {
        return $this->hasOne('App\Models\User', 'id', 'customer_id');
    }

    public function item()
    {
        dd('item');
    }
}
