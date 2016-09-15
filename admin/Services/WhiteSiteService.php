<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\WhiteSiteServiceInterface;
use App\Models\WhiteSite;

class WhiteSiteService implements WhiteSiteServiceInterface
{
	/**
     * Create a new city service instance.
     */
	public function __construct(WhiteSite $whiteSite)
	{
		$this->whiteSite = $whiteSite;
	}

	public function getOfferings($user_id)
	{
		$whiteSite = $this->whiteSite->where('user_id', $user_id)->first();
		if($whiteSite != null){
			return [
				'virtual_offices_offers' => $whiteSite->virtual_offices_offers,
				'meeting_rooms_offers'   => $whiteSite->meeting_rooms_offers
			];
		}else{
			$this->whiteSite->create([
				'user_id' => $user_id
			]);
		}
		return [];
	}

	public function updateOfferings($user_id, $inputs)
	{
		$whiteSite = $this->whiteSite->where('user_id', $user_id)->first();
		if($whiteSite != null){
			if(!isset($inputs['virtual_offices_offers'])){
				$inputs['virtual_offices_offers'] = 0;
			}
			if(!isset($inputs['meeting_rooms_offers'])){
				$inputs['meeting_rooms_offers'] = 0;
			}
			return $whiteSite->update($inputs);
		}else{
			$inputs['user_id'] = $user_id;
			$whiteSite = $this->whiteSite->create($inputs);
			if(null!= $whiteSite){
				return true;
			}
		}
		return false;
	}

	public function updateLogo($user_id, $logo)
	{
		$whiteSite = $this->whiteSite->where('user_id', $user_id)->first();
		$destinationPath = public_path().'/whitesite_logos';        
		$name = str_random('20').'.'.$logo->getClientOriginalExtension();
		$logo->move($destinationPath, $name);		
		if($whiteSite != null){
			return $whiteSite->update([
				'logo' => $name
			]);
		}else{
			$whiteSite = $this->whiteSite->create([
				'user_id' => $user_id,
				'logo'    => $name
			]);
			if($whiteSite != null){
				return true;
			}
		}
		return false;
	}

	public function getUserWhiteSite($user_id)
	{
		return $this->whiteSite->where('user_id', $user_id)->first();
	}

	public function updateCompanyInformation($user_id, $inputs)
	{
		$whiteSite = $this->whiteSite->where('user_id', $user_id)->first();
		if($whiteSite != null){
			return $whiteSite->update($inputs);
		}else{
			$inputs['user_id'] = $user_id;
			$whiteSite = $this->whiteSite->create($inputs);
			if($whiteSite != null){
				return true;
			}
		}
		return false;
	}
}