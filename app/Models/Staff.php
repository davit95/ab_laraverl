<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $fillable = ['name', 'title', 'photo_1', 'photo_2', 'ext_1', 'ext_2', 'email'];
}
