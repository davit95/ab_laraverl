<?php

namespace Admin\Services;

use Admin\Contracts\MeetingRoomInterface;

use App\Models\MeetingRoom;

class MeetingRoomService implements MeetingRoomInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(MeetingRoom $meetingRoom) {
		$this->meetingRoom = $meetingRoom;
	}

	public function getMeetingRooms()
	{
		return $this->meetingRoom->all();
	}
}