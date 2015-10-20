<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelephonyPackageInclude extends Model
{
    protected $table = 'telephony_package_includes';

    public function package()
    {
      return $this->belongsTo('App\\Product',  'package_id', 'part_number');
    }
}
