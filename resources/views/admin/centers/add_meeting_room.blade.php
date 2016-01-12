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
	<form class="ownersForm">
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
				<span class="left">MEETING ROOM'S BASIC INFORMATION</span>
			</h3><br>
			MR Name:&nbsp; 
				<input type="text" class="f1" name="staffFirstname"><br>
			Capacity:&nbsp; 
				<div class="inpAlign">
					<input type="text" class="f3" name="capacity">
				</div>
				<div class="clear"></div>
			Rate:&nbsp; 
				<div class="inpAlign">
					<input type="text" class="f3" name="rate"> /per hour
				</div>
				<div class="clear"></div>
			<div class="inpAlign">
				<input type="text" class="f3" name="halfDay"> / half day
			</div>
			<div class="clear"></div>
			<div class="inpAlign">
				<input type="text" class="f3" name="fullDay"> / full day
			</div>
			<div class="clear"></div>
			Min. Hours Required:&nbsp; 
				<div class="inpAlign">
					<input type="text" class="f3" name="minHours">
				</div>
				<div class="clear"></div>
			<div class="adjustTxt">Room Description:&nbsp;</div>
			<textarea class="f1_t" name="roomDescription"></textarea>
			MR images:&nbsp;
				<div class="inpAlign">
					<a href="#" class="gray_btn">Select existing</a>
					<a href="#" class="gray_btn">Upload</a>
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
					<input type="checkbox" name="whiteboard" value="VO" id="1">
					Rate: $ 
					<input type="text" class="f3" name="whiteboardRate"> /per hour
				</div>
			<div class="clear"></div>
			TV/DVD Player:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="tvDvd" value="VO" id="2">
					Rate: $ 
					<input type="text" class="f3" name="tvDvdRate"> /per hour
				</div>
			<div class="clear"></div>
			Projector:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="projector" value="VO" id="3">
					Rate: $ 
					<input type="text" class="f3" name="projectorRate"> /per hour
				</div>
			<div class="clear"></div>
			Video Conferencing:&nbsp;
				<div class="inpAlign">
					<input type="checkbox" name="videoConf" value="VO" id="4">
					Rate: $ 
					<input type="text" class="f3" name="videoConfRate"> /per hour
				</div>
			<div class="clear"></div>
			<div class="adjustTxt">Video Conferencing&nbsp; Equipment:&nbsp;</div>
			<textarea class="f1_t" name="vcEquipment"></textarea><br>
			<div class="adjustTxt">Bridge Connection&nbsp; Available:&nbsp;</div>
			<div class="inpAlign">
				<input type="checkbox" name="bridgeConnect" value="VO" id="5">
				Yes
			</div>
			<div class="clear"></div>
			Catering:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="catering" value="VO" id="6">
					*Client to pay at center
				</div>
				<div class="clear"></div>
			<div class="adjustTxt">Credit Cards Accepted:&nbsp;</div>
			<div class="inpAlign">
				<input type="checkbox" name="ccAccepted" value="VO" id="7">
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
					<input type="checkbox" name="Nconnection" value="VO" id="8">
					Rate: $ 
					<input type="text" class="f3" name="NconnectionRate"> /per hour</div>
			<div class="clear"></div>
			Wireless:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="wireless" value="VO" id="9">
					Rate: $ 
					<input type="text" class="f3" name="wirelessRate"> /per hour</div>
			<div class="clear"></div>
			Phone Access:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="PhoneAccess" value="VO" id="10">
					Rate: $ 
					<input type="text" class="f3" name="PhoneAccessRate"> /per hour</div>
			<div class="clear"></div>
			Admin Services:&nbsp;
			<div class="inpAlign">
				<input type="checkbox" name="adminServices" value="VO" id="11">
				Rate: $ 
				<input type="text" class="f3" name="adminServicesRate"> /per hour</div>
			<div class="clear"></div>
		</div> 
		<div class="w_box2 lh_f">
			<h3 class="left mediumBold">
				<span class="left">PARKING INFORMATION</span>
			</h3><br>
			Parking Available:&nbsp; 
				<div class="inpAlign">
					<input type="checkbox" name="parking" value="VO" id="12">
					Rate: $ 
					<input type="text" class="f3" name="pRate"> /per hour</div>
			<div class="clear"></div>
			<div class="adjustTxt">Parking Description:&nbsp;</div>
			<textarea class="f1_t" name="parkDesc"></textarea><br>
		</div> 
		<div class="clear"></div>
		<div class="submit_w"><a href="#" class="submit_btn">SUBMIT</a></div>
		<div class="txtLine">All rates set to empty will be displayed as "Included" to the customer.<br>
			<span class="mediumBold">Please enter a rate if you wish to charge for the service.</span>
		</div>
	</form>	
@stop