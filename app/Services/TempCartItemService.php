<?php

namespace App\Services;

use App\TempCartItem;

class TempCartItemService
{
	public function __construct(TempCartItem $tempCartItem)
	{
		$this->tempCartItem = $tempCartItem;
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
        return $this->tempCartItem->where('temp_user_id', $temp_user_id)->orderBy('updated_at', 'DESC')->get();
    }

}
