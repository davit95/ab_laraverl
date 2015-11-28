<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterPriceCurrency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'center_price_currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['center_price_id', 'currency_id', 'price', 'with_live_receptionist_pack_price', 'with_live_receptionist_full_price'];
}