<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use URL;

class Customer extends Model
{
   protected $fillable = [
   	'first_name',
   	'last_name',
   	'email',
   	'company_name',
   	'phone',
   	'address1',
   	'address2',
   	'country',
   	'city',
   	'state',
   	'postal_code',
   	'password',
   	'card_name',
   	'card_number',
   	'card_month',
   	'card_year',
   	'cvv2_number',
   	'status',
   	'fax',
   	'hint_answer',
   	'dv_user_key',
   	'dv_phone_number',
      'duration',
      'center_id',
      'live_receptionist',
      'package_option'
   ];
}
