<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterPrice extends Model
{
    protected $table = 'centers_prices';

    public function package()
    {
    	return $this->belongsTo('App\\Product', 'package_id', 'part_number');
    }

    public function priceCurrency()
    {
    	return $this->hasMany('App\\Models\\CenterPriceCurrency', 'center_price_id');
    }

    public function getCurrentCurrencyPriceAttribute()
    {
		$rates = session('rates');
		$currency = session('currency.name');
		$currency_id = session('currency.id');
    	$current_price = $this->priceCurrency()->where('currency_id', $currency_id)->first();
    	if (is_null($current_price)) {
    		$currency_coefficient = $rates[$currency];
    		$price = $this->price*$currency_coefficient;
    		$with_live_receptionist_pack_price = $this->with_live_receptionist_pack_price*$currency_coefficient;
    		$with_live_receptionist_full_price = $this->with_live_receptionist_full_price*$currency_coefficient;

    		$current_price = (object)[
    			'price' => round($price, 2), 
    			'with_live_receptionist_pack_price' => round($with_live_receptionist_pack_price, 2), 
    			'with_live_receptionist_full_price' => round($with_live_receptionist_full_price, 2)];
    	}
    	return $current_price;
    }
}
