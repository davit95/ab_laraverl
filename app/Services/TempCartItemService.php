<?php

namespace App\Services;

use App\Models\Package;
use App\Models\TempCartItem;

class TempCartItemService {
	public function __construct(TempCartItem $tempCartItem, Package $package) {
		$this->tempCartItem = $tempCartItem;
		$this->package      = $package;
	}

	/**
	 * Create new resource in temp_cart_items table.
	 *
	 * @return Response
	 */
	public function create($params) {		
		return $this->tempCartItem->create($params);
	}

	/**
	 * Get resources from temp_cart_items by temp_user_id.
	 * @param sting
	 * @return Response
	 */
	public function getItemsByTempUserId($temp_user_id) {
		return $this->tempCartItem->where('temp_user_id', $temp_user_id)->orderBy('updated_at', 'DESC')->orderBy('type', 'DESC')->get();
	}

	/**
	 * Get resources from temp_cart_items by part_number.
	 * @param sting
	 * @return Response
	 */
	public function getPackageName($part_number) {
		return $this->package->where('part_number', $part_number)->first()->name;
	}

	public function update($temp_user_id, $inputs) {
		$cart_item = $this->tempCartItem->where('temp_user_id', $temp_user_id)->orderBy('created_at', 'DESC')->first();
		if (is_null($cart_item)) {
			return false;
		}
		$cart_item->package_option        = $inputs['package_option'];
		$cart_item->country_code          = $inputs['country_code'];
		$cart_item->phone_number_selected = $inputs['phone_number_selected'];

		return $cart_item->save();
	}

	/*
	 * Remove the specified resource from storage.
	 */
	public function destroyItem($id, $temp_user_id) {
		return $this->tempCartItem->where('temp_user_id', $temp_user_id)->where('id', $id)->delete();
	}

	public function updateUserId($temp_user_id, $id){
		$cart_item = $this->tempCartItem->where('temp_user_id', $temp_user_id)->orderBy('created_at', 'DESC')->first();
		if (is_null($cart_item)) {
			return false;
		}
		$cart_item->user_id  = $id;

		return $cart_item->save();
	}
}
