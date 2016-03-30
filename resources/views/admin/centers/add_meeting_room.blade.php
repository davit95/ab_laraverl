@extends('admin.layouts.layout')

@section('page-header')
	Meeting Room
@stop
@section('content_top')	
	<div class="ct_icon_add"></div> 
	<div class="ct_wrapp">
	<div class="ct_title"><h1>MEETING ROOM</h1></div> 
	<div class="ct_tools">
	<p class="h1Desc">Bala Plaza Business Center, 101 Lindenwood Drive, Suite 225, Malvern, PA</p>
	</div> 
	</div> 
	<div class="clear"></div>	
@stop
@section('content')
	@include('alerts.messages')
	@if(isset($mr))
	    {!! Form::model($mr,array('url' => '/meeting-rooms/'.$mr->id, 'method' => 'PUT', 'role' => 'form','files' => true)) !!}
	@else
	{!! Form::open([ 'url' => url('/meeting-rooms') , 'method' => 'POST', 'class' => 'ownersForm', 'files' => true]) !!}
	@endif
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
				<span class="left">MEETING ROOM'S BASIC INFORMATION</span>
			</h3><br>
			MR Name:&nbsp;
				{!! Form::text('mr_name', isset($mr->name) ? $mr->name : null,[ 'class' => 'f1']) !!}
				<br>
			Capacity:&nbsp; 
				<div class="inpAlign">
					{!! Form::text('capacity', isset($mr->capacity) ? $mr->capacity : null,[ 'class' => 'f3']) !!}
				</div>
				<div class="clear"></div>
			Rate:&nbsp; 
				<div class="inpAlign">
					{!! Form::text('rate', isset($mr->hourly_rate) ? $mr->hourly_rate : null,[ 'class' => 'f3']) !!} / per hour
				</div>
				<div class="clear"></div>
			<div class="inpAlign">
				{!! Form::text('half_day', isset($mr->half_day_rate) ? $mr->half_day_rate : null,[ 'class' => 'f3']) !!} / half day
			</div>
			<div class="clear"></div>
			<div class="inpAlign">
				{!! Form::text('full_day', isset($mr->full_day_rate) ? $mr->full_day_rate : null,[ 'class' => 'f3']) !!} / full day
			</div>
			<div class="clear"></div>
			Floor:&nbsp;
			<div class="inpAlign">
					{!! Form::text('floor', isset($mr->floor) ? $mr->floor : null,[ 'class' => 'f3']) !!} 
				</div>
				<div class="clear"></div>
			Min. Hours Required:&nbsp; 
				<div class="inpAlign">
					{!! Form::text('min_hours', isset($mr->min_hours_req) ? $mr->min_hours_req : null,[ 'class' => 'f3']) !!}
				</div>
				<div class="clear"></div>
			<div class="adjustTxt">Room Description:&nbsp;</div>
			{!! Form::textarea('room_description', null,[ 'class' => 'f1_t']) !!}
			MR images:&nbsp;
				<div class="inpAlign">
				<!-- Select existing -->
					{!! Form::file('mr_photo', null,[ 'class' => 'gray_btn']) !!} 
					<!-- <a href="#" class="gray_btn">Select existing</a>
					<a href="#" class="gray_btn">Upload</a> -->
				</div>
				<div class="clear"></div>
			<div class="inpAlign">Image 1 - Image 2</div>
			<div class="clear"></div>
		</div> 
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
			<span class="left">AMENITIES AVAILABLE</span>
			</h3><br>
			Whiteboard:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('white_board', null, null,[ 'id' => '1']) !!}
					Rate: $
					{!! Form::text('white_board_rate', isset($mr_options->whiteboard_rate) ? $mr_options->whiteboard_rate : null,[ 'class' => 'f3']) !!} /per hour
				</div>
			<div class="clear"></div>
			TV/DVD Player:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('tv_dvd', null, null,[ 'id' => '2']) !!}
					Rate: $ 
					{!! Form::text('tv_dvd_rate', isset($mr_options->tvdvdplayer_rate) ? $mr_options->tvdvdplayer_rate : null,[ 'class' => 'f3']) !!} /per hour
				</div>
			<div class="clear"></div>
			Projector:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('projector', null, null,[ 'id' => '3']) !!}
					Rate: $ 
					{!! Form::text('projector_rate', isset($mr_options->projector_rate) ? $mr_options->projector_rate : null,[ 'class' => 'f3']) !!} /per hour
				</div>
			<div class="clear"></div>
			Video Conferencing:&nbsp;
				<div class="inpAlign">
					{!! Form::checkbox('video_conf', null, null,[ 'id' => '4', 'value' => 1]) !!}
					Rate: $ 
					{!! Form::text('video_conf_rate', isset($mr_options->videoconferencing_rate) ? $mr_options->videoconferencing_rate : null,[ 'class' => 'f3']) !!} /per hour
				</div>
			<div class="clear"></div>
			<div class="adjustTxt">Video Conferencing&nbsp; Equipment:&nbsp;</div>
			{!! Form::textarea('vc_equipment', null,[ 'class' => 'f1_t']) !!}<br>
			<div class="adjustTxt">Bridge Connection&nbsp; Available:&nbsp;</div>
			<div class="inpAlign">
				{!! Form::checkbox('bridge_connect', 'yes', null,[ 'id' => '5']) !!}
				Yes
			</div>
			<div class="clear"></div>
			Catering:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('catering', null, null,[ 'id' => '6']) !!}
					*Client to pay at center
				</div>
				<div class="clear"></div>
			<div class="adjustTxt">Credit Cards Accepted:&nbsp;</div>
			<div class="inpAlign">
				{!! Form::checkbox('cc_accepted', null, null,[ 'id' => '7']) !!}
				Yes
			</div>
			<div class="clear"></div>
		</div> 
		<div class="clear"></div>
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
				<span class="left">NETWORK / PHONE/ ADMIN INFORMATION</span>
			</h3><br>
			Network Connection:&nbsp;
				<div class="inpAlign">
					{!! Form::checkbox('n_connection', null, null,[ 'id' => '8']) !!}
					Rate: $ 
					{!! Form::text('n_connection_rate', isset($mr_options->network_rate) ? $mr_options->network_rate : null,[ 'class' => 'f3']) !!} /per hour</div>
			<div class="clear"></div>
			Wireless:&nbsp;
				<div class="inpAlign">
					{!! Form::checkbox('wireless', null, null,[ 'id' => '9']) !!}
					Rate: $ 
					{!! Form::text('vireless_rate', isset($mr_options->wireless_rate) ? $mr_options->wireless_rate : null,[ 'class' => 'f3']) !!} /per hour</div>
			<div class="clear"></div>
			Phone Access:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('phone_access', null, null,[ 'id' => '10']) !!}
					Rate: $ 
					{!! Form::text('phone_access_rate', isset($mr_options->phone_rate) ? $mr_options->phone_rate : null,[ 'class' => 'f3']) !!} /per hour</div>
			<div class="clear"></div>
			Admin Services:&nbsp;
			<div class="inpAlign">
				{!! Form::checkbox('admin_services', null, null,[ 'id' => '11']) !!}
				Rate: $ 
				{!! Form::text('admin_services_rate', isset($mr_options->admin_services_rate) ? $mr_options->admin_services_rate : null,[ 'class' => 'f3']) !!} /per hour</div>
			<div class="clear"></div>
		</div> 
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
				<span class="left">PARKING INFORMATION</span>
			</h3><br>
			Parking Available:&nbsp; 
				<div class="inpAlign">
					{!! Form::checkbox('parking', null, null,[ 'id' => '12']) !!}
					Rate: $ 
					{!! Form::text('parking_rate', isset($mr_options->parking_rate) ? $mr_options->parking_rate : null,[ 'class' => 'f3']) !!} /per hour</div>
			<div class="clear"></div>
			<div class="adjustTxt">Parking Description:&nbsp;</div>
			{!! Form::textarea('park_desc', isset($mr_options->parking_description) ? $mr_options->parking_description : null,[ 'class' => 'f1_t']) !!}<br>
		</div> 
		<div class="clear"></div>
		<div class="submit_w"><button type="submit" class="submit_btn">SUBMIT</button></div>
		<div class="txtLine">All rates set to empty will be displayed as "Included" to the customer.<br>
			<span class="mediumBold">Please enter a rate if you wish to charge for the service.</span>
		</div>
	{!! Form::close() !!}
@stop