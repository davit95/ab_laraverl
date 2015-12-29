@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
    <div class="videoTop">
        <div class="Insidevideo">

            <div class="contactTop">Call: +1 888.869.9494</div>
            <div class="startSearch">
                <div class="startLine">LOOKING FOR A 21st CENTURY SOLUTION FOR YOUR NEXT OFFICE?</div><!--/startLine-->
                <div id="sticky-anchor"></div>
                <div class="searchHome" id="sticky">
                    <form action="search2.php" autocomplete="off" id="avoS" method="get">
	                    <input type="hidden" name="step" value="search">
                        <input type="text" class="SearchInput acInput" id="suggest1" name="inputy" placeholder="Find Your Location Here" autocomplete="off">
                        <select id="Services" name="avo1" class="avo1">
                            <option value="VO">Virtual Offices</option>
                            <option value="MR">Meeting Rooms</option>
                        </select>
                        <input type="hidden" name="source" value="bb">
                        <button type="submit" class="searchBtn search-button form-inline btn btn-primary btn-large" id="searchBtn">
                            <span class="mobileS">Search</span>
                        </button>
                    </form>
                </div>
                <div class="ViewAllLocations">
                    <a href="{!! URL::action('VirtualOfficesController@index') !!}#NAsection" class="aqua">View All Locations Here!</a>
                </div>
            </div>
        </div>

        <div class="videoWrap">
            <video autoplay="" loop="" id="bgvid">
                <source src="/videos/AVOHome.webm" type="video/webm">
                <source src="/videos/AVOHome.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="contactMobile">Call: +1 888.869.9494</div>
    <div class="middleInfo">
        <div class="mWrap">
            <div class="m1Left">
                <h1>
                    Get a smart,<br>
                    affordable workplace<br>
                    solution today.
                </h1>
                <div class="servicesIcons">
                    <div class="servIcons virtualOfficeIcon">
                        <a class="ServIconsLink" href="/virtual-office-locations.php">
                            <img src="/images/office-address-.png" width="139" height="139" border="0" alt="Office Address">
                        </a>
                    </div>
                    <div class="servIcons liveRecIcon">
                        <a class="ServIconsLink" href="/live-receptionist.php">
                            <img src="/images/live-receptionists-.png" width="139" height="139" border="0" alt="Office Address">
                        </a>
                    </div>
                    <div class="servIcons meetingRoomIcon">
                        <a class="ServIconsLink" href="/meeting-room-locations.php">
                            <img src="/images/meeting-rooms-.png" width="139" height="139" border="0" alt="Office Address">
                        </a>
                    </div>
                </div>
                <p>
                    <span class="cf1">
                        We have everything your growing business needs for <span class="bold">instant credibility:</span>
                    </span>
                    <br><br>
                    <span class="cf2">An office address, a local or toll free number, and a receptionist answering calls in your company name.</span>
                    <br><br>
                    <span class="cf3"><span class="bold">World-class service</span> with no strings attached</span>
                </p>
                <div class="StartNow"><a href="{!! URL::action('VirtualOfficesController@index') !!}">Get a Workplace Solution Now</a></div>
        	</div>
        </div>
    	<div class="middleBottomTxt">
        	<p>We've been in the workspace business for decades. We developed
                <span class="bold">Alliance Virtual Offices</span>
                because we needed the same things you do.<br>
    			It's <span class="bold">flexible, affordable, scalable</span> - and it moves with your business.
            </p>
            <br>
    		<h2>YOU CAN COUNT ON US</h2>
            <p>We're backed by
                <a href="http://www.abcn.com" class="txtLink">
                    <span class="bold">Alliance Business Centers Network</span>
                </a>, the world's largest network of workspace centers. <br>
                But we're not a faceless corporate. We're a small friendly unit with your business interests at heart. <br><br>
                We want what you want - and we're giving you the tools to do it.<br><br>
            </p>
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
    <div class="WhyUs">
        <div class="Wrapper">
            <h2 class="clearColor bigh2">Why Us?</h2>
            <div class="reasons rightSpace rh">
                <h3 class="clearColor">Friendly and Professional.</h3>
                <p class="clearColor2">We want to make your office experience effortless and complete.
                We are adding new features to help you work better, and to make your virtual office
                complete. Our customer service representatives strive every day to become
                your resource to make things run smoothly.<br>
                <span class="mediumBold">Tired of feeling like an account number?</span><br>
                We know the feeling. Which is why we treat your business with the respect it deserves.</p>
            </div><!--/reasons-->
            <div class="reasons rh">
                <h3 class="clearColor">Fully Flexible.</h3>
                <p class="clearColor2">Every business is unique, so you can pick and choose the services that fit your needs.
                Our contracts are flexible too, with short monthly agreements and fuss-free billing.</p>
            </div><!--/reasons-->
            <div class="reasons rightSpace rh2">
                <h3 class="clearColor">The Complete Solution.</h3>
                <p class="clearColor2">A recognized business address, live receptionist services, meeting rooms and
                local phone number - all with an advanced communications infrastructure.</p>
            </div><!--/reasons-->
            <div class="reasons rh2">
                <h3 class="clearColor">Easy to Manage.</h3>
                <p class="clearColor2">Control your account online, add or remove services and check your
                invoices - all through a simple, secure system. Our Customer Services team
                is on-hand to help you every step of the way.</p>
            </div>
        </div>
        <div class="Wrapper">
            <div class="StartToday"><a href="{!! URL::action('VirtualOfficesController@index') !!}">Get a Workplace Solution Today</a></div>
        </div>
    </div>
    <div class="MoreBenefits">
        <div class="Wrapper">
        	<h2 class="clearColor italic bigh2">More Benefits</h2>
        </div>
        <div class="Wrapper">
            <div class="benefits">
                <h3 class="clearColor">Best Value Workplaces:</h3>
                <p class="clearColor2">You can't get better value than this.
                Virtual office plans start <span class="mediumBold melon">from just $49 per month</span>, complete
                with a world-class business address, mail handling, and
                friendly customer service support as standard.</p>

            	<h3 class="clearColor">Part of a Trusted Global Alliance:</h3>
                <p class="clearColor2">Alliance Virtual Offices is part of the <span class="mediumBold">Alliance Business Centers Network</span>.
                Established in 1992, Alliance is the largest global network of
                workspace centers in the world, with <span class="mediumBold melon">more than 600 locations in 40 countries</span>... and counting.<br>
                <a href="#" class="aqua undeline">More About Alliance Virtual</a></p>
            </div><!--/benefits-->
            <div class="benefits2">
            	<h3 class="clearColor">The Instant Office:</h3>
                <p class="clearColor2">Want a new office address today? You got it. <br>
        		<a href="#" class="aqua undeline">Sign up online</a> in minutes and choose your new business HQ from hundreds
                of office buildings all over the world.</p>

            	<h3 class="clearColor">Work without walls.</h3>
                <p class="clearColor2">What will the future workplace look like?<br>
                The answer is simple. The future is already here.<br>
                Alliance Virtual Offices supports your mobile working strategy.
                We give you the foundations to work virtually anywhere.
                Get a receptionist service, a local number and a real business address.
                <span class="mediumBold melon">It's flexible, grounded, and affordable.</span></p>
            </div>
        </div>
    </div>
    <div class="FromBlog">
        <div class="Wrapper">
            <h3 class="italic">FROM THE BLOG</h3>
        </div>
    </div>
@stop

@section('scripts')
	<script type="text/javascript" src="/js/fixed-search-box.js"></script>
@stop