<?php

namespace Admin\Services;

use Admin\Contracts\MeetingRoomInterface;

use App\Models\MeetingRoom;
use App\Models\MeetingRoomOption;

class MeetingRoomService implements MeetingRoomInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(MeetingRoom $meetingRoom, MeetingRoomOption $meetingRoomOption) {
		$this->meetingRoom = $meetingRoom;
		$this->meetingRoomOption = $meetingRoomOption;
	}

	/**
	 * get all meeting Rooms.
	 */
	public function getMeetingRooms()
	{
		return $this->meetingRoom->all();
	}

	/**
	 * add new meeting room
	 * @params inputs
	 */
	public function addMeetingRoom($inputs)
	{
		dd($inputs);
		$data = new $this->meetingRoomOption(['parking_description' => $inputs['room_description'], 'meeting_room_id' => 100]);
		unset($inputs['_token']);
		$inputs['name'] = $inputs['room_description'];
		$inputs['center_id'] = 100;
		$meeting_room = $this->meetingRoom->create($inputs);
		$meeting_room->options()->save($data);
	}
}