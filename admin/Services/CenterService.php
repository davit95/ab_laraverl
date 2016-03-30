<?php

namespace Admin\Services;

use Admin\Contracts\CenterInterface;

use App\Models\CenterCoordinate;
use App\Models\Center;
use App\Models\Photo;
use App\Models\UsState;
use App\Models\Country;
use App\Models\City;
use App\Models\Package;
use App\Models\CenterFilter;
use App\Models\CenterPrice;
use App\Models\VirtualOfficeSeo;
use App\Models\MeetingRoomSeo;
use DB;
use App\Exceptions\Custom\FailedTransactionException;



class CenterService implements CenterInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center, 
		Photo $photo, 
		CenterCoordinate $centerCoordinate, 
		UsState $usState, 
		Country $country, 
		City $city,
		Package $package,
		CenterFilter $centerFilter,
		CenterPrice $centerPrice,
		VirtualOfficeSeo $virtualOfficeSeo,
		MeetingRoomSeo $meetingRoomSeo
		) {
		$this->center = $center;
		$this->photo  = $photo;
		$this->usState = $usState;
		$this->country = $country;
		$this->city = $city;
		$this->centerCoordinate = $centerCoordinate;
		$this->package = $package;
		$this->centerFilter = $centerFilter;
		$this->centerPrice = $centerPrice;
		$this->virtualOfficeSeo = $virtualOfficeSeo;
		$this->meetingRoomSeo = $meetingRoomSeo;
	}

	/**
	 * upload images for virtual office
	 *
	 * @return filenames
	 */
	public function uploadFile($files)
	{
		//dd($files);
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
	        	$filenames[]['path'] = str_random(20).".".$file->getClientOriginalExtension();
			}
	        return $filenames;
		}
		return '';
	}

	/**
	 * return photos ids
	 *
	 * @return ids
	 */
	public function getPhotosIds($files)
	{
		$photo_ids = [];
		$max_photo_id = $this->photo->max('id');
		$ids = $this->photo->where('id', '>', $max_photo_id - count($this->uploadFile($files)))->lists('id')->toArray();
		return $ids;
	}

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeCenter($inputs, $files) {

		$params = $this->getCenterParams($inputs);

		$city = $this->city->where('name', $params['city_name'])->where('active', 1)->first();

		$params['city_id'] = $city->id;

		$coordinates_data = new $this->centerCoordinate($this->getVoCoordParams($inputs));

		$center_filter_data = new $this->centerFilter(['virtual_office' => 1]);

		$meeting_room_seos_data = new $this->meetingRoomSeo($this->getMrSeosParams($inputs));

		$virtual_office_seos_data = new $this->virtualOfficeSeo($this->getVoSeosParams($inputs));

		DB::beginTransaction();

		try {
			$center = $this->center->create($params);

			$this->photo->insert($this->uploadFile($files));
			$this->center->find($center->id)->vo_photos()->attach($this->getPhotosIds($files));

			$prices_data = $this->getPricesParams($inputs,$center->id);

			$center_price = $this->centerPrice->insert($prices_data);

			$center->coordinate()->save($coordinates_data);

			$center->center_filter()->save($center_filter_data);

			$center->virtual_office_seo()->save($virtual_office_seos_data);
			
			$center->meeting_room_seo()->save($meeting_room_seos_data);
		}
		catch(\Exception $e)
		{
		    DB::rollback();
		    throw new FailedTransactionException('center create failed', -1); 
		}
		DB::commit();
		return $center;
	}

	/**
	 * return all US centers
	 *
	 * @return Response
	 */
	public function getAllUscenters()
	{
		return $this->center->where('active_flag', 'Y')->get();
	}

	/*
	 * @return array with city params
	 */
	public function getCenterParams($inputs)
	{
		$state = $this->usState->where('name', $inputs['states'])->first();
		if($state) {
			$inputs['us_state_id'] = $state->id;
			$inputs['us_state_code'] = $state->code;
			$inputs['us_state'] = $state->code;	
		}
		$country = $this->country->where('name', $inputs['countries'])->first();
		$inputs['name'] = $inputs['name'];
		$inputs['city_name'] = $inputs['city_name'];
		$inputs['address1'] = $inputs['address1'];
		$inputs['slug'] = strtolower($inputs['name']);
		$inputs['country_id'] = $country->id;
		$inputs['country_code'] = $country->code;
		$inputs['country'] = $country->code;
		$inputs['active_flag'] = 'Y';
		return $inputs;
	}

	/**
	 * return packeges
	 *
	 * @return Response
	 */
	public function getPackages()
	{
		return $this->package->get();
	}

	/*
	 * @return array with prices params
	 */
	public function getPricesParams($inputs,$center_id)
	{
		$platinum = [];
		$platinum_plus = [];
		$platinum['price'] = $inputs['price'];
		$platinum['package_id'] = 103;
		$platinum['with_live_receptionist_pack_price'] = $inputs['with_live_receptionist_pak_price'];
		$platinum['with_live_receptionist_full_price'] = $inputs['with_live_receptionist_full_price'];
		$platinum['center_id'] = $center_id;
		if(isset($inputs['plus_package']) && $inputs['plus_package']=== 'Platinum Plus') {
			$platinum_plus['price'] = $inputs['plus_price'];
			$platinum_plus['package_id'] = 105;
			$platinum_plus['with_live_receptionist_pack_price'] = $inputs['plus_with_live_receptionist_full_price'];
			$platinum_plus['with_live_receptionist_full_price'] = $inputs['plus_with_live_receptionist_pak_price'];
			$platinum_plus['center_id'] = $center_id;
			$package_arr = [$platinum,$platinum_plus];
			return $package_arr;
		}
		return $platinum;
	}

	/*
	 * @return array with images params
	 */
	public function getImagesParams($inputs)
	{
		$image_names = ['image1','image2','image3','image4','image5','image6'];
		$images = [];
		$photos = [];
		foreach ($inputs as $key => $value) {
			if(in_array($key, $image_names)){
				/*array_push($photos, array($value));*/
				$photos[] = array('path' => $value);
			}
		}
		return $photos;
	}

	/**
	 * return virtual office by center id
	 *
	 * @return Response
	 */
	public function getVirtualOfficeById($center_id) {
		return $this->filteredVirtualOffice()->where('id', $center_id)->first();
	}

	/**
	 * Filter for virtuall office before any query.
	 *
	 * @return Response
	 */
	private function filteredVirtualOffice() {
		return $this->center
		            ->where('active_flag', 'Y')
		            ->where('city_id', '!=', 0)
		            ->where(function ($q) {
				$q->whereHas('center_filter', function ($q) {
						$q->where('virtual_office', 1);
					})->orWhere(function ($q) {
						$q->has('center_filter', '<', 1);
					});
			});
	}

	/**
	 * return center coordinates by center id
	 *
	 * @return Response
	 */
	public function getCentersCoordinatesByCenterId($center_id)
	{
		return $this->centerCoordinate->where('center_id', $center_id)->first();
	}

	/**
	 * filter center and return center by id
	 *
	 * @return Response
	 */
	public function getCenterPrices($center_id)
	{
		return $this->filteredVirtualOffice()->where('id', $center_id)->first()->prices;
	}

	// public function updatePost($id,$inputs,$file)
	// {
	// 	$post = $this->getPostById($id);
	// 	if ($file) {
	// 	    $this->deleteFile($post->image);
	// 	    $inputs['image'] = $this->uploadFile($file);
	// 	}
	// 	return $this->getPostById($id)->update($inputs);
	// }

	public function deleteFile($filename)
	{
		if(File::exists(public_path().'/mr-photos/all/'.$filename))
		{
			File::delete(public_path().'/mr-photos/all/'.$filename);
		}
		return true;
	}

	/**
	 * update center 
	 *
	 * @return Response
	 */
	public function updateCenter($center_id, $inputs, $files)
	{
		$center = $this->center->find($center_id);
		dd($this->uploadFile($this->getUpdateImageParams($center->vo_photos)));
		//dd($center_id, $inputs, $files);
		$prices_params = $this->getPricesParams($inputs,$center_id);
		$vo_coord_params = $this->getVoCoordParams($inputs);
		$vo_seo_params = $this->getVoSeosParams($inputs);
		$mr_seo_params = $this->getMrSeosParams($inputs);
		$center_params = $this->getCenterUpdateParams($inputs);
		DB::beginTransaction();
		try {
			$this->center->where('id', $center_id)->update($center_params);
			$this->centerPrice->where('center_id', $center_id)->update($prices_params);
			$this->centerCoordinate->where('center_id', $center_id)->update($vo_coord_params);
			$this->virtualOfficeSeo->where('center_id', $center_id)->update($vo_seo_params);
			$this->meetingRoomSeo->where('center_id', $center_id)->update($mr_seo_params);

			//$post->vo_photo()->detach();
			$this->photo->insert($this->uploadFile($files));
		}
		catch(\Exception $e)
		{
		    DB::rollback();
			throw new FailedTransactionException('update failed', -1); 
		}
		DB::commit();
		return true;;
	}

	public function getUpdateImageParams($files)
	{
		$photos = [];
		foreach ($files as $id => $photo) {
			$photos['image'.($id + 1)] = $photo->path;
		}
		return $photos;
	}


	/**
	 * return center filter params for update center
	 *
	 * @return Response
	 */
	public function getCenterUpdateParams($inputs)
	{
		$center_params = [];
		$center_params['building_name'] = $inputs['building_name'];
		$center_params['address1'] = $inputs['address1'];
		$center_params['city_name'] = $inputs['city_name'];
		return $center_params;
	}

	/**
	 * return virtual office seo params for update center
	 *
	 * @return Response
	 */
	public function getVoSeosParams($inputs)
	{
		$vo_seo_params = [];
		$vo_seo_params['sentence1'] = $inputs['sentence1'];
		$vo_seo_params['sentence2'] = $inputs['sentence2'];
		$vo_seo_params['sentence3'] = $inputs['sentence3'];
		$vo_seo_params['avo_description'] = $inputs['avo_description'];
		$vo_seo_params['meta_title'] = $inputs['meta_title'];
		$vo_seo_params['meta_description'] = $inputs['meta_description'];
		$vo_seo_params['meta_keywords'] = $inputs['meta_keywords'];
		$vo_seo_params['h1'] = $inputs['h1'];
		$vo_seo_params['h2'] = $inputs['h2'];
		$vo_seo_params['h3'] = $inputs['h3'];
		$vo_seo_params['seo_footer'] = $inputs['seo_footer'];
		$vo_seo_params['abcn_description'] = $inputs['abcn_description'];
		$vo_seo_params['subhead'] = $inputs['subhead'];
		return $vo_seo_params;
	}

	/**
	 * return virtual office seo params for update center
	 *
	 * @return Response
	 */
	public function getMrSeosParams($inputs)
	{
		$mr_seo_params = [];
		$mr_seo_params['sentence1'] = $inputs['mr_sentence1'];
		$mr_seo_params['sentence2'] = $inputs['mr_sentence2'];
		$mr_seo_params['sentence3'] = $inputs['mr_sentence3'];
		$mr_seo_params['avo_description'] = $inputs['mr_avo_description'];
		$mr_seo_params['meta_title'] = $inputs['mr_meta_title'];
		$mr_seo_params['meta_description'] = $inputs['mr_meta_description'];
		$mr_seo_params['meta_keywords'] = $inputs['mr_meta_keywords'];
		$mr_seo_params['h1'] = $inputs['mr_h1'];
		$mr_seo_params['h2'] = $inputs['mr_h2'];
		$mr_seo_params['h3'] = $inputs['mr_h3'];
		$mr_seo_params['seo_footer'] = $inputs['mr_seo_footer'];
		$mr_seo_params['abcn_description'] = $inputs['mr_abcn_description'];
		$mr_seo_params['subhead'] = $inputs['mr_subhead'];
		return $mr_seo_params;
	}

	/**
	 * return virtual office coordinate params for update center
	 *
	 * @return Response
	 */
	public function getVoCoordParams($inputs)
	{
		$vo_coord_params = [];
		$vo_coord_params['lat'] = $inputs['lat'];
		$vo_coord_params['lng'] = $inputs['lng'];
		return $vo_coord_params;	
	}

	public function test($center_id)
	{
		$vo_photos = [];
		$photos = $this->center->find($center_id)->vo_photos;
		foreach ($photos as $photo_id => $photo) {
			$vo_photos[$photo_id + 1] = $photo;
		}
		return $vo_photos;
	}
}