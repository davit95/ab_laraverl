<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterFilter extends Model
{
    protected $table = 'centers_filters';
    protected $fillable = ['virtual_office'];
    public $timestamps = false;
}
