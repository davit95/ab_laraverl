<div class="h2wrapp">
	<div class="h2Icon view"></div>
	<div class="h2txt"><h2>CENTERS</h2></div>
</div>
@foreach( $owner->centers as $center )
	
	<div class="small_w_box">
		<div class="swb_wrapp">
			<h3 class="mediumBold center">{{ $center->name }}</h3>
			<span class="medium">{{ $center->building_name }}</span><br>
			{{ $center->address1 }}<br>
			{{ $center->address2 }}<br>			
			<a href="#view-mr" class="gLink lightbox">Meeting Rooms: {{ $center->meeting_rooms->count() }}</a><br>
			<a href="#view-staff" class="gLink">Staff Members: 1</a>
		</div> 
		<div class="sBox_btns">
			<div class="edit_cBtn bordR">
				<a href="#" class="gLink">
					<div class="sBox_icons edit_green"></div>
					Center
				</a>
			</div>
			<div class="add_MrBtn bordR">
				<a href="{{ url('centers/add-meeting-room') }}" class="gLink">
					<div class="sBox_icons add_green"></div>
					MR
				</a>
			</div>
			<div class="add_StaffBtn">
				<a href="#add-staff" class="gLink lightbox">
					<div class="sBox_icons add_green"></div>
					Staff
				</a>
			</div>
		</div> 
	</div>	
@endforeach