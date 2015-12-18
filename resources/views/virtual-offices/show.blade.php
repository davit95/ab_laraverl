@extends('layout.layout')

@section('title')
	{!! $center->city->name !!} Virtual Offices and Conference Rooms on {!! preg_replace('/^[^a-zA-Z]*/', '', $center->address1) !!}
@stop

@section('content')
	<div class='intWrap'>
		<div class="breadcrumbs dtails">
			<a href="/">Home</a> /
			<a href="/virtual-offices">Virtual Offices</a> /
			<a href="{!! URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $center->city->country->slug])!!}">{!! $center->city->country->name!!}</a> /
			@if($center->city->us_state_id)
				<a href="{!! URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $center->city->usState->slug])!!}">{!! $center->city->us_state !!}</a> /
			@endif
			<a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => $center->city->country->code, 'city_slug' => $center->city->slug])!!}"> {!! $center->city->name!!}</a> /
			@if($center->building_name)
				{!! $center->buidling_name!!}
			@else
				Virtual Office in {!! $center->city->name !!}
			@endif
		</div>
		<div class="resutsTop">
			<div class="ResutlsTitle">
				@if($center->virtual_office_seo)
					<h1>{!! $center->virtual_office_seo->h1!!}</h1>
					<p class="gray2">{!! $center->virtual_office_seo->h2 !!}</p>
				@else
					<h1>Virtual Offices in {!! $center->city->name !!} <span class="blue">/</span> <span class="medium">{!! preg_replace('/^[^a-zA-Z]*/', '', $center->address1) !!}</span></h1>
					<p class="gray2">Live Answering & Advanced Telephony</p>
				@endif

			</div>
			<div style="clear:both"></div>
			<div class="detailsTopWrap">
				<div class="detailTopLeft">
					<div class="dimg">
						<div class="img-wrapper2">
							@if(count($center->vo_photos))
								<img src="http://www.abcn.com/images/photos/{!! $center->vo_photos[0]->path !!}" alt="{!! $center->vo_photos[0]->alt !!}">
							@else
								<img src="http://www.abcn.com/images/photos/no_pic.gif">
							@endif
						</div>
					</div>
					<div class="dcInfo">
						<h2 class="gray1 cf2 bold">{!! $center->virtual_office_seo? $center->virtual_office_seo->h3 : ''!!}</h2>
						<h3 class="gray3">{!! $center->virtual_office_seo? $center->virtual_office_seo->subhead : ''!!}</h3>
						<p class="gray2">
							<span class="bold">{!! $center->bulding_name? $center->building_name : $center->city->name!!}  Office Space</span>
							<br>
							{!! $center->address1 !!}
							<br>
							{!! $center->address2 !!}
							<span class="city" itemprop="addressRegion">{!! $center->city->name !!}</span>
							@if($center->city->us_state_id)
								{!! $center->city->usState->code !!}
							@else
								{!! $center->city->country->name !!}
							@endif
							<span class="city" itemprop="postalCode">{!! $center->postal_code !!}</span>
							<br>							
							<b>{!! $center->local_number->local_number !!}</b>	
						</p>
					</div>
				</div>
				<div class="detailTopRightA">
					<div class="cForm2a">
						<div class="centerForm2">
							<h3>
								INQUIRE ABOUT
								<span class="bold">VIRTUAL OFFICES</span>
							</h3>
							@if(session('success'))
								<div class="alert-success-custom">
									{{ session('success') }}
								</div>
							@endif
							{!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
								<div>
									{!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
									{!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required' ]) !!}
									@if($errors->has('name'))
										<small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('email','Email', [ 'class' => $errors->has('email')?'label label-error':"label" ]) !!}
									{!! Form::email('email', null,[ 'class' => $errors->has('email')?'input-error':'' , 'required' ]) !!}
									@if($errors->has('email'))
										<small class="text-error-custom">{{ $errors->get('email')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('company','Company', [ "class" => $errors->has('company')?'label label-error':"label" ]) !!}
									{!! Form::text('company', null,[ 'class' => $errors->has('company')?'input-error':'' , 'required' ]) !!}
									@if($errors->has('company'))
										<small class="text-error-custom">{{ $errors->get('company')[0] }}</small>
									@endif
								</div>
								<div>
									{!! Form::label('phone','Phone', [ "class" => $errors->has('phone')?'label label-error':"label" ]) !!}
					  				{!! Form::text('phone', null,[ 'class' => $errors->has('phone')?'input-error':'' , 'required' ]) !!}
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
				<div class="clear"></div>
			</div>
			<br>
			<p class=" mediumBold getVirt">
				<span class="bold orange">GET A VIRTUAL OFFICE NOW</span>
				-
				<span class="gray2">SELECT A PLAN FOR THIS ADDRESS:</span>
				<br>
				<span class="gray3 medium" style="font-size:14px;">
					Or call: &nbsp;
	 				<span  style="font-size:18px;">[</span> North America:    +1 888.869.9494
		 			<span  style="font-size:18px;">] &nbsp; [</span>
		 			International:     +1 949.777.6340
		 			<span  style="font-size:18px;">]</span>
	 			</span>
	 		</p>
			<div class="dPlansWrap">
				<div class="dPlansAllWrap" style="overflow: auto;">
					<div class="dPlansAll">
						<div class="aPlan2">
						    <div class="aPlanTop2 bordeRight">
						    <div class="wrapPP">
						    <div id="startPlan" class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM <img src="/images/info.png" class="tooltip"/></h3></div>
						    <div class="secondline gray3">
						    	@if(isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price)
						    		<span class="price">&nbsp;{!! session('currency.symbol') !!}{!! $packages['Platinum']->current_currency_price->price !!}</span><span class="pMonth"> /MONTH</span><br><p class="save">$100 Set up fee</p>
						    	@else
						    		<span class="price"></span><br><p class="">Not Available</p><div class="btnSpace"></div>
						    	@endif
						    </div>
						    <div class="clear"></div>
						    </div><!--/wrapPP-->
						    @if(isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price)
							    <a href="{!! url('/customize-mail?p=103&cid='.$center->id) !!}" class="link">
							    	<div class="btnSelectP2">SELECT PLAN</div>
							    </a>
							@endif
						    <div class="gray2 showFplans2 triggerShow">Show and compare plan features</div>
						    </div><!--/aPlanTop2-->
						    <div class="aPlanBottom2 changeH bordeBottom bordeRight hide">
						    <ul class="check gray3">
							    <li>Business Address</li>
							    <li>Mail Receipt</li>
							    <li>Mail Forwarding *</li>
							    <li>Personal Mail Box</li>
						    </ul>
						    </div>
						</div>

						<div class="aPlan2 goright mobilePlan2">
						    <div class="aPlanTop2 bordeRight">
							    <div class="wrapPP">
								    <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM<a href="#" title=""> <img src="/images/info.png" class="tooltip2"/></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
									    <div class="secondline gray3">
										    @if(isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price)
										    	<span class="nonPrice orange cf1 bold">
										    		&nbsp;
										    		{!! session('currency.symbol') !!}{!! $packages['Platinum']->current_currency_price->with_live_receptionist_full_price !!}
										    		&nbsp;
										    	</span>
											    <span class="price">&nbsp;{!! session('currency.symbol') !!}{!! $packages['Platinum']->current_currency_price->with_live_receptionist_pack_price !!}
											    </span><span class="pMonth"> /MONTH</span>
											    <br>
											    <p class="save">
											    	<span class="orange mediumBold">You save $10</span> &nbsp; $100 Set up fee
											    </p>
											@else
												<span class="price"></span><br><p class="">Not Available</p><div class="btnSpace"></div>
										   	@endif
									    </div>
								    <div class="clear"></div>
							    </div><!--/wrapPP-->
							    @if(isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price)
									<a href="{!! url('/customize-mail?p=103&b=402&cid='.$center->id) !!}" class="link">
										<div class="btnSelectP2 orb">SELECT PLAN</div>
									</a>
								@endif
						    	<a href="#" class="gray2 triggerShow">
						    		<div class="gray2 showFplans2 triggerShow">Show and compare plan features</div>
						    	</a>
						    </div><!--/aPlanTop2-->
						    <div class="aPlanBottom2 changeH bordeRight hide">
							    <ul class="check gray2 bold">
							    	<li><span class="cf1">EVERYTHING IN PLATINUM</span></li>
							    </ul>
							    <ul class="plus">
							    	<li>PLUS</li>
							    </ul>
							    <ul class="check gray3">
							    	{{-- $platinum_with_included --}}
							    	<li>1 Included Phone Number</li>
					                <li>50 Live Answering Minutes</li>
					                <li>Unlimited Local and Long Distance Minutes</li>
					                <li>Personalized, Live Answering 9am-8pm Eastern US</li>
					                <li>Call Screening / Attended Transfer</li>
					                <li>Message Taking, Email Delivery of Messages</li>
					                <li>Voicemail, Email Delivery of Voicemail</li>
					                <li>Custom Recordings, Messages</li>
					                <li>Call Forwarding</li>
					                <li>Full Online Control Panel</li>
							    </ul>
						    </div>
						</div>

						<div class="aPlan2 mobilePlan">
						    <div class="aPlanTop2 bordeRight">
						    <div class="wrapPP">
						    <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM PLUS<a href="#" title=""> <img src="/images/info.png" class="tooltip3"/></a></h3></div>
						    <div class="secondline gray3">
						    	@if(isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price)
						    		<span class="price">&nbsp;{!! session('currency.symbol') !!}{!! $packages['Platinum Plus']->current_currency_price->price !!}</span><span class="pMonth"> /MONTH</span><br><p class="save">$100 Set up fee</p>
						    	@else
						    		<span class="price"></span><br><p class="">Not Available</p><div class="btnSpace"></div>
						    	@endif
						    </div>
						    <div class="clear"></div>
						    </div><!--/wrapPP-->
						    @if(isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price)
							    <a href="{!! url('/customize-mail?p=105&cid='.$center->id) !!}" class="link">
							    	<div class="btnSelectP2">SELECT PLAN</div>
							    </a>
							@endif
						    <a href="#" class="gray2 triggerShow"><div class="gray2 showFplans2 triggerShow">Show and compare plan features</div></a>
						    </div><!--/aPlanTop2-->
						    <div class="aPlanBottom2 changeH2 bordeRight hide">
						    <ul class="check gray2 bold">
						    <li><span class="cf1">EVERYTHING IN PLATINUM</span></li>
						    </ul>
						    <ul class="plus">
						    <li>PLUS</li>
						    </ul>
						    <ul class="check gray3">
						    <li>16 Hours of Meeting Room or Private Office Time</li>
						    </ul>
						    </div>
						</div>

						<div class="aPlan2 goright mobilePlan">
						    <div class="aPlanTop2">
						    <div class="wrapPP">
						    	<div class="firstline gray2">
						    		<h3 class="cf1">&nbsp; PLATINUM PLUS
							    		<a href="#" title="">
							    			<img src="/images/info.png" class="tooltip4"/>
							    		</a>
							    		<br>
							    		<span class="smallLine">WITH LIVE RECEPTIONIST</span>
						    		</h3>
						    	</div>

							    <div class="secondline gray3">
								    @if(isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price)
								    	<span class="nonPrice orange cf1 bold">
								    	&nbsp;
											{!! session('currency.symbol') !!}{!! $packages['Platinum Plus']->current_currency_price->with_live_receptionist_full_price !!}
										</span>
										&nbsp;
									    <span class="price">&nbsp;{!! session('currency.symbol') !!}{!! $packages['Platinum Plus']->current_currency_price->with_live_receptionist_pack_price !!}</span>
									    <span class="pMonth"> /MONTH</span>
									    <br>
									    <p class="save">
									    	<span class="orange mediumBold">You save $10</span> &nbsp; $100 Set up fee
									    </p>
							    	@else
							    		<span class="price"></span><br><p class="">Not Available</p><div class="btnSpace"></div>
							    	@endif
							    </div>
						    	<div class="clear"></div>
						    </div><!--/wrapPP-->
						    @if(isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price)
							    <a href="{!! url('/customize-mail?p=105&b=402&cid='.$center->id) !!}" class="link">
							    	<div class="btnSelectP2 orb">SELECT PLAN</div>
							    </a>
						    @endif
						    <a href="#" class="gray2 triggerShow"><div class="gray2 showFplans2 triggerShow">Show and compare plan features</div></a>
						    </div><!--/aPlanTop2-->
						    <div class="aPlanBottom2 changeH2 hide">
						    <ul class="check gray2 bold">
						    <li><span class="fitS">EVERYTHING IN PLATINUM WITH LIVE RECEPTIONIST</span></li>
						    </ul>
						    <ul class="plus">
						    <li>PLUS</li>
						    </ul>
						    <ul class="check gray3">
						    <li>16 Hours of Meeting Room or Private Office Time</li>
						    </ul>
						    </div>
						</div>
					</div>
				</div>
				<div class="extras2 gray3 hide">
					<p>
						<span class="bold">ALL PLANS MAY OFFER WITH ADDITIONAL CHARGES:</span>
						 Main Building Directory Listing (where available) *   -  Professional Admin Services *   -  Professional Business Support Center *
					</p>
					<p>
						<span class="bold">PLANS WITH MEETING ROOMS AND PRIVATE OFFICE TIME:</span>
						 Board rooms, seminar rooms and training rooms are not included.
					</p>
				</div>
				<div class="expl2 gray3 hide">* Extra fees may apply</div>
				<div class="clear"></div>
				<div class="detailsTopWrap2">
					<div class="descTopLeft">
						<div class="wrapDescrip">
							<h3 class="gray2">VIRTUAL OFFICE DESCRIPTION</h3>
							<p class="gray3">{!! $center->virtual_office_seo->avo_description !!}</p>
							<br><h3>PHOTOS</h3>
							<div class="littleImgs">
								<div id="links">
									@foreach($center->vo_photos as $photo)
										<a href="http://www.abcn.com/images/photos/{!! $photo->path !!}" title="{!! $photo->caption !!}">
											<div class="centerimg">
												<div class="img-wrapper3">
													<img src="http://www.abcn.com/images/photos/{!! $photo->path !!}" alt=""/>
												</div>
											</div>
										</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="dformright radiusTop" style="padding-top:0px;">
						<div class="dmap2">
							<div id="map_canvas" style="width:100%; height:100%"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="nearWrap">
			<h3 class="gray2">NEARBY CENTERS</h3>
			@foreach($nearby_centers as $_center)
				@if($_center->id != $center->id)
					<a href="{!! URL::action('VirtualOfficesController@getVirtualOfficeShowPage', ['country_code' => $center->country, 'city_slug' => $_center->city? $_center->city->slug : '', 'center_slug' => $_center->slug, 'center_id' => $_center->id])!!}">
						<div class="cNear">
							<div class="nearImg">
								<div class="img-wrapper4">
									@if(is_null($photo = $_center->vo_photos()->first()))
										<img src="/mr-photos/no_pic.gif">
									@else
										<img src="http://www.abcn.com/images/photos/{!! $photo->path !!}" alt="$photo->alt">
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
	<link rel="stylesheet" type="text/css" href="/css/magnific-popup.css"/>
	<link rel="stylesheet" type="text/css" href="/css/tooltipster.css"/>
	<link rel="stylesheet" type="text/css" href="/css/themes/tooltipster-light.css"/>
	<link rel="stylesheet" type="text/css" href="/css/jquery.tosrus.all.css"/>
@stop

@section('scripts')
	<script type="text/javascript" src="/js/jquery.tooltipster.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tosrus.min.all.js"></script>
	<script type="text/javascript" src="/js/hammer.js"></script>
	<script type="text/javascript" src="/js/jquery.sticky-kit.min.js"></script>
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
		function done() {
			$( ".aPlanBottom2" ).show();
			$( ".extras2" ).show();
			$( ".expl2" ).show();
			$(".dformright").trigger("sticky_kit:detach");
			$(".dformright").stick_in_parent();
			$(".triggerShow").hide();
		}
        jQuery(document).ready(function($) {

			$( ".menuBtnLink" ).click(function() {
			  	$( ".menu" ).slideToggle( "slow", function() {
					// Animation complete.
			  	});
			});

			$( ".triggerShow" ).click(function() {
				$( ".aPlanBottom2" ).show();
			  	$( ".extras2" ).show();
				$( ".expl2" ).show();
				$(".dformright").trigger("sticky_kit:detach");
				$(".dformright").stick_in_parent();
				$(".triggerShow").hide();
				$(".aPlanTop2").css('min-height', '180px');
				return false;
			});

			$('.tooltip').tooltipster({
				animation: 'fade',
				theme: 'tooltipster-light',
				trigger: 'hover',
				contentAsHTML: true,
				interactive: true,
            });

			$('.tooltip2').tooltipster({
				animation: 'fade',
				theme: 'tooltipster-light',
				trigger: 'hover',
				contentAsHTML: true,
				interactive: true,
            });

			$('.tooltip3').tooltipster({
				animation: 'fade',
				theme: 'tooltipster-light',
				trigger: 'hover',
				contentAsHTML: true,
				interactive: true,
            });

			$('.tooltip4').tooltipster({
				animation: 'fade',
				theme: 'tooltipster-light',
				trigger: 'hover',
				contentAsHTML: true,
				interactive: true,
            });

			$("#links a").tosrus({
			   	caption : {
				  	add : true
			   	}
			});

			if ($(window).width() > 750) {
			   	$(".dformright").stick_in_parent()
			}

			$( window ).resize(function() {
			  	if ($(window).width() < 750) {
				   	$(".dformright").trigger("sticky_kit:detach");
				} else {
				   	$(".dformright").stick_in_parent()
				}
			});
			$('.tooltip').tooltipster('update', '<span> Entry level plan for startups looking for a way to have the lowest cost presence in a desirable market. <br><span class="bold">Receive mail anywhere; redirect it anywhere.</span><br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span>');
			$('.tooltip2').tooltipster('update', '<span> Entry level plan <span class="bold">for startups and small business</span> who want a full virtual presence. Great for those looking for those opening a remote office who need a full local presence. <br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
			$('.tooltip3').tooltipster('update', '<span> <span class="bold">One of our most popular services.</span> Best for startups and growing businesses who expect to meet with clients and colleagues on a regular basis in a stylish business setting.<br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
			$('.tooltip4').tooltipster('update', '<span> <span class="bold">Our most popular service.</span> Best for startups and growing businesses who want a full complement of virtual services and who expect to meet with clients and colleagues on a regular basis in a stylish business setting. <br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
        });
    </script>
@stop
