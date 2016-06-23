<div class="h2wrapp mtop1">
	<div class="h2Icon edit"></div>
	<div class="h2txt">
		<h2>Unassigned Staff Members</h2>
	</div>
	<div class="fleft"> &nbsp; &nbsp; 
		<a href="{{ url('owners/'.$owner->id.'/add-staff') }}" class="gLink">
			<div class="txtLink">Staff</div>
			<div class="gIcon gAdd"></div>
		</a>
	</div> 
</div>
@foreach($owner->staffs as $staff)
	<div class="s_w_box">
		<div class="removeXbtn">
			<a class="#" href="#">
				<img src="/admin_assets/admin/images/remove2.png" width="25" height="25" border="0">
			</a>
		</div>
		<div class="swb_wrapp">
			<h3 class="mediumBold">Staff Member:</h3>
			{{$staff->name}}<br>
			{{$staff->title}}<br>
			{{$staff->phone_1}}<br>
			{{$staff->email}}
		</div> 
		<!-- <div class="sBox_btns">
			<div class="s_select">
				<select class="f2_s">
					<option value="">Select</option>
					<option value="center1">Center 1</option>
					<option value="center2">Center 2</option>
					<option value="center3">Center 3</option>
				</select>
			</div> 
		</div> -->
	</div>
@endforeach