<?php

namespace Admin\Http\Requests;

use App\Http\Requests\Request;

class MeetingRoomRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mr_photo'  => 'required',
            'mr_name' => 'required',
            // 'capacity' => 'required',
            'rate' => 'required',
            'half_day' => 'required',
            'full_day' => 'required',
            'min_hours' => 'required',
            // 'room_description' => 'required',
            // 'white_board' => 'required',
            // 'white_board_rate' => 'required',
            // 'tv_dvd' => 'required',
            // 'tv_dvd_rate' => 'required',
            // 'projector' => 'required',
            // 'video_conf' => 'required',
            // 'video_conf_rate' => 'required',
            // 'vc_equipment' => 'required',
            // 'bridge_connect' => 'required',
            // 'catering' => 'required',
            // 'cc_accepted' => 'required',
            // 'n_connection' => 'required',
            // 'n_connection_rate' => 'required',
            // 'vireless' => 'required',
            // 'vireless_rate' => 'required',
            // 'phone_access' => 'required',
            // 'phone_access_rate' => 'required',
            // 'admin_services' => 'required',
            // 'admin_services_rate' => 'required',
            // 'parking' => 'required',
            // 'parking_rate' => 'required',
            // 'park_desc' => 'required'
        ];
    }
}
