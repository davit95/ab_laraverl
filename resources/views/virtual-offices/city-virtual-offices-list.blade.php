@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
	{!! Form::hidden('type', 'vo', ['id' => 'center_type']) !!}
	<div class="intWrap">
		<div class="searchInt">
			<form action="/search2.php" autocomplete="off" id="avoS" method="get">
				<input type="hidden" name="step" value="search">
			    <input type="text" class="SearchInputInt" id="suggest1" name="inputy" placeholder="Find Your Location Here" />
	            <select id="Services" name="avo1" class="avo1" >
	            	<option value="VO">Virtual Offices</option>
	                <option value="MR">Meeting Rooms</option>
	            </select>
	            <input type="hidden" name="source" value="bb">
			    <button type="submit" class="searchBtnInt" id="searchBtn" >
			    	<span class="mobileS">Search</span>
			    </button>
			</form>
		</div>
		<div class="breadcrumbs">			
			<a href="/">Home</a> /
			<a href="/virtual-offices">Virtual Offices</a> /
			<a href="{{ url('/virtual-offices/'.$city->country->slug) }}">{!! $city->country->name !!}</a> /
			@if(!is_null($city->us_state))
				<a href="{{ url('/virtual-offices/'.$city->usState->slug) }}"> {!! $city->us_state !!} /</a>
			@endif
			{!! $city->name !!}
		</div>
		<div class="resutsTop">
			<div class="ResutlsTitle">
				<h1>{{isset($location) ? $location->H1 : ''}}</h1>
				<p class="gray2">{{isset($location) ? $location->H2 : ''}}</p>
			</div>
			<div class="toggleMap">
        		<div class="toggleBtns">
            		<a href="#" class="toggleActive"><div class="listViewBtn">LIST VIEW</div></a>
            		<a href="#"><div class="mapViewBtn">MAP VIEW</div></a>
        		</div>
        	</div>
        </div>
        <div class="resutsWrap">
	        <div class="contactForm">
	            <div class="contactPhones">
		            <div class="centerForm">
		                NORTH AMERICA:    <span class="melon">+1 888.869.9494</span> <br/>
						INTERNATIONAL:    <span class="melon"> +1 949.777.6340</span>
		            </div><!--/centerForm-->
	            </div>
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
			{{-- <div class="resutsTop2a">
	    		<div class="ResutlsTitle">
	    			<h1>{!! $city->name !!} Virtual Office Solutions | Virtual Receptionists</h1>
	    			<p class="gray2">On-Demand Offices and Live Receptionists</p>
	    		</div>
	    	</div>--}}
	        <div class="clearLeft"></div>
	        @if (!$centers->isEmpty())	        
		        @foreach($centers as $center)
		       		@include('virtual-offices.parts.center-short-view')
		        @endforeach
		    @endif
		    <br>
	        @if (!$nearby_centers->isEmpty())
		        <div class="resutsTop2b">
	       			<div class="ResutlsTitle">
	       				<h1>Virtual Offices Near {{ $city->name }}</h1>
	       				<p class="gray2">On-Demand Offices and Live Receptionists</p>
	       			</div>
	       		</div>
		        @foreach($nearby_centers as $center)
		       		@include('virtual-offices.parts.center-short-view')
		        @endforeach
	        @endif
	        <div class='result-map-view' id='map-canvas'>Please wait. Loading maps...</div>
		</div>
		<div class="spotlight">
			<h3>Virtual Office Location Spotlight: <span class="orange">{{ $city->name }}</span></h3>
			<div class="spotlightsWrap">
				@if ($city->business_info != '' && $city->general_info != '')
					<div class="spotLeft">
						<h4>BUSINESS INFORMATION</h4>
						{!! $city->business_info !!}
	            	</div><!--/spotLeft-->
		           	<div class="spotRight">
	                	<h4>GENERAL LOCATION INFORMATION</h4>
	                	{!! $city->general_info !!}
	            	</div><!--/spotRight-->
	            @else
					<p style="margin:0;">Alliance Virtual Offices is a great way to find {{ $city->name }} virtual offices, {{ $city->name }} meeting rooms, virtual receptionists and other virtual office solutions.</p>
				@endif
        	</div><!--/spotlightsWrap-->
        </div>
    </div>
    @include('layout.parts.top-cities')
@stop

@section('scripts')

	<script type="text/javascript" src="/js/see-plans.js"></script>
	<script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="/js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js'></script>
	<script type="text/javascript">var all_addresses = '{!! $center_addresses_for_google_maps !!}'</script>
	<script type="text/javascript">var full_city = '{{ $google_maps_center_city }}'</script>
	<script type="text/javascript">var page_type = 'virtual-office';</script>
    <script type="text/javascript" src="/js/custom.js"></script>
	<script type="text/javascript">
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
		        } else {
		            $("#avoS").attr("action", "/mr-search.php");
		        }
		    });

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
        });
	</script>
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/magnific-popup.css"/>
	<link rel="stylesheet" type="text/css" href="/css/map.popup.css"/>
@stop
