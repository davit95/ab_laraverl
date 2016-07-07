<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterSpaceType extends Model
{
    protected $table = 'center_space_types';
    protected $fillable = ['center_id', 'type'];
}
