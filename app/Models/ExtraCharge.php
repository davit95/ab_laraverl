<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraCharge extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_extra_charges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'service', 'service_other', 'amount', 'period', 'step'];
}
