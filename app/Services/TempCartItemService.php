<?php

namespace App\Services;

use App\Models\TempCartItem;
use App\Models\Package;

class TempCartItemService
{
	public function __construct(TempCartItem $tempCartItem, Package $package )
	{
        $this->tempCartItem = $tempCartItem;
		$this->package = $package;
	}

	/**
     * Create new resource in temp_cart_items table.
     *
     * @return Response
     */
	public function create($params)
	{
		return $this->tempCartItem->create($params);
	}

    /**
     * Get resources from temp_cart_items by temp_user_id.
     * @param sting
     * @return Response
     */
    public function getItemsByTempUserId($temp_user_id)
    {
        return $this->tempCartItem->where('temp_user_id', $temp_user_id)->orderBy('updated_at', 'DESC')->orderBy('type', 'DESC')->get();
    }

    /**
     * Get resources from temp_cart_items by part_number.
     * @param sting
     * @return Response
     */
    public function getPackageName($part_number)
    {
        return $this->package->where('part_number', $part_number)->first()->name;
    }

    public function update($temp_user_id, $inputs)
    {
        return $this->tempCartItem->where('temp_user_id', $temp_user_id)->update( $inputs );
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroyItem($id, $temp_user_id)
    {
        return $this->tempCartItem->where('temp_user_id', $temp_user_id)->where('id', $id)->delete();
    }
}
