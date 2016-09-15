<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'customers_balances';
    protected $fillable = 
    [
       'customer_id',
       'amount',
       'type',
       'number',
       'receive_date',
       'notes'
    ];
}
