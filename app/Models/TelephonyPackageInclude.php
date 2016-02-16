<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelephonyPackageInclude extends Model
{
    protected $table = 'telephony_package_includes';

    public function package()
    {
      return $this->belongsTo('App\\Models\\Package', 'package_id', 'part_number');
    }
}
