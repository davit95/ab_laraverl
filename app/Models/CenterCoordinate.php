<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterCoordinate extends Model
{
    protected $table = 'centers_coordinates';
    protected $fillable = ['lat','lng'];
    public $timestamps = false;
}
