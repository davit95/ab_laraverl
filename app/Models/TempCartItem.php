<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempCartItem extends Model {
	protected $table = 'temp_cart_items';

	protected $fillable = ['temp_user_id', 'country_code', 'vo_mail_forwarding_price', 'price', 'vo_plan', 'vo_mail_forwarding_package', 'vo_mail_forwarding_frequency', 'mr_date', 'mr_end_time', 'mr_start_time', 'mr_id', 'center_id', 'type', 'live_receptionist', 'lr_id', 'lr_name', 'package_option', 'phone_number_selected'];

	/**
	 * Get the center for cart item.
	 */
	public function center() {
		return $this->belongsTo('App\\Models\\Center', 'center_id');
	}
}
