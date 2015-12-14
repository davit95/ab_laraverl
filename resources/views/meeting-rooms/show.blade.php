@extends('layout.layout')

@section('content')
	<div class="intWrap">
		<div class="breadcrumbs dtails">
			<a href="/">Home</a> /
			<a href="/virtual-offices">Virtual Offices</a> /
			<a href="{!! URL::action('MeetingRoomsController@getCountryMeetingRooms', ['country_slug' => $center->city->country->slug])!!}">{!! $center->city->country->name!!}</a> /
			@if($center->city->us_state_id)
				<a href="{!! URL::action('MeetingRoomsController@getCountryMeetingRooms', ['country_slug' => $center->city->usState->slug])!!}">{!! $center->city->us_state !!}</a> /
			@endif
			<a href="{!! URL::action('MeetingRoomsController@getCityMeetingRooms', ['country_code' => $center->city->country->code, 'city_slug' => $center->city->slug])!!}"> {!! $center->city->name!!}</a> /
			@if($center->building_name)
				{!! $center->buidling_name!!}
			@else
				Meeting Room in {!! $center->city->name !!}
			@endif
		</div>
		<div class="resutsTop">
			<div class="ResutlsTitle">
				@if($center->meeting_room_seo)
					<h1>{!! $center->meeting_room_seo->h1 !!}</h1>
					<p class="gray2">{!! $center->meeting_room_seo->h2 !!}</p>
				@else
					<h1>{!! preg_replace('/^[^a-zA-Z]*/', '', $center->address1) !!} Meeting Room / {!! $center->city->name !!}, {!! $center->city->us_state_id ? $center->city->us_state_code : $center->city->country->code !!}</h1>
					<p class="gray2">Live Answering & Advanced Telephony</p>
				@endif
			</div>
			<div style="clear:both"></div>
			<div class="detailsTopWrap">
				<div class="detailTopLeft">
					<div class="dimg">
						<div class="img-wrapper2">
							@if(is_null($photo = $center->mr_photos()->first()))
								<img src="/mr-photos/no_pic.gif">
							@else
								<img src="/mr-photos/all/{!! $photo->path !!}" alt="{!! $photo->alt !!}">
							@endif
						</div>
					</div>
					<div class="dcInfo">
						@if($center->meeting_room_seo)
							<h2 class="gray1 cf2 bold">{!! $center->meeting_room_seo->h3 !!}</h2>
							<h3 class="gray3">{!! $center->meeting_room_seo->subhead !!}</h3>
						@endif
						<p class="gray2">
							<span class="bold">{!! $center->buiding_name? $center->buiding_name : $center->city->name . ' Office Space'!!}</span>
							<br>
							{!! $center->address1 !!}
							<br>
							{!! $center->address2 !!} {!! $center->city->anme !!}, {!! $center->city->us_state_id ? $center->city->us_state_code : $center->city->country->code !!}  {!! $center->postal_code !!}
						</p>
					</div>
				</div>
				<div class="detailTopRight">
					<div class="dmap">
						<div id="map_canvas" style="width:100%; height:100%"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="detailsTopWrap3">
				<div class="mTopLeft2">
					<p class="mediumBold">
						<span class="blue">CONFIGURE YOUR MEETING ROOM OPTIONS</span>
					</p>
				</div>
				<div class="mformright2">
					<p class=" mediumBold">
						<span class="gray2">FOR MORE INFORMATION PLEASE CONTACT US:</span>
					</p>
				</div>
			</div>
			<div class="detailsTopWrap2 changeMtop">
				<div class="dformright2 radiusTop">
					<div class="contactPhones2">
						<div class="centerForm">
							NORTH AMERICA:    +1 888.869.9494<br>
	    					INTERNATIONAL:     +1 949.777.6340
						</div>
					</div>
					<div class="cForm2">
						<div class="centerForm2">
							<h3>INQUIRE ABOUT <span class="bold">MEETING ROOMS</span></h3>
							@if(session('success'))
								<div class="alert-success-custom">
									{{ session('success') }}
								</div>
							@endif
							{!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
								<div>
									{!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
									{!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required']) !!}
									@if($errors->has('name'))
										<small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('email','Email', [ 'class' => $errors->has('email')?'label label-error':"label" ]) !!}
									{!! Form::email('email', null,[ 'class' => $errors->has('email')?'input-error':'' , 'required']) !!}
									@if($errors->has('email'))
										<small class="text-error-custom">{{ $errors->get('email')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('company','Company', [ "class" => $errors->has('company')?'label label-error':"label" ]) !!}
									{!! Form::text('company', null,[ 'class' => $errors->has('company')?'input-error':'' , 'required']) !!}
									@if($errors->has('company'))
										<small class="text-error-custom">{{ $errors->get('company')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('phone','Phone', [ "class" => $errors->has('phone')?'label label-error':"label" ]) !!}
					  				{!! Form::text('phone', null,[ 'class' => $errors->has('phone')?'input-error':'' , 'required']) !!}
									@if($errors->has('phone'))
										<small class="text-error-custom">{{ $errors->get('phone')[0] }}</small>
									@endif
								</div>

								<label for="label"><div class="label"><a href="{{ url('privacy-policy') }}" target="_blank" class="privateP">Privacy Policy</a></div></label>
								<label for="submit"></label>
								<button type="submit" id="submit2">SEND</button>
                			{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="wrapMRdetails">
					{!! Form::open(['action' => 'MeetingRoomsController@bookMeetingRoom', 'method' => 'POST']) !!}
						<div class="descTopLeft2">
							<div class="wrapDescrip">
								<div class="number nOne"></div>
								<h3 class="gray2">SET YOUR DATE AND TIME</h3>
								<div id="root-picker-outlet" style="margin-left:45px;"></div>
								<div id="root-picker-outlet2" style="margin-left:45px;"></div>

									{{-- <input type="hidden" name="cid" value="$_REQUEST[cid]" /> --}}
									{{-- <input type="hidden" name="step" value="set_date_time" /> --}}
									{!! Form::hidden('center_id', $center->id) !!}
									@if($errors->has('date'))
										<div style="color: red; padding: 5px; float: left; text-align: left; width: 400px;">
											{!! $errors->get('date')[0]!!}
										</div>
									@endif
									@if($errors->has('from_time'))
										<div style="color: red; padding: 5px; float: left; text-align: left; width: 400px;">
											{!! $errors->get('from_time')[0]!!}
										</div>
									@endif
									@if($errors->has('to_time'))
										<div style="color: red; padding: 5px; float: left; text-align: left; width: 400px;">
											{!! $errors->get('to_time')[0]!!}
										</div>
									@endif

			            			<fieldset class="dateAndTime">
			            				@if(session('mr_request'))
				            				<div class="yourDateT">
				                    			Your meeting room date is: <span class="mediumBold">{{ session('mr_request.mr_date') }}</span><br>
				                    			From: <span class="mediumBold">{{ session('mr_request.mr_start_time') }}</span> to: <span class="mediumBold">{{ session('mr_request.mr_end_time') }}</span><br>
				                    			<a href="{{ url('reset-date') }}" style="text-decoration:none;"><div class="otherTime lightBtn">CHANGE DATE</div></a>
				                			</div><!--/showHide-->
				                		@else
				            				<div>
				                    			<label for="date">
													<div class="label @if($errors->has('mr_date')) label-error @endif">Set Date:</div>
												</label>
												{!! Form::text('mr_date', null, ['id' => 'input_01', 'placeholder' => 'Please select a date', 'class' =>  'datepicker', 'required']) !!}
												@if($errors->has('mr_date'))
													<small class="text-error-custom" style="margin-left:145px;">{{ $errors->get('mr_date')[0] }}</small>
												@endif
												<br>
				                    			<label for="fromTime">
													<div class="label @if($errors->has('mr_start_time')) label-error @endif">Set Your Start Time:</div>
												</label>
												{!! Form::text('mr_start_time', null, ['id' => 'input_from', 'placeholder' => 'Please select a start time', 'class' =>  'timepicker ', 'required']) !!}
												@if($errors->has('mr_start_time'))
													<small class="text-error-custom" style="margin-left:145px;">{{ $errors->get('mr_start_time')[0] }}</small>
												@endif
												<br>
				                    			<label for="toTime">
													<div class="label @if($errors->has('mr_end_time')) label-error @endif">Set End Start Time:</div>
												</label>
												{!! Form::text('mr_end_time', null, ['id' => 'input_to', 'placeholder' => 'Please select an end time', 'class' => 'timepicker', 'required']) !!}
												@if($errors->has('mr_end_time'))
													<small class="text-error-custom" style="margin-left:145px;">{{ $errors->get('mr_end_time')[0] }}</small>
												@endif
												<br>
				                    			<div class="label"></div>
												{!! Form::submit('SET DATE AND TIME', ['class' => 'aquaBtn sbmitDate', 'width' => '170']) !!}
				            				</div>
			                			@endif
			            			</fieldset>
			        			{{-- {!! Form::close() !!} --}}
							</div>
						</div>
						<div class="descTopLeft2">
							<div class="wrapDescrip">
									<div class="number nTwo"></div>
									<h3 class="gray2">PLEASE SELECT A MEETING ROOM AND OPTIONS</h3>
									{{-- <form action="" id="mrForm" name="mr-main-form" method="post"> --}}
									<div id="mrForm">
										{{-- $form_extras --}}
										@if($errors->has('mr_id'))
											<div style="color: red; font-size:16px;, padding: 5px; float: left; text-align: left; width: 400px;">
												{!! $errors->get('mr_id')[0]!!}
											</div>
										@endif
										<table id="hor-minimalist-b" summary="Meeting Room Summary" class="MRoptionT gray2">
											<tr>
												<th scope="col" style="">&nbsp;</th>
												<th scope="col" style=" text-align: left;">MEETING ROOM</th>
												<th scope="col" style="text-align: center;">CAPACITY</th>
												<th scope="col" style=" text-align: center;">RATE</th>
												<th scope="col" style="text-align: center;">TOTAL</th>
											</tr>
											{{-- dd($center->meeting_rooms) --}}
											@foreach($center->meeting_rooms as $mr)
												@if($mr->name != '')
													{!! Form::hidden("price[".$mr->id."]", $mr->hourly_rate*session('hours')) !!}
													<tr class="MRline totalCost Mroom" Mroom="{!! $mr->id !!}" cost="$first_amount" bgcolor="#F3F4F4" >
														<td style="text-align: center; min-width:30px;">
														<input name="mr_id" type="radio" value="{!! $mr->id !!}" class="Mroom SelectMR" $js_alert />
														</td>
														<td class="theMR">{!! $mr->name !!}</td>
														<td style="text-align: center;">up to {!! $mr->capacity !!}</td>
														<td class="thePrice" style="text-align: center;"><span class="convert">{!! session('currency.symbol') !!}{!! round($mr->hourly_rate*session('rate'),2) !!}</span>/hr</td>
														<td class="total bold" style="text-align: center;">{!! session('currency.symbol') !!}{!! round(ceil($mr->hourly_rate*session('hours'))*session('rate'),2) !!}</td>
													</tr>
													<tr class="service" Mroom="{!! $mr->id !!}" style="" cost="0">
														<td colspan="5" class="no-border">
															@if($mr->options && $mr->options->room_description != '')
															<h3>Room Description</h3>
															<div class="mr-description">{!! $mr->room_description !!}</div>
															@endif
															<br><h2>INCLUDED AMENITIES</h2>
															<div class="mr-incl-amenities-box">
																<ul>
																	@foreach($mr->included as $amenity)
																		<li>{!! $amenity !!}</li>
																	@endforeach
																</ul>
															</div>
															<div class="clear"></div>
														</td>
													</tr>
													@if(count($mr->paid) > 0)
														<tr class="service" Mroom="{!! $mr->id !!}" style="" cost="0">
															<td colspan="5" class="no-border">
																<h2>ADDITIONAL AMENITIES AVAILABLE</h2>
															</td>
														</tr>
													@endif
												@endif
											@endforeach
										</table>
									</div>
							</div>
						</div>
						@if(session('mr_request'))
							<div class="descTopLeft2 noMbottom" $hideShow>
								<div class="wrapDescrip">
									<div class="number nThree"></div>
									<h3 class="gray2">SUBMIT</h3>
									<div class="wrapSN3">
										<input type="submit" class="submitBook aquaBtn" value="SUBMIT BOOKING">
										<div class="bookOwrap">
											<div class="OtherRadios gray3"></div>
										</div>
									</div>

								</div>
							</div>
						@endif
					{!! Form::close()!!}
				</div>
			</div>
		</div>
		<div class="nearWrap">
			<h3 class="gray2">NEARBY CENTERS</h3>
			@foreach($nearby_centers as $_center)
				@if($_center->id != $center->id)
					<a href="{!! URL::action('MeetingRoomsController@getMeetingRoomShowPage', ['country_code' => $center->country, 'city_slug' => $_center->city? $_center->city->slug : '', 'center_slug' => $_center->slug, 'center_id' => $_center->id])!!}">
						<div class="cNear">
							<div class="nearImg">
								<div class="img-wrapper4">
									@if(is_null($photo = $_center->mr_photos()->first()))
										<img src="/mr-photos/no_pic.gif">
									@else
										<img src="/mr-photos/all/{!! $photo->path !!}" alt="$photo->alt">
									@endif
								</div>
							</div>
							<div class="nearInfo gray2 medium">{!! $_center->building_name? $_center->building_name : $_center->city->name." Virtual Office"!!}
								<span class="gray3 light"> <br />({!! $_center->distance !!} miles away)</span>
							</div>
						</div>
					</a>
				@endif
			@endforeach
		</div>
	</div>
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/themes/classic.css">
	<link rel="stylesheet" type="text/css" href="/css/themes/classic.date.css">
	<link rel="stylesheet" type="text/css" href="/css/themes/classic.time.css">
    <link rel="stylesheet" type="text/css" href="/css/flat/grey.css">
	<link rel="stylesheet" type="text/css" href="/css/flat/grey.css">
@stop

@section('scripts')
	<script type="text/javascript" src="/js/icheck.js"></script>
	<script type="text/javascript" src="/js/picker.js"></script>
	<script type="text/javascript" src="/js/picker.date.js"></script>
	<script type="text/javascript" src="/js/picker.time.js"></script>
	<script type="text/javascript" src="/js/legacy.js"></script>
    <script type="text/javascript">
	    jQuery(document).ready(function(){


	        $('input').iCheck({
	            checkboxClass: 'icheckbox_flat-grey',
	            radioClass: 'iradio_flat-grey'
	        });

	        $('.iCheck-helper').on('click', function() {
	            $(this).siblings('input').click();
	        });
	        $( '.datepicker' ).pickadate({
		    	format: 'mm/dd/yyyy',
	            formatSubmit: 'mm/dd/yyyy',
	            min: true,
	            container: '#root-picker-outlet',
	            //editable: true,
	            closeOnSelect: true,
	            closeOnClear: false,
				disable: [
					1, 7
				],
				// Work-around for some mobile browsers clipping off the picker.
	    	    onOpen: function() { $('pre').css('overflow', 'hidden') },
	    	    onClose: function() { $('pre').css('overflow', '') }
	        });

			$('.timepicker').pickatime({
			    min: [8,0],
			    max: [17,0],
			    container: '#root-picker-outlet2',
			    formatSubmit: 'HH:i',
			    onClose: function() {
		    	        $('.timepicker').blur();
			    }
			});

	       var from_ = $('#input_from').pickatime(),
	       from_picker = from_.pickatime('picker')

	       var to_ = $('#input_to').pickatime({
	           formatLabel: function( timeObject ) {
	               var minObject = this.get( 'min' ),
	               hours = timeObject.hour - minObject.hour,
	               mins = ( timeObject.mins - minObject.mins ) / 60,
	               pluralize = function( number, word ) {
	                   return number + ' ' + ( number === 1 ? word : word + 's' )
	               }
	               return '<b>H</b>:i <!i>a</!i> <sm!all>(' + pluralize( hours + mins, '!hour' ) + ')</sm!all>'
	           }
	       }),

	       to_picker = to_.pickatime('picker')

	       if(to_picker && from_picker){
				// Check if there's a "from" or "to" time to start with.
				if ( from_picker.get('value') ) {
				  to_picker.set('min', from_picker.get('select'))
				}
				if ( to_picker.get('value') ) {
				  from_picker.set('max', to_picker.get('select') )
				}

				// When something is selected, update the "from" and "to" limits.
				from_picker.on('set', function(event) {
				  if ( event.select ) {
				    to_picker.set('min', from_picker.get('select'))
				  }
				})
				to_picker.on('set', function(event) {
				  if ( event.select ) {
				    from_picker.set('max', to_picker.get('select'))
				  }
				})
	       }

			function getUrlParameter(sParam)
			{
			    var sPageURL = window.location.search.substring(1);
			    var sURLVariables = sPageURL.split('&');
			    for (var i = 0; i < sURLVariables.length; i++)
			    {
			        var sParameterName = sURLVariables[i].split('=');
			        if (sParameterName[0] == sParam)
			        {
			            return sParameterName[1];
			        }
			    }
			}

			var date = getUrlParameter('date');
			var firstTime = getUrlParameter('_submit');
			var secondTime = getUrlParameter('_submit');

			if(date && date.length == 0){
		    } else {
				$('.showHide').show();
				$('.hideShow').hide();
			}

			$( ".otherTime" ).click(function() {
				$('.showHide').hide();
				$('.hideShow').show();
			});
	    });
    </script>
 	<script type="text/javascript">
        jQuery(document).ready(function($) {

			$( ".menuBtnLink" ).click(function() {
			  	$( ".menu" ).slideToggle( "slow", function() {
					// Animation complete.
			  	});
			});

			if ($(window).width() > 850) {
			   	$(".dformright2").stick_in_parent()
			}
			else {

			};

			$( window ).resize(function() {
			  	if ($(window).width() < 850) {
			   		$(".dformright2").trigger("sticky_kit:detach");
				} else {
				   	$(".dformright2").stick_in_parent()
				};
			});

			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-grey',
				radioClass: 'iradio_flat-grey'
			});
        });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript">
	  	function initialize() {
	    	var myLatlng = new google.maps.LatLng({!! $center->coordinate->lat !!}, {!! $center->coordinate->lng !!});
	    	var myOptions = {
	      		zoom: 15,
	      		center: myLatlng,
	      		mapTypeId: google.maps.MapTypeId.ROADMAP
	   		}
	    	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    	var iconBase = '/images/';
		    var marker = new google.maps.Marker({
		        position: myLatlng,
		        map: map,
				icon: iconBase + 'marker.png',
		        title: "{!! $center->address1 !!}"
		    });
	  	}
	  	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<script type="text/javascript">
        jQuery(document).ready(function($) {

			$( ".menuBtnLink" ).click(function() {
			  	$( ".menu" ).slideToggle( "slow", function() {
					// Animation complete.
			  	});
			});

			if ($(window).width() > 850) {
			   $(".dformright2").stick_in_parent()
			}
			else {

			};

			$( window ).resize(function() {
			  	if ($(window).width() < 850) {
				   $(".dformright2").trigger("sticky_kit:detach");
				} else {
				   $(".dformright2").stick_in_parent()
				};
			});

			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-grey',
				radioClass: 'iradio_flat-grey'
			});
        });
    </script>
@stop
