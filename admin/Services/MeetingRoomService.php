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
	 */
	public function getMeetingRooms()
	{
		return $this->meetingRoom->all();
	}

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

	public function getPhotosIds($files)
	{
		$photo_ids = [];
		$max_photo_id = $this->photo->max('id');
		$ids = $this->photo->where('id', '>', $max_photo_id - count($files))->lists('id')->toArray();
		return $ids;
	}

	/**
	 * add new meeting room
	 * @params inputs
	 */
	public function addMeetingRoom($inputs, $files)
	{
		$data = new $this->meetingRoomOption($this->getMrOptionParams($inputs));

		$mr_data = $this->getMeetingRoomsParams($inputs);

		DB::beginTransaction();
		try {
			$mr = $this->meetingRoom->create($mr_data);
			$mr->options()->save($data);
			$this->centerFilter->where('center_id', 3913)->update(['meeting_room' => 1]);
			$this->photo->insert($this->uploadFile($files));
			$this->center->find(3913)->mr_photos()->attach($this->getPhotosIds($files)[0] , ['mr_id' => $mr->id]);	
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
	 * return meeting rooms params
	 * @params inputs
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
		$mr['center_id'] = 3913;
		return $mr;
	}

	/**
	 * return meeting rooms by id
	 * @params mr_id
	 */
	public function getMeetingRoomById($mr_id)
	{
		return $this->meetingRoom->find($mr_id);
	}

	/**
	 * return meeting room option by id
	 * @params mr_id
	 */
	public function getMeetingRoomOptionsById($mr_id)
	{
		return $this->meetingRoomOption->where('meeting_room_id', $mr_id)->first();
	}

	/**
	 * update meeting room 
	 *
	 * @return Response
	 */
	public function updateMeetingRoom($mr_id, $inputs)
	{
		$mr_params = $this->getMeetingRoomsParams($inputs);
		$mr_option_params = $this->getMrOptionParams($inputs, $mr_id);
		DB::beginTransaction();
		try {
			$this->meetingRoom->where('id', $mr_id)->update($mr_params);
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

	public function getMrOptionParams($input)
	{
		$mr_option_params = [];
		$mr_option_params['room_description'] = $input['room_description'];
		$mr_option_params['parking_rate'] = $input['parking_rate'];
		$mr_option_params['parking_description'] = $input['park_desc'];
		$mr_option_params['network_rate'] = $input['n_connection_rate'];
		$mr_option_params['wireless_rate'] = $input['vireless_rate'];
		$mr_option_params['phone_rate'] = $input['phone_access_rate'];
		$mr_option_params['admin_services_rate'] = $input['admin_services_rate'];
		$mr_option_params['whiteboard_rate'] = $input['white_board_rate'];
		$mr_option_params['tvdvdplayer_rate'] = $input['tv_dvd_rate'];
		$mr_option_params['projector_rate'] = $input['projector_rate'];
		return $mr_option_params;
	}
}