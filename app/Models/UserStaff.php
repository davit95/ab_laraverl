<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStaff extends Model
{
    protected $table = 'user_staffs';
    protected $fillable = ['user_id', 'staff_id'];
    public $timestamps = false;
}
