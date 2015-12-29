@extends('layout.layout')

@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
	<div class="MeetingRooms">
        <div class="contactTop">Call: +1 888.869.9494</div>
        <div class="productContWrap">
            <div class="productTxtWrap">
                <h1 class="mediumBold">
                    Time to Talk Business:
                    <br>
                    Meeting Rooms for Every Agenda
                </h1>
                <p class="light">
                    Book a meeting room online in your virtual office location, or in another listed business center of your choice. Select your location from <span class="mediumBold">hundreds of meeting rooms worldwide</span>, choose your room size, add any special requests, and leave the rest to us. Alliance Virtual Offices acts as your personal concierge, booking the room on your behalf.
                </p>
                <a class="popup-with-form popupForm" href="#test-form">
                    <div class="inquiryBtn">INQUIRE ABOUT MEETING ROOMS</div>
                </a>
            </div>
            <div id="sticky-anchor"></div>
            <div class="searchHome" id="sticky">
                <form action="search2.php" autocomplete="off" id="avoS" method="get">
                    <input type="hidden" name="step" value="search" />
                    <input type="text" class="SearchInput" id="suggest1" name="inputy" placeholder="Find Your Location Here" />
                    <select id="Services" name="avo1" class="avo1" >
                        <option value="MR">Meeting Rooms</option>
                        <option value="VO">Virtual Offices</option>
                    </select>
                    <input type="hidden" name="source" value="bb">
                    <button type="submit" class="searchBtn search-button form-inline btn btn-primary btn-large aquaB" id="searchBtn" >
                        <span class="mobileS">Search</span>
                    </button>
                </form>
            </div>
            <div class="ViewAllLocations">
                <a href="#NAsection" class="white">View All Locations Here!</a>
            </div>
        </div>
        <div id="test-form"  class="mfp-hide">
            <div class="centerForm2 popUpF">
                <h3>INQUIRE ABOUT
                <span class="bold">MEETING ROOMS</span></h3>
                @if(session('success'))
                    <div class="alert-success-custom">
                        {{ session('success') }}
                    </div>
                @endif
                {!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
                    <div>
                        {!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
                        {!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'', 'required' ]) !!}
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
                    <div>
                        {!! Form::label('comments','Comments', [ "class" => $errors->has('comments')?'label label-error':"label" ]) !!}
                        {!! Form::textarea('comments', null,[ 'class' => $errors->has('comments')?'input-error':'' , 'required']) !!}
                        @if($errors->has('comments'))
                            <small class="text-error-custom">{{ $errors->get('comments')[0] }}</small>
                        @endif
                    </div>
                    <label for="label"><div class="label"><a href="{{ url('privacy-policy') }}" target="_blank" class="privateP">Privacy Policy</a></div></label>
                    <label for="submit"></label>
                    <button type="submit" id="submit2">FIND OUT MORE</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="contactMobile2">Call: +1 888.869.9494</div>

    <div class="Bookings">
    	<div class="productContWrap">
            <div class="productTxtWrap">
                <h1>Online Bookings</h1>
                <p>
                    Book your meeting room online and receive an email confirmation within the hour*. Select your location, venue and room size, enter your payment details into our secure portal, and you're done. We'll confirm availability direct with the venue, confirm your booking and send a confirmation email immediately.
                    <br>
                    <span class="smallLine">*During business hours</span>
                </p>
                <br>
                <h1>Or Book By Phone</h1>
                <p>
                    Phone your meeting room requirements through to us and we'll act as your private concierge. We'll source a suitable venue, check availability and confirm your booking within the hour*. We'll also handle any changes or cancellations.
                    <br>
                    <span class="smallLine">*During business hours</span>
                </p>
            </div>
        </div>
    </div>

    <div class="PBenefits">
    	<div class="productContWrap">
            <div class="productTxtWrap">
                <h1>Benefits</h1>
                <p>
                    <span class="mediumBold">Meeting rooms in minutes:</span>
                    <br>
                    Choose from thousands of meeting rooms in
                    <span class="medium">hundreds of locations across the globe</span>.
                    By the hour, half or full day - the choice is yours.
                    <br>
                    Book online in minutes with our fast, secure system.
                    <br>
                    <br>
                    <span class="mediumBold">No more noisy coffee shops:</span>
                    <br>
                    Isn't it time to upgrade your meeting venue?<br> Give your business the VIP experience it deserves, without the luxury price tag.
                    <br>
                    <span class="medium">From interview rooms to conference suites</span>,
                    budget-friendly to WOW-factor, book meeting rooms in every size, shape and city imaginable.
                    <br>
                    <br>
                    <span class="mediumBold">Clear pricing structure:</span>
                    <br>
                    Renting a meeting room doesn't have to take up the lion's share of your budget. All of our meeting rooms are clearly and competitively priced, with a list of inclusive amenities too. A friendly greeting comes as standard, along with help and support from the Alliance Virtual Offices team.
                </p>
            </div>
        </div>
    </div>

    <div class="MR_Services">
    	<div class="productContWrap">
            <div class="productTxtWrap">
                <h1>Available Services</h1>
                <p>
                    <span class="mediumBold">Full transparency:</span>
                    <br>
                    Just like a hotel, facilities vary from room-to-room.
                    <br>
                    Rest assured full details of what's included will be clearly displayed on your chosen meeting room venue, prior to booking.
                    <br>
                    <br>
                    <span class="mediumBold">Friendly greeting:</span>
                    <br>
                    Every venue is staffed by a professional management team who are ready and waiting to receive you and your guests. Many venues also offer additional receptionist support such as admin or secretarial services.
                    <br>
                    <br>
                    <span class="mediumBold">We're here for you:</span>
                    <br>
                    When you rent a meeting room through
                    <span class="medium">Alliance Virtual Offices</span>,
                    <br>
                    we become
                    <span class="medium">your personal concierge</span>.
                    We book the room on your behalf and handle any follow-up procedures. Whatever you need, simply pick up the phone or email us for help and support.
        		</p>
            </div>
        </div>
    </div>

    <div class="HowToBook">
    	<div class="productContWrap">
            <div class="productTxtWrap">
                <h1>How to Book</h1>
                <p>
                    Booking a meeting room through Alliance Virtual Offices couldn't be simpler. Get your calendar ready, follow these few simple steps, et voila - you've booked your perfect meeting room! Here's how it works:
                    <br>
                    <br>
                    <span class="mediumBold">Step 1.</span> Find your preferred meeting venue.
                    <br>
                    <br>
                    <span class="mediumBold">Step 2.</span> Enter your date and time frame, choose your style of meeting room and capacity, choose additional services then click 'Submit'.
                    <br>
                    <br>
                    <span class="mediumBold">Step 3.</span> Checkout
                    <br>
                    <br>
                    <span class="mediumBold">Step 4.</span> Your booking will be verified and payment processed*. You'll receive a room reservation and payment confirmation.
                    <br>
                    <br>
                    <span class="mediumBold">Step 5.</span> You're all set. All that's left to do is attend the meeting!
        		</p>
            </div>
        </div>
    </div>

    <div id="NAsection" class="NAsection">
        <div class="Wrapper">
            <h2 class="smallh2">LOCATIONS IN NORTH AMERICA</h2>
	       @include('meeting-rooms.parts.na-list')
    	</div>
	</div>

	<div class="TopCities">
    	<div class="Wrapper">
        	<h2 class="smallh2">TOP CITIES</h2>
        	<ul>
            	<a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'los-angeles', 'city_id' => '2173'])!!}"><li>Los Angeles</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'new-york', 'city_id' => '15275'])!!}"><li>New York</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'chicago', 'city_id' => '5294'])!!}"><li>Chicago</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'dallas', 'city_id' => '21622'])!!}"><li>Dallas</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'atlanta', 'city_id' => '4168'])!!}"><li>Atlanta</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'houston', 'city_id' => '21899'])!!}"><li>Houston</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'GB', 'city_slug' => 'london', 'city_id' => '25311'])!!}"><li>London</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'CN', 'city_slug' => 'beijing', 'city_id' => '25186'])!!}"><li>Beijing</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'JP', 'city_slug' => 'tokyo', 'city_id' => '25256'])!!}"><li>Tokyo</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'AE', 'city_slug' => 'dubai', 'city_id' => '25303'])!!}"><li>Dubai</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'DE', 'city_slug' => 'berlin', 'city_id' => '25215'])!!}"><li>Berlin</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'NL', 'city_slug' => 'amsterdam', 'city_id' => '25278'])!!}"><li>Amsterdam</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'FR', 'city_slug' => 'paris', 'city_id' => '25209'])!!}"><li>Paris</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'las-vegas', 'city_id' => '13791'])!!}"><li>Las Vegas</li></a>
                <a href="{!! URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => 'US', 'city_slug' => 'washington', 'city_id' => '3251'])!!}"><li>Washington</li></a>

        	</ul>
    	</div>
	</div>
@stop

@section('scripts')
    <script type="text/javascript" src="/js/fixed-search-box.js"></script>
@stop