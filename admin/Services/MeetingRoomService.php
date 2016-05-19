<?php

namespace Admin\Services;

use Admin\Contracts\MeetingRoomInterface;

use App\Models\MeetingRoom;
use App\Models\MeetingRoomOption;
use App\Models\MeetingRoomSeo;
use App\Models\CenterFilter;
use App\Models\Center;
use App\Models\Photo;
use DB;
use File;
use Illuminate\Contracts\Validation\ValidationException;
use App\Exceptions\Custom\FailedTransactionException;

class MeetingRoomService implements MeetingRoomInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(MeetingRoom $meetingRoom,
								 MeetingRoomOption $meetingRoomOption,
								 MeetingRoomSeo $meetingRoomSeo,
								 Center $center,
								 Photo $photo,
								 CenterFilter $centerFilter) {
		$this->meetingRoom = $meetingRoom;
		$this->meetingRoomOption = $meetingRoomOption;
		$this->meetingRoomSeo = $meetingRoomSeo;
		$this->center = $center;
		$this->centerFilter = $centerFilter;
		$this->photo = $photo;
	}

	/**
	 * get all meeting Rooms.
	 *
	 * @param 
	 * @return Last 20 meeting rooms
	 */
	public function getMeetingRooms()
	{
		$max_mt_id = max($this->meetingRoom->lists('id')->toArray());
		$min_id = $max_mt_id - 20 ;
		return $this->meetingRoom->orderBy('id', 'desc')->take(20)->get();
	}

	/**
	 * upload files
	 *
	 * @param $files (file)
	 * @return filenames
	 */
	public function uploadFile($files)
	{
		$file_names = [];
		if ($files) {
			foreach ($files as $file) {
	        	$filename = str_random(20).".".$file->getClientOriginalExtension();
	        	$filenames[]['path'] = $filename;
	        	$file->move(public_path().'/mr-photos/all', $filename);
			}
	        return $filenames;
		}
		return '';
	}

	/**
	 * get photos ids
	 *
	 * @param $files (file)
	 * @return ids
	 */
	public function getPhotosIds($files)
	{
		$photo_ids = [];
		$max_photo_id = $this->photo->max('id');
		$ids = $this->photo->where('id', '>', $max_photo_id - count($files))->lists('id')->toArray();
		return $ids;
	}

	/**
	 * addd new meeting room
	 *
	 * @param $inputs, $files (array,file)
	 * @return meeting room
	 */
	public function addMeetingRoom($inputs, $files)
	{
		$data = new $this->meetingRoomOption($this->getMrOptionParams($inputs));
		$mr_data = $this->getMeetingRoomsParams($inputs);

		DB::beginTransaction();
		try {
			$mr = $this->meetingRoom->create($mr_data);
			$mr->options()->save($data);
			$this->centerFilter->where('center_id', $inputs['center_id'])->update(['meeting_room' => 1]);
			if($files) {
				$this->photo->insert($this->uploadFile($files));
				$this->center->find($inputs['center_id'])->mr_photos()->attach($this->getPhotosIds($files)[0] , ['mr_id' => $mr->id]);
			}
				
		}
		catch(\Exception $e)
		{
		    DB::rollback();
		    throw new FailedTransactionException('meeting room create failed', -1); 
		}
		DB::commit();
		return $mr;
	}

	/**
	 * get meeting room's create params
	 *
	 * @param $inputs (array)
	 * @return meeting room params
	 */
	public function getMeetingRoomsParams($inputs)
	{
		$mr = [];
		$mr['name'] = $inputs['mr_name'];
		$mr['capacity'] = $inputs['capacity'];
		$mr['hourly_rate'] = $inputs['rate'];
		$mr['half_day_rate'] = $inputs['half_day'];
		$mr['full_day_rate'] = $inputs['full_day'];
		$mr['min_hours_req'] = $inputs['min_hours'];
		$mr['floor'] = $inputs['floor'];
		$mr['center_id'] = $inputs['center_id'];
		return $mr;
	}

	/**
	 * get meeting room by id
	 *
	 * @param $mr_id (int)
	 * @return meeting room
	 */
	public function getMeetingRoomById($mr_id)
	{
		return $this->meetingRoom->find($mr_id);
	}

	/**
	 * get meeting room option by id
	 *
	 * @param $mr_id (int)
	 * @return options
	 */
	public function getMeetingRoomOptionsById($mr_id)
	{
		return $this->meetingRoomOption->where('meeting_room_id', $mr_id)->first();
	}

	/**
	 * update meeting room
	 *
	 * @param $mr_id, $inputs, $file (int,array,file)
	 * @return true
	 */
	public function updateMeetingRoom($mr_id, $inputs, $file)
	{
		$mr = $this->meetingRoom->where('id', $mr_id)->first();
		$mr_params = $this->getMeetingRoomsParams($inputs);
		$mr_option_params = $this->getMrOptionParams($inputs, $mr_id);

		DB::beginTransaction();
		try {
			$mr->where('id', $mr_id)->update($mr_params);
			$center = $this->center->find($inputs['center_id']);
			if($file) {
				$this->photo->insert($this->uploadFile($file));
				$center->mr_photos()->detach();
				$center->mr_photos()->attach($this->getPhotosIds($file)[0] , ['mr_id' => $mr->id]);
			}
			$this->meetingRoomOption->where('meeting_room_id', $mr_id)->update($mr_option_params);
		}
		catch(\Exception $e)
		{
		    DB::rollback();
			throw new FailedTransactionException('update failed', -1); 
		}
		DB::commit();
		return true;
	}

	/**
	 * get meeting room's params
	 *
	 * @param $inputs (array)
	 * @return array
	 */
	public function getMrOptionParams($inputs)
	{
		if(isset($inputs['n_connection'])) {
			$mr_option_params['network_rate'] = 0;
		} else {
			if($inputs['n_connection_rate'] === 0) {
				$mr_option_params['network_rate'] = '';
			} else {
				$mr_option_params['network_rate'] = $inputs['n_connection_rate'];
			}
		}
		if(isset($inputs['wireless'])) {
			$mr_option_params['wireless_rate'] = 0;
		} else {
			if($inputs['vireless_rate'] === 0) {
				$mr_option_params['wireless_rate'] = '';
			} else {
				$mr_option_params['wireless_rate'] = $inputs['vireless_rate'];
			}
		}
		if(isset($inputs['phone_access'])) {
			$mr_option_params['phone_rate'] = 0;
		} else {
			if($inputs['phone_access_rate'] === 0) {
				$mr_option_params['phone_rate'] = '';
			} else {
				$mr_option_params['phone_rate'] = $inputs['phone_access_rate'];
			}
			
		}
		if(isset($inputs['admin_services'])) {
			$mr_option_params['admin_services_rate'] = 0;
		} else {
			if($inputs['admin_services_rate'] === 0) {
				$mr_option_params['admin_services_rate'] = '';
			} else {
				$mr_option_params['admin_services_rate'] = $inputs['admin_services_rate'];
			}
		}
		if(isset($inputs['white_board'])) {
			$mr_option_params['whiteboard_rate'] = 0;
		} else {
			if($inputs['white_board_rate'] === 0) {
				$mr_option_params['whiteboard_rate'] = '';
			} else {
				$mr_option_params['whiteboard_rate'] = $inputs['white_board_rate'];
			}
		}
		if(isset($inputs['tv_dvd'])) {
			$mr_option_params['tvdvdplayer_rate'] = 0;
		} else {
			if($inputs['tv_dvd_rate'] === 0) {
				$mr_option_params['tvdvdplayer_rate'] = '';
			} else {
				$mr_option_params['tvdvdplayer_rate'] = $inputs['tv_dvd_rate'];
			}
		}
		if(isset($inputs['projector'])) {
			$mr_option_params['projector_rate'] = 0;
		} else {
			if($inputs['projector_rate'] === 0) {
				$mr_option_params['projector_rate'] = '';
			} else {
				$mr_option_params['projector_rate'] = $inputs['projector_rate'];
			}
		}
		if(isset($inputs['video_conf'])) {
			$mr_option_params['videoconferencing_rate'] = 0;
		} else {
			if($inputs['video_conf_rate'] === 0) {
				$mr_option_params['videoconferencing_rate'] = '';
			} else {
				$mr_option_params['videoconferencing_rate'] = $inputs['video_conf_rate'];
			}
		}

		return $mr_option_params;
	}

	/**
	 * delete file
	 *
	 * @param $filename (string)
	 * @return true
	 */
	public function deleteFile($filename)
	{
		if(File::exists(public_path().'/mr-photos/all/'.$filename))
		{
			File::delete(public_path().'/mr-photos/all/'.$filename);
		}
		return true;
	}

	/**
	 * get Photo by id
	 *
	 * @param $id (int)
	 * @return photo
	 */
	public function getPhotoById($id)
	{
		$mr = $this->meetingRoom->where('id', $id)->first();
		$center_id = $mr->center_id;
		$photo = $this->center->where('id', $center_id)->first()->mr_photos()->first();
		return $photo;
	}

	/**
	 * get Meeting room by owner id
	 *
	 * @param $owner_id (int)
	 * @return meeting room
	 */
	public function getMeetingRoomsByOwnerId($owner_id)
	{
		$center_ids = $this->filteredVirtualOffice()->where('owner_id', $owner_id)->lists('id');
		if($center_ids) {
			$centers =  $this->filteredMeetingRoom()->whereIn('id', $center_ids)->with('meeting_rooms')->get();
			foreach ($centers as $center) {
				$mr[] = collect($center->meeting_rooms);
			}
			
			return $mr[0];
		} else {
			return false;
		}
		
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
	 * Filter for meeting room before any query.
	 *
	 * @return Response
	 */
	private function filteredMeetingRoom() {
		return $this->center
		            ->where('active_flag', 'Y')
		            ->where('city_id', '!=', 0)
		            ->where(function ($q) {
				$q->whereHas('center_filter', function ($q) {
						$q->where('meeting_room', 1);})->orWhere(function ($q) {
						$q->has('center_filter', '<', 1);
					});
			});
	}

	/**
	 * get owner's meeting room by id
	 *
	 * @param $mr_id, $owner_id (int,int)
	 * @return meeting room
	 */
	public function getOwnerMeetingRoomById($mr_id, $owner_id)
	{
		$mr = $this->meetingRoom->find($mr_id);
		if($mr) {
			$center_id = $mr->center_id;
			$center = $this->center->find($center_id);
		} else {
			return false;
		}
		if($center->owner_id == $owner_id) {
			return $mr;
		} else {
			return false;
		}
	}

	/**
	 * get owner's center  by id
	 *
	 * @param $owner_id, $inputs (int,array)
	 * @return true
	 */
	public function getOwnerCenterByOwnerId($owner_id, $inputs)
	{
		$center = $this->center->where('id',$inputs['center_id'])->first();
		if($center) {
			if($center->owner_id == $owner_id) {
				return true;
			} else {
				return false;
			}
		} else {
			dd(404);
		}
	}
}