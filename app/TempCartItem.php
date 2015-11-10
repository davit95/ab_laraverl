<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCartItem extends Model
{
    protected $table = 'temp_cart_items';
    protected $fillable = ['temp_user_id', 'mr_date', 'mr_end_time', 'mr_start_time', 'mr_id', 'center_id', 'type'];
}
