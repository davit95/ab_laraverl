<?php

namespace Admin\Contracts;

interface MeetingRoomInterface
{

	/**
	 *
	 * 
	 * @param $owner_id (int)
	 * @return All meeting rooms
	 */
	public function getMeetingRooms();

	/**
	 * Upload file
	 *
	 * @param $files (file)
	 * @return Response
	 */
	public function uploadFile($files);

	/**
	 *
	 *
	 * @param $files (file)
	 * @return Photos ids
	 */
	public function getPhotosIds($files);

	/**
	 * Create meeting room
	 *
	 * @param $inputs, $files (array,file)
	 * @return Response
	 */
	public function addMeetingRoom($inputs, $files);

	/**
	 * 
	 *
	 * @param $inputs (array)
	 * @return Meeting room params
	 */
	public function getMeetingRoomsParams($inputs);

	/**
	 * 
	 *
	 * @param $mr_id (int)
	 * @return Meeting room by id
	 */
	public function getMeetingRoomById($mr_id);

	/**
	 * 
	 *
	 * @param $mr_id (int)
	 * @return Meeting room's options by mr_id
	 */
	public function getMeetingRoomOptionsById($mr_id);

	/**
	 * Update meeting room
	 *
	 * @param $mr_id, $inputs, $file (int,array,file)
	 * @return Response
	 */
	public function updateMeetingRoom($mr_id, $inputs, $file);

	/**
	 * 
	 *
	 * @param $inputs (array)
	 * @return meeting room's options params
	 */
	public function getMrOptionParams($inputs);

	/**
	 * delete file
	 *
	 * @param $filename (string)
	 * @return Response
	 */
	public function deleteFile($filename);

	/**
	 * 
	 *
	 * @param $id (int)
	 * @return Photos by id
	 */
	public function getPhotoById($id);

	/**
	 * get meeting room by owner id
	 *
	 * @param $owner_id (int)
	 * @return Meeting room
	 */
	public function getMeetingRoomsByOwnerId($owner_id);

	/**
	 * get owner's meeting room
	 *
	 * @param $mr_id,$owner_id (int,int)
	 * @return Meeting room
	 */
	public function getOwnerMeetingRoomById($mr_id, $owner_id);

	/**
	 * get owner's center by id
	 *
	 * @param $owner_id, $inputs (int,array)
	 * @return Center
	 */
	public function getOwnerCenterByOwnerId($owner_id, $inputs);

}