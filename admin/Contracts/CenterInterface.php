<?php

namespace Admin\Contracts;

interface CenterInterface
{
	
	/*
	 * return one file name
	 */
	public function uploadFile($files);

	/*
	 * return array files names
	 */
	public function uploadFiles($files);

	/*
	 * return array photos ids
	 */
	public function getPhotosIds($files);

	/*
	 * return array by center params
	 */
	public function getCenterParams($inputs);

	/*
	 * return array by center prices params
	 */
	public function getPricesParams($inputs,$center_id);

	/*
	 * return array by Virtual offices seos params
	 */
	public function getVoSeosParams($inputs);

	/*
	 * return array by meeting rooms seos params
	 */
	public function getMrSeosParams($inputs);

	/*
	 * return array by center coordinates params
	 */
	public function getVoCoordParams($inputs);

	/*
	 * return array by center photos alts and captions params
	 */
	public function getPhotosALtsAndCaptions($inputs, $files);

	/*
	 * create center
	 */
	public function storeCenter($inputs, $files);

	/*
	 * Filter for virtuall office before any query.
	 */
	// private function filteredVirtualOffice();

	/*
	 * return array for update center
	 */
	public function getCenterUpdateParams($inputs);

	/*
	 * delete meeting rooms photo
	 */
	public function deleteFile($filename);

	/*
	 * return array for update photos
	 */
	public function getPhotosUpdateParams($inputs, $files);

	/*
	 * return array by photos names
	 */
	public function getFilenamesArray($files);

	/*
	 * return array by photos params for update
	 */
	public function getCenterPhotoUpdateParams($center_id,$inputs, $files);

	/*
	 * update center
	 */
	public function updateCenter($center_id, $inputs, $files, $params);

	/*
	 * return all centers
	 */
	public function getAllUscenters();

	/*
	 * return packages
	 */
	public function getPackages();

	/*
	 * return all centers with pagination
	 */
	public function getAllCenters();

	/*
	 * return one center`s coordinates by center id
	 */
	public function getCentersCoordinatesByCenterId($center_id);

	/*
	 * return one center`s prices by center id
	 */
	public function getCenterPrices($center_id);

	/*
	 * return one center`s photos by center id
	 */
	public function getPhotosByCenterId($center_id);

	/*
	 * return one virtual office by id
	 */
	public function getVirtualOfficeById($center_id);

	/*
	 * return array  center`s photos from params
	 */
	public function getCenterPhotosParams($inputs, $params, $files);

	/*
	 * return array  photos alts and captions
	 */
	public function getAvoPhotosALtsAndCaptions($inputs);

	/*
	 * return center by owner id
	 */
	public function getCentersByOwnerId($owner_id);

	/*
	 * return center by owner id and center id
	 */
	public function getOwnerVirtualOfficeById($center_id, $owner_id);

	/*
	 * return meeting rooms by center id
	 */
	public function getMeetingRoomsByCenterId($center_id);
}