<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminClients extends Model
{
    protected $table = 'admin_clients';
    protected $fillable = ['admin_id', 'invoice_id'];
    public $timestamps = false;
}
