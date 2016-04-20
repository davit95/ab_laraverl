<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Admin\Contracts\OwnerInterface;
use Admin\Contracts\CityInterface;
use Admin\Contracts\RegionInterface;
use Admin\Contracts\UsStateInterface;
use Admin\Contracts\CountryInterface;
use Admin\Http\Requests\OwnerRequest;
use Admin\Http\Requests\MeetingRoomRequest;
use Admin\Contracts\MeetingRoomInterface;
use App\Exceptions\Custom\FailedTransactionException;

class MeetingRoomsController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MeetingRoomInterface $meetingRoomService)
    {
        // //dd($meetingRoomService->getMeetingRooms()->first());
        return view('admin.owners.parts._meeting-rooms-show', 
                    ['meetingRooms' => $meetingRoomService->getMeetingRooms()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centers.add_meeting_room');
    }

    public function addMeetingRoom($center_id)
    {
        return view('admin.centers.add_meeting_room',['center_id' => $center_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRoomRequest $request, MeetingRoomInterface $meetingRoomService)
    {
        try {
            if (null != $mr = $meetingRoomService->addMeetingRoom($request->all(), $request->file()) ) {
                return redirect('meeting-rooms')->withSuccess('meeting room has been successfully added.');
            }
        }
        catch(FailedTransactionException $e)
        {
            if($e->getCode() === -1) {
                return redirect('meeting-rooms/create')->withWarning('Whoops, looks like something went wrong, please try later.');
            }
        }
        //dd($meetingRoomService->addMeetingRoom($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, MeetingRoomInterface $meetingRoomService)
    {
        //dd($meetingRoomService->getMeetingRoomOptionsById($id));
        return view('admin.centers.add_meeting_room', [
                'mr' => $meetingRoomService->getMeetingRoomById($id),
                'mr_options' => $meetingRoomService->getMeetingRoomOptionsById($id),
                'photo' => $meetingRoomService->getPhotoById($id)           
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, MeetingRoomInterface $meetingRoomService)
    {
        try {
            if ($mr = $meetingRoomService->updateMeetingRoom($id, $request->all(), $request->file()) ) {
                return redirect('meeting-rooms/create')->withSuccess('Center has been successfully updated.');
            }
        }
        catch(FailedTransactionException $e)
        {
            if($e->getCode() === -1) {
                return redirect()->back()->withWarning('Whoops, looks like something went wrong, please try later.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
