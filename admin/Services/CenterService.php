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

						/******************************/
						/*                            */
						/*   Center Create Section    */
						/*                            */
						/******************************/

	/**
	 * upload images for virtual office
	 *
	 * @return filenames
	 */
	public function uploadFile($files)
	{
		$file_names = [];
		if ($files) {
	        $file_names = str_random(20).".".$files->getClientOriginalExtension();
	        return $file_names;
		}
		return '';
	}


	/**
	 * upload images for virtual office
	 *
	 * @return filenames
	 */
	public function uploadFiles($files)
	{
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
				$file_names = str_random(20).".".$file->getClientOriginalExtension();
			}
	        
	        return $file_names;
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
		$ids = $this->photo->where('id', '>', $max_photo_id - count($this->uploadFiles($files)))->lists('id')->toArray();
		return $ids;
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

	public function getPhotosALtsAndCaptions($inputs, $files)
	{
		$number = 1;
		$photos = [];
		$alts = [];
		foreach ($inputs as $key => $value) {
			if(isset($inputs['image'.$number]) && $inputs['image'.$number] !== '') {
				$photos[$number]['path'] = $this -> uploadFile($inputs['image'.$number]);
				if(isset($inputs['photo_2_alt'.$number])) {
					$photos[$number]['alt'] = $inputs['photo_2_alt'.$number];
				}
				if(isset($inputs['photo_2_caption'.$number])) {
					$photos[$number]['caption'] = $inputs['photo_2_caption'.$number];
				}
			}
			$number ++;
		}
		//dd($photos);
		return $photos;	
	}

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeCenter($inputs, $files) {
		//dd($this->getAvoPhotosALtsAndCaptions($inputs));
		$params = $this->getCenterParams($inputs);

		$city = $this->city->where('name', $params['city_name'])->where('active', 1)->first();

		$params['city_id'] = $city->id;
		//$this->photo->insert($this->getPhotosALtsAndCaptions($inputs, $files, $city->name));
		//dd('a');
		
		$coordinates_data = new $this->centerCoordinate($this->getVoCoordParams($inputs));

		$center_filter_data = new $this->centerFilter(['virtual_office' => 0]);

		$meeting_room_seos_data = new $this->meetingRoomSeo($this->getMrSeosParams($inputs));

		$virtual_office_seos_data = new $this->virtualOfficeSeo($this->getVoSeosParams($inputs));

		DB::beginTransaction();

		try {
			$center = $this->center->create($params);

			$this->photo->insert($this->getPhotosALtsAndCaptions($inputs, $files, $city->name));

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


							/******************************/
							/*                            */
							/* Center Create Section Stop */
							/*                            */
							/******************************/


							/******************************/
							/*                            */
							/*   Center Update Section    */
							/*                            */
							/******************************/

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
		$center_params['name'] = $inputs['name'];
		return $center_params;
	}


	public function deleteFile($filename)
	{
		if(File::exists(public_path().'/mr-photos/all/'.$filename))
		{
			File::delete(public_path().'/mr-photos/all/'.$filename);
		}
		return true;
	}

	public function getPhotosUpdateParams($inputs, $files)
	{
		
		$alt_number = 1;
		$cap_number = 1;
		$alts_and_caps = [];
		foreach ($inputs as $key => $value) {
			if($inputs['photo_2_alt'.$alt_number] !== '' || $inputs['photo_2_caption'.$alt_number] !== '') {
				$alts_and_caps[$alt_number]['alt'] = $inputs['photo_2_alt'.$alt_number];
				$alts_and_caps[$alt_number]['caption'] = $inputs['photo_2_caption'.$alt_number];
				$alt_number++;
			}
		}
		return $alts_and_caps;

	}

	/**
	 * upload images for virtual office
	 *
	 * @return filenames
	 */
	public function getFilenamesArray($files)
	{
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
				$file_names[] = str_random(20).".".$file->getClientOriginalExtension();
			}
	        
	        return $file_names;
		}
		return '';
	}

	/**
	 * return center filter params for update center
	 *
	 * @return Response
	 */
	public function getCenterPhotoUpdateParams($center_id,$inputs, $files)
	{
		$alt_number = 1;
		$cap_number = 1;
		 //dd($inputs);
		// dd($this->getFilenamesArray($files));
		$alts_and_caps = [];
		foreach ($inputs as $key => $value) {
			if($inputs['photo_2_alt'.$alt_number] !== '' || $inputs['photo_2_caption'.$alt_number] !== '') {
				if(isset($inputs['image'.$alt_number])) {
					$alts_and_caps[$alt_number]['photo'] = $this->uploadFile($inputs['image'.$alt_number]);
					$alts_and_caps[$alt_number]['alt'] = $inputs['photo_2_alt'.$alt_number];
					$alts_and_caps[$alt_number]['caption'] = $inputs['photo_2_caption'.$alt_number];
					$alt_number++;
				} else {
					if(isset($inputs['photo_number'.$alt_number])) {
						$alts_and_caps[$alt_number]['id'] = $inputs['photo_number'.$alt_number];
						$alts_and_caps[$alt_number]['alt'] = $inputs['photo_2_alt'.$alt_number];
						$alts_and_caps[$alt_number]['caption'] = $inputs['photo_2_caption'.$alt_number];
						$alt_number++;
					}
				}
				
			}
		}
		return $alts_and_caps;
		//$a = $this->photo->insert($this->getPhotosALtsAndCaptions($inputs, $files, $inputs['city_name']));
		
	}

	/**
	 * update center 
	 *
	 * @return Response
	 */
	public function updateCenter($center_id, $inputs, $files)
	{
		$prices_params = $this->getPricesParams($inputs,$center_id);
		$vo_coord_params = $this->getVoCoordParams($inputs);
		$vo_seo_params = $this->getVoSeosParams($inputs);
		$mr_seo_params = $this->getMrSeosParams($inputs);
		$center_params = $this->getCenterUpdateParams($inputs);

		DB::beginTransaction();
		try {
			foreach ($this->getCenterPhotoUpdateParams($center_id, $inputs, $files) as $photo) {
				if(isset($photo['id'])) {
					$this->photo->where('id', $photo['id'])->update(['alt' => $photo['alt'], 'caption' => $photo['caption'] ]);
				} else {
					//$this->photo->insert($this->getPhotosALtsAndCaptions($inputs, $files, $inputs['city_name']));

					//$this->center->find($center->id)->vo_photos()->attach($this->getPhotosIds($files));
				}
			}

			if(isset($inputs['active'])) {
				$this->centerFilter->where('center_id', $center_id)->update(['virtual_office' => 1]);
			} else {
				$this->centerFilter->where('center_id', $center_id)->update(['virtual_office' => 0]);
			}
			$this->center->where('id', $center_id)->update($center_params);
			$this->centerPrice->where('center_id', $center_id)->update($prices_params);
			$this->centerCoordinate->where('center_id', $center_id)->update($vo_coord_params);
			$this->virtualOfficeSeo->where('center_id', $center_id)->update($vo_seo_params);
			$this->meetingRoomSeo->where('center_id', $center_id)->update($mr_seo_params);
		}
		catch(\Exception $e)
		{
		    DB::rollback();
			throw new FailedTransactionException('update failed', -1); 
		}
		DB::commit();
		return true;	
	}

						/******************************/
						/*                            */
						/* Center Update Section Stop */
						/*                            */
						/******************************/

	/**
	 * return all US centers
	 *
	 * @return Response
	 */
	public function getAllUscenters()
	{
		return $this->center->where('active_flag', 'Y')->get();
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

	public function getAllCenters()
	{
		return $this->center->paginate(10);
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
		return $this->center->where('id', $center_id)->first()->prices;
	}

	public function getCenterImagesIds($center)
	{
		dd($center->vo_photos->lists('id'));
	}

	public function getPhotosByCenterId($center_id)
	{
		$vo_photos = [];
		$photos = $this->center->find($center_id)->vo_photos;
		foreach ($photos as $photo_id => $photo) {
			$vo_photos[$photo_id + 1] = $photo;
		}
		return $vo_photos;
	}

	/**
	 * Get center by given id.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getVirtualOfficeById($center_id) {
		return $this->center->where('id', $center_id)->first();
	}

	public function test()
	{
		dd($this->center->where('id', 3920)->first()->meeting_rooms()->get());

		
		$center = $this->center->where('id', $center_id)->first();
		$photos_ids = $center->vo_photos->lists('id');
		$ids = [];
		$numbers = [];
		$matches = [];
		foreach ($photos_ids as $key => $value) {
			$ids[$key + 1] = $value;
		}
		foreach ($files as $str => $value) {
			preg_match_all('!\d+!', $str, $matches[]);
		}
		foreach ($matches as $key => $value) {
			foreach ($value as $k => $v) {
				array_push($numbers, $v[0]);
			}
		}
		dd($ids , $numbers);
	}

	public function getAvoPhotosALtsAndCaptions($inputs)
	{
		$center_city = $inputs['center_city'];
		$categories = [];
		$alts_array = [];
		$alts = [];
		$caps = [];
		$final_alts_arr = [];
		$final_capts_array = [];
		$final_array = [];
		$photos = [];
		if($inputs['category'] === 'IndividualOffice') {
			$alt1 = 'Virtual Offices ' . $center_city . ' - Temp Offices or Meeting Room';
			$alt2 = $center_city . ' Temporary Private Office or Meeting Room';
			$alt3 = 'Temporary ' . $center_city . ' Office - Meeting Room';
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = 'Try a Temporary Office or Meeting Room ';
			$cap2 = 'Meeting Room and Private Office in ' . $center_city;
			$cap3 = 'Temporary Office or Meeting Room in ' . $center_city;
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		if($inputs['category'] === 'building exterior') {
			$alt1 = $center_city . ' Virtual Office Address Location';
			$alt2 = $center_city . ' Business Address - Building Location';
			$alt3 = $center_city . ' Virtual Business Address, Office Location';
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = 'Virtual Office ' . $center_city . ' - Business Address and Meeting Rooms';
			$cap2 = $center_city . ' Virtual Office, Address and Conference Rooms';
			$cap3 = 'Virtual Offices, Business Addresses in ' . $center_city;
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		if($inputs['category'] === 'lobby') {
			$alt1 = $center_city . ' Live Receptionist and Business Address Lobby';
			$alt2 = 'Receptionist and Mail Area - ' . $center_city . ' Virtual Office';
			$alt3 = 'Receptionist Lobby - Virtual Offices in ' . $center_city;
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = 'Business Address Lobby in ' . $center_city;
			$cap2 = 'Virtual Office Lobby in ' . $center_city;
			$cap3 = $center_city . ' Virtual Office Address Lobby';
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		if($inputs['category'] === 'BreakRoom') {
			$alt1 = 'Break Room - Kitchen Area - ' . $center_city . ' Virtual Office';
			$alt2 = 'Break Area in ' . $center_city . ' Virtual Office';
			$alt3 = 'Break Area in ' . $center_city . ' Virtual Office Space';
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = 'Break Room - Take Five in this Virtual Office';
			$cap2 = 'Break Room for Our ' . $center_city . ' Office ';
			$cap3 = 'Break Area in ' . $center_city . ' Virtual Office Space';
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		if($inputs['category'] === 'CommonArea') {
			$alt1 = $center_city . ' Virtual Office Space - Comfortable Commons Area';
			$alt2 = $center_city . ' Virtual Office Address - Lounge Commons Area';
			$alt3 = $center_city . ' Busines Address - Lounge Area';
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = $center_city . ' Office Commons Area ';
			$cap2 = 'Lounge or commons area at our ' . $center_city . ' office';
			$cap3 = 'Business lounge commons area in ' . $center_city;
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		if($inputs['category'] === 'MeetingRoom') {
			$alt1 = 'Stylish ' . $center_city . ' Meeting Room';
			$alt2 = 'Nice Conference and Meeting Rooms in ' . $center_city;
			$alt3 = 'Turnkey ' . $center_city . ' Conference Room';
			array_push($alts, $alt1, $alt2, $alt3);
			array_push($final_alts_arr, $alts);
			$alts = [];

			$cap1 = 'Try an Alliance Conference Room in ' . $center_city;
			$cap2 = 'Try an Alliance Meeting Room in  ' . $center_city;
			$cap3 = 'Nice Meeting Venue in ' . $center_city;
			array_push($caps, $cap1, $cap2, $cap3);
			array_push($final_capts_array, $caps);
			$caps = [];
		}
		
		$final_array['alts'] = $final_alts_arr;
		$final_array['caps'] = $final_capts_array;
		return $final_array;
	}
	
	/**
	 * Get center by given id.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getCentersByOwnerId($owner_id) 
	{
		return $this->center->where('owner_id', $owner_id)->paginate(10);
	}

	/**
	 * Get center by given id.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getOwnerVirtualOfficeById($center_id, $owner_id) 
	{
		$center =  $this->center->where('owner_id', $owner_id)->where('id', $center_id)->first();
		if(null != $center) {
			return $center;
		} else {
			return false;
		}
	}
}