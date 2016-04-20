@extends('admin.layouts.layout')

@section('content_top')
<!-- <div class="ct_icon_vod"></div> 
<div class="ct_wrapp">
    <div class="ct_title"><h1>STAFF MEMBERS</h1></div> 
        <div class="ct_tools">
            <p class="h1Desc">Bala Plaza Business Center, 101 Lindenwood Drive, Suite 225, Malvern, PA</p>
        </div> 
    </div> 
    <div class="clear"></div>
</div> 
<div class="content_wrapp2">
    <div class="s_w_box">
        <div class="removeXbtn">
            <a class="#" href="#"><img src="images/remove2.png" width="25" height="25" border="0"></a>
        </div>
        <div class="swb_wrapp min_h light">
            <h3 class="mediumBold">Staff Member:</h3>
            Mike Howard<br>
            Regional Ops. Mgr.<br>
            856-988-5500<br>
            mike@aecphilly.com
        </div> 
        <div class="sBox_btns">
            <div class="add_CBtn"><a href="#" class="gLink">
                <div class="sBox_icons edit_green"></div>Edit</a>
            </div>
        </div> 
    </div>
</div> -->

<div class="ct_icon_vod"></div>

<div class="ct_wrapp">
	<div class="ct_title"><h1>MEETING ROOMS</h1></div> 
		<div class="ct_tools">
			<p class="h1Desc">Bala Plaza Business Center, 101 Lindenwood Drive, Suite 225, Malvern, PA</p>
		</div> 
	</div>
	<div class="clear"></div>
</div>
<div class="content_wrapp2">
	@foreach($meetingRooms as $mt)
		<div class="s_w_box">
			<div class="swb_wrapp min_h light">
				<h3 class="mediumBold">{{$mt->name}}</h3>
				Hourly Rate: ${{$mt->hourly_rate}}<br>
				Half Day Rate: ${{$mt->half_day_rate}}<br>
				Full Day Rate: ${{$mt->full_day_rate}}
			</div> 
			<div class="sBox_btns">
				<div class="add_CBtn">
					<a href="meeting-rooms/{{$mt->id}}/edit" class="gLink">
						
						Edit
					</a>
				</div>
			</div>
		</div> 
	@endforeach
</div>
@stop