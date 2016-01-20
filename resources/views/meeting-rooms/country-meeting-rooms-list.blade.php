	@extends('layout.layout')
@section('title') Virtual Office, Virtual Office Solutions from Alliance Virtual Offices @stop
@section('content')
	<div class="intWrap">
		<div class="searchInt">
			<form action="/search2.php" autocomplete="off" id="avoS" method="get">
				<input type="hidden" name="step" value="search">
			    <input type="text" class="SearchInputInt" id="suggest1" name="inputy" placeholder="Find Your Location Here" />
	            <select id="Services" name="avo1" class="avo1" >
	                <option value="MR">Meeting Rooms</option>
	            	<option value="VO">Virtual Offices</option>
	            </select>
	            <input type="hidden" name="source" value="bb">
			    <button type="submit" class="searchBtnInt" id="searchBtn" >
			    	<span class="mobileS">Search</span>
			    </button>
			</form>
		</div>
		<div class="breadcrumbs">
			<a href="/">Home</a> / <a href="/meeting-rooms">Meeting Rooms</a> / {!! $country->name!!}
		</div>
		<div class="resutsTop">
			<div class="ResutlsTitle">
				<h1>{!! $country->name !!} Meeting Rooms | Conference Rooms</h1>
				<p class="gray2">On-demand Meeting Rooms and Conference Rooms</p>
			</div>
        </div>
        <div class="resutsWrap">
        <div class="contactForm">
            <div class="contactPhones">
	            <div class="centerForm">
	                NORTH AMERICA:    <span class="melon">+1 888.869.9494</span> <br/>
					INTERNATIONAL:    <span class="melon"> +1 949.777.6340</span>
	            </div><!--/centerForm-->
            </div><!--/contactPhones-->
            <style type="text/css">.cForm {padding-bottom: 20px;height: auto;}</style>
            <div class="cForm">
	            <div class="centerForm">
		            <h3>INQUIRE ABOUT<br/>
		            <span class="bold">VIRTUAL OFFICES</span></h3>
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
						<button type="submit" id="submit2">FIND OUT MORE</button>

        			{!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="clearLeft"></div>
		<ul class='ResultsListMR'>
        	@foreach($country->active_cities as $city)
        		<a href="{!!URL::action('MeetingRoomsController@getCityMeetingRooms', ['country_code' => $country->code, 'city_slug' => $city->slug, 'city_id' => $city->id])!!}">
        			<li>{!! $city->name !!}</li>
        		</a>
        	@endforeach
        </ul>
        <div class="clearLeft"></div>

        	@foreach($active_cities as $key => $city)
		    	<div class="@if($key == 0) resutsTop2a @else resutsTop @endif">
        			<div class="ResutlsTitle">
	        			<h1>{!! $city->name !!} Virtual Office Solutions | Virtual Receptionists</h1>
	        			<p class="gray2">On-Demand Offices and Live Receptionists</p>
        			</div>
        		</div>
        		<div class="clearLeft"></div>
        		
        		@foreach($city->active_meeting_rooms as $center)
        			@include('meeting-rooms.parts.center-short-view')
        		@endforeach
        	@endforeach
        	{!! $active_cities->render() !!}
	</div>
@stop

@section('scripts')
	<script src="/js/jquery.bxslider.min.js"></script>
	<script>
	        jQuery(document).ready(function($) {

				$( ".menuBtnLink" ).click(function() {
				  $( ".menu" ).slideToggle( "slow", function() {
					// Animation complete.
				  });
				});

				$('.bxslider').bxSlider();

				$(".moreInfoBtn").hover(function() {
					$( this).next('.ImageInfo2').fadeToggle( "fast", function() {
					// Animation complete.
				  });

				});

				//LightBox
				$('.popup-with-form').magnificPopup({
					type: 'inline',
					preloader: false,
					focus: '#name',

					// When elemened is focused, some mobile browsers in some cases zoom in
					// It looks not nice, so we disable it:
					callbacks: {
						beforeOpen: function() {
							if($(window).width() < 1100) {
								this.st.focus = false;
							} else {
								this.st.focus = '#name';
							}
						}
					}
				});

				$('.popup-with-form').magnificPopup({
					type: 'iframe',
					// When elemened is focused, some mobile browsers in some cases zoom in
					// It looks not nice, so we disable it:
					callbacks: {
						beforeOpen: function() {
							if($(window).width() < 1100) {
								this.st.focus = false;
							} else {
								this.st.focus = '#name';
							}
						}
					}
				});

				//end LightBox

	    $("#suggest1").autocomplete('/js/lookup.php', {
	        minChars: 1,
		delay: 40,
		maxItemsToShow: 30,
	    });

	    $("input#suggest1").keyup(function(e){

	        var code = e.which;
	        if(code==13)e.preventDefault();
	        if(code==13||code==186){
		   $("#searchBtn").click();
	        }

	    });

	    $( ".avo1" ).change(function() {

	        var e = document.getElementById("Services");
	        var strType = e.options[e.selectedIndex].value;

	        if(strType=='VO') {
	             $("#avoS").attr("action", "/search2.php");
	        }
	        else{
	            $("#avoS").attr("action", "/mr-search.php");
	        }

	    });
	        });

	</script>
@stop
