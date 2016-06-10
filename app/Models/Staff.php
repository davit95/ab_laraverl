<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $fillable = ['name', 'title', 'phone_1', 'phone_2', 'ext_1', 'ext_2', 'email'];
}
