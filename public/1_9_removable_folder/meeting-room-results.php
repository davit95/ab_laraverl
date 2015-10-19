<?php
include ("../connect_db.php");
include ("../siteFunctions.php");

// This is where the content goes
$state_info = array();

// Based on info passed we'll search "Center_Extras" and get a list of center IDs

// If it's "ss" it's either a state or a country
if( isset($_GET['ss']) )
{
	$_GET['ss'] = mysql_real_escape_string($_GET['ss']);
	$center_list = array();
	$city_list = array();
	$city_name = '';
	$full_name = mysql_real_escape_string($_GET['ss']);
	$immed_country_abbrv = '';
	$state_level = 'no';
	$country_level = 'no';
	$city_level = 'no';
	$header_1 = '';
	$header_2 = '';
	$url_state = '';

	// Check to see if it's a state, if not then it's a country
	$StateCheck = mysql_query("SELECT Center_ID, URL_City, Full_City, Full_Country, Full_State, URL_State FROM Center_Extras WHERE URL_State = '$full_name' ORDER BY URL_City");
	while( $Sresults = mysql_fetch_array($StateCheck) )
	{
		check_filter($Sresults[Center_ID]);
		if( ($meeting_result != 'Remove') && ($active_result != 'Remove') ) 
		{
			array_push($center_list, "$Sresults[Center_ID]");
			if( $city_name != $Sresults[URL_City] )
			{
				$city_list[$Sresults['Full_City']] = $Sresults[URL_City];
				$city_name = $Sresults[URL_City];
			}
			$start_full_country = $Sresults[Full_Country];
			$full_state = $Sresults[Full_State];
			$url_state = $Sresults['URL_State'];
			$city_header = $Sresults[Full_State] . ' Meeting Room Solutions | Virtual Receptionists';
		}
	}

	// See if there were any centers from that search
	$number_of_centers = count($center_list);

	// Get country abbrv for the URL later on
	$queryC = mysql_query("SELECT Code FROM Country WHERE Name = '$start_full_country'");
	$Cresult = mysql_fetch_row($queryC);
	$immed_country_abbrv = $Cresult[0];

	// Do all the SEO stuff for State Level
	$title = $full_state . ' Meeting Rooms | Conference Rooms';
	$description = 'Looking for ' . $full_state . ' meeting room space or services? Our rates are very attractive right now and we\'ll help you find a great meeting room solution!';
	$keywords = $full_state . ',' . $full_state . ' meeting rooms in ' . $full_state . ', conference rooms,serviced offices meeting rooms,administrative assistants,seminar rooms,training rooms';
	$h1 = $full_state . ' Meeting Room Solutions | Conference Rooms';
	$h2 = 'Convenient Meeting Rooms and On-site Staff';
	$seo_footer = 'Alliance Virtual Offices is a great way to find ' . $full_state . ' conference rooms, ' . $full_state . ' meeting rooms, private offices and and first rate adminstrative staff to power your next meeting.';
	

	// all the vars for the new design
	$header_1 = $full_state;
	$header_2 = $full_state;

	// If there weren't any results then go to the country
	if( $number_of_centers < '1' )
	{
		$country_level = 'yes';
		// Check to see if it's a country
		$CountryCheck = mysql_query("SELECT Center_ID, URL_City, Full_City, Full_Country FROM Center_Extras WHERE URL_Country = '$full_name' ORDER BY URL_City");
		while( $CNresults = mysql_fetch_array($CountryCheck) )
		{
			check_filter($CNresults[Center_ID]);
			if( ($meeting_result != 'Remove') && ($active_result != 'Remove') ) 
			{ 
				array_push($center_list, "$CNresults[Center_ID]");
				if( $city_name != $CNresults[URL_City] )
				{
					$city_list[$CNresults['Full_City']] = $CNresults[URL_City];
					$city_name = $CNresults[URL_City];
					$full_city_name = $CNresults['Full_City'];
				}
				$start_full_country = ucwords(strtolower($CNresults['Full_Country']));
			}
		}
		// Get country abbrv for the URL later on
		$queryCN = mysql_query("SELECT Code FROM Country WHERE Name = '$start_full_country'");
		$CNresult = mysql_fetch_row($queryCN);
		$immed_country_abbrv = $CNresult[0];
		$city_header = $start_full_country . ' Meeting Rooms | Virtual Receptionists';

		// Do all the SEO stuff for Country Level
		$title = $start_full_country . 'Meeting Rooms | Conference Rooms';
		$description = 'There are plenty of low cost meeting room options in ' . $start_full_country . ' and Alliance Virtual Offices can help you find a great meeting room globally.';
		$keywords = $start_full_country . ',meeting rooms in ' . $start_full_country . ',conference rooms,training rooms,seminar rooms,virtual office';
		$h1 = $start_full_country . ' Meeting Rooms | Conference Rooms';
		$h2 = 'On-demand Meeting Rooms and Conference Rooms';
		$seo_footer = '';

		// all the stuff for the new design
		$header_1 = $start_full_country;
		$header_2 = $start_full_country;

		// make the breadcrumbs, baby
		$formatted_country = ucwords(strtolower($start_full_country));
		$crumbs = <<<END
<div id="breadcrumbs">
<a href="http://www.alliancevirtualoffices.com">Home</a> > <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php">Meeting Rooms</a> > $formatted_country
</div>
END;
	}
	else
	{
		$state_level = 'yes';
		// make the state breadcrumbs
		$crumbs = <<<END
<div id="breadcrumbs">
<a href="http://www.alliancevirtualoffices.com">Home</a> > <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php">Meeting Rooms</a> > <a href="http://www.alliancevirtualoffices.com/united-states-meeting-rooms">United States</a> > $full_state
</div>
END;
	}
}

// If it's "ct" then it's a city
if( isset($_GET['ct']) )
{
	// custom js code for Mike 11-11-2010
	if( $_GET['ct'] == 'los-angeles' )
	{
		$custom_js = '<script type="text/javascript" src="http://dnn506yrbagrg.cloudfront.net/pages/scripts/0011/2521.js"> </script>';
	}

	$_GET['ct'] = mysql_real_escape_string($_GET['ct']);
	$_GET['ccn'] = mysql_real_escape_string($_GET['ccn']);
	$city_level = 'yes';
	// Get the country info for the city
	$Countryquery = mysql_query("SELECT Name FROM Country WHERE Code = '$_GET[ccn]'");
	$Cresult = mysql_fetch_row($Countryquery);
	$country_name = $Cresult[0];
	$header_1 = '';
	$header_2 = '';

	// Get city info
	$center_list = array();
	$center_list_full = array();
	$center_list_empty = array();
	$city_list = array();
	$city_name = '';
	$full_name = mysql_real_escape_string($_GET['ct']);
	$url_state = '';
	$url_country = '';
	$full_country = '';

	// Get list of centers
	$CityCheck = mysql_query("SELECT Center_ID, URL_City, Full_City, Full_Country, Full_State, URL_State, URL_Country FROM Center_Extras WHERE URL_City = '$full_name' AND Full_Country='$country_name'");
	while( $CityResults = mysql_fetch_array($CityCheck) )
	{
		check_filter($CityResults['Center_ID']);
		if( ($meeting_result != 'Remove') && ($active_result != 'Remove') ) 
		{ 
			array_push($center_list, $CityResults['Center_ID']);
			$full_city = $CityResults['Full_City'];
			$full_state = $CityResults['Full_State'];
			$url_state = $CityResults['URL_State'];
			$url_country = $CityResults['URL_Country'];
			$full_country = ucwords(strtolower($country_name));
		}
	}

	// Do all the SEO stuff for City Level
	$title = $full_city . ' Meeting Rooms | Conference Rooms';
	$description = 'Check out our ' . $full_city . ' meeting room or conference room options. We also have phone, audio visual, catering and admin services available.';
	$keywords = $full_city . ',' . $full_city . ' meeting rooms, conference rooms,serviced offices meeting rooms,administrative assistants,seminar rooms,training rooms';
	$h1 = $full_city . ' Meeting Rooms | Conference Room Services';
	$h2 = 'On-demand Meeting Rooms and Services';

	// make breadcrumbs
	if( $_REQUEST['ccn'] == 'US' )
	{
		$state_insert = <<<END
<a href="http://www.alliancevirtualoffices.com/$url_state-meeting-rooms">$full_state</a> / 
END;
	}

	$crumbs = <<<END
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php">Meeting Rooms</a> / <a href="http://www.alliancevirtualoffices.com/$url_country-meeting-rooms">$full_country</a> / $state_insert $full_city
END;


	if ( $full_city == 'Las Vegas')
     	{
         	$seo_footer = 'When it comes to prime meeting locations, Las Vegas is difficult to beat. This "sin"sational city makes for the ideal place to work hard and play hard, and Alliance Virtual Offices has got all of your meeting room and conference room needs covered – check out the <a href="http://www.alliancevirtualoffices.com/US/las-vegas-meeting-room/gallery">photo gallery of our Las Vegas meeting and conference rooms</a> for proof. With a host of impressive training rooms and seminar rooms to choose from at our Las Vegas meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href="http://www.alliancevirtualoffices.com/US/las-vegas-meeting-room/amenities">meeting room support services and amenities</a> as you take care of business, and get the job done.'.'<br><br>'.'Plus, get a load of all the <a href="http://www.alliancevirtualoffices.com/US/las-vegas-meeting-room/tour-information">benefits of touring our facilities</a>! Our Las Vegas meeting facilities will leave you wanting for nothing – this is the meeting done right.';
     	}
	elseif ( $full_city == 'Washington')
     	{
         	$seo_footer = "If you've been searching high and low for your next Washington DC meeting rooms, conference rooms or training facilities / training rooms, you've come to the right place! Alliance Virtual Offices has got all of your capital city meeting room and conference room needs covered – check out the <a href='http://www.alliancevirtualoffices.com/US/washington-meeting-room/gallery'>photo gallery of our Washington DC meeting and conference rooms</a> if you don't believe it. Sound too good to be true?".'<br><br>'."With an impressive selection of training rooms and seminar rooms to choose from at our Washington DC meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/washington-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, get a load of all the <a href='http://www.alliancevirtualoffices.com/US/washington-meeting-room/tour-information'>benefits of touring our Washington DC facilities</a>! Our meeting facilities will leave you wanting for nothing – this is the meeting done right.";
     	}
	elseif ( $full_city == 'Houston')
     	{
         	$seo_footer = "They say things are bigger in Texas, and when it comes to the best selection of meeting and conference rooms, Alliance Virtual is as big as it gets. Houston stands as an ideal place to host your next meeting, and Alliance Virtual Offices has got all of your meeting room and conference room needs covered – check out the <a href='http://www.alliancevirtualoffices.com/US/houston-meeting-room/gallery'>photo gallery of our Houston meeting and conference rooms</a> for an up close and personal peek at what we've got to offer.".'<br><br>'."With a wide range of impressive training rooms and seminar rooms to choose from at our Houston meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/houston-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, get a load of all the <a href='http://www.alliancevirtualoffices.com/US/houston-meeting-room/tour-information'>benefits of touring our facilities</a>! Our Houston meeting facilities were designed with you in mind. This is the meeting on YOUR terms.";
     	}
	elseif ( $full_city == 'Dallas')
     	{
         	$seo_footer = "Alliance Virtual Offices has had a longstanding presence in the state of Texas, and when it comes to the best selection of Dallas meeting and conference rooms, we've got you covered. Dallas makes for an ideal place to host a meeting, conference or training session and Alliance Virtual Offices has got all of your meeting room and conference room needs covered – <a href='http://www.alliancevirtualoffices.com/US/dallas-meeting-room/gallery'>check out the photo gallery of our Dallas meeting and conference rooms</a> for a glimpse into what we've got to offer.".'<br><br>'."With a wide range of impressive training rooms and seminar rooms to choose from at our Dallas meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/dallas-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. What's more, get a load of all the <a href='http://www.alliancevirtualoffices.com/US/dallas-meeting-room/tour-information'>benefits of touring our facilities</a>! Our Dallas meeting facilities will take care of everything you need while giving you everything you want. How's that for a meeting invite?";
     	}
	elseif ( $full_city == 'New York')
     	{
         	$seo_footer = "You get and send a lot of meeting invites. How about planning a meeting that's actually inviting for a change? The Big Apple is the perfect place to host your next big meeting, conference or training session and Alliance Virtual Offices has got all of your meeting room and conference room needs covered – <a href='http://www.alliancevirtualoffices.com/US/new-york-meeting-room/gallery'>check out the photo gallery of our New York meeting and conference rooms</a> for look at what you've been missing.".'<br><br>'."With a fantastic selection of impressive training rooms and seminar rooms to choose from at our New York meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/new-york-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, check out all the <a href='http://www.alliancevirtualoffices.com/US/new-york-meeting-room/tour-information'>benefits of touring our facilities</a>! At Alliance Virtual, we're always in a New York state of mind...";
     	}
	elseif ( $full_city == 'Atlanta')
     	{
         	$seo_footer = "At Alliance Virtual Offices, Georgia is always on our mind! The increasingly trendy city of Atlanta makes for the perfect place to host your next big meeting, conference or training session and Alliance Virtual has got all of your meeting room and conference room needs taken care of. Need proof? From the Peachtree Center to the Lenox Center, <a href='http://www.alliancevirtualoffices.com/US/atlanta-meeting-room/gallery'>check out the photo gallery of our Atlanta meeting and conference rooms.</a>".'<br><br>'.'With a great array of impressive training rooms and seminar rooms to choose from at each of our Atlanta meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href="http://www.alliancevirtualoffices.com/US/atlanta-meeting-room/amenities">meeting room support services and amenities</a> as you take care of business and get the job done. Plus, check out all the <a href="http://www.alliancevirtualoffices.com/US/atlanta-meeting-room/tour-information">benefits of touring our Atlanta meeting facilities</a>. Alliance Virtual Offices – helping to put the "hot" in Hotlanta!';
     	}
	elseif ( $full_city == 'Los Angeles')
     	{
         	$seo_footer = "Alliance Virtual Offices will help keep your California dreams from turning into nightmares with the help of our incredible meeting and conference rooms packages. Los Angeles is a great place to host meetings, conferences or training sessions of any size and Alliance Virtual has got all of your meeting room and conference room needs taken care of. Need proof? <a href='http://www.alliancevirtualoffices.com/US/los-angeles-meeting-room/gallery'>Check out the photo gallery of our Los Angeles meeting and conference rooms.</a>".'<br><br>'."With a large variety of cutting edge training rooms and seminar rooms to choose from at each of our LA meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/los-angeles-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, check out all the <a href='http://www.alliancevirtualoffices.com/US/los-angeles-meeting-room/tour-information'>benefits of touring our Los Angeles meeting facilities</a>. This is LA, your way.";
     	}
	elseif ( $full_city == 'Chicago')
     	{
         	$seo_footer = "In the Windy City, Alliance Virtual's meeting and conference room options will blow you away! This beloved Midwestern city makes for the perfect place to host your next big meeting, conference or training session and Alliance Virtual has got all of your meeting room and conference room needs taken care of. Don't believe it? <a href='http://www.alliancevirtualoffices.com/US/chicago-meeting-room/gallery'>Check out the photo gallery of our Chicago meeting and conference rooms.</a> After all, seeing is believing.".'<br><br>'."You and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/chicago-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. With training rooms and seminar rooms to choose from at each of our Chicago meeting room locations, we've got you covered. Plus, check out all the <a href='http://www.alliancevirtualoffices.com/US/chicago-meeting-room/tour-information'>benefits of touring our Chicago facilities</a>!";
     	}
	elseif ( $full_city == 'Irvine')
     	{
         	$seo_footer = "In sunny Southern California, the city of Irvine stands as an ideal location for any business meeting or conference. For your next big meeting, conference or training session, why not try Alliance Virtual on for size? We've got all of your Irvine meeting room and conference room needs covered. Need proof? <a href='http://www.alliancevirtualoffices.com/US/irvine-meeting-room/gallery'>Check out the photo gallery of our Irvine meeting and conference rooms.</a>".'<br><br>'."With a training rooms and seminar rooms of all shapes and sizes to choose from at each of our Irvine meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/irvine-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, check out all the <a href='http://www.alliancevirtualoffices.com/US/irvine-meeting-room/tour-information'>benefits of touring our Irvine facilities. In Orange County</a>, business meetings don't get any more convenient, flexible and fun than this!";
     	}
	elseif ( $full_city == 'San Francisco')
     	{
         	$seo_footer = "Talk about a San Francisco treat! The beautiful city of San Francisco has always been a hot destination, so why not make it the spot for your next big meeting, conference or training session? Alliance Virtual has got all of your meeting room and conference room needs covered, so <a href='http://www.alliancevirtualoffices.com/US/san-francisco-meeting-room/gallery'>check out the photo gallery of our San Francisco meeting and conference rooms</a> to see for yourself.".'<br><br>'."With a great array of impressive training rooms and seminar rooms to choose from at each of our San Francisco meeting room locations, you and your meeting delegates and conference attendees will be treated to the ultimate in <a href='http://www.alliancevirtualoffices.com/US/san-francisco-meeting-room/amenities'>meeting room support services and amenities</a> as you take care of business and get the job done. Plus, check out all the <a href='http://www.alliancevirtualoffices.com/US/san-francisco-meeting-room/tour-information'>benefits of touring our San Francisco facilities</a>. Treat yourself to a new kind of business meeting in the city by the bay!";
     	}
	else
	{
		$seo_footer = 'Alliance Virtual Offices is a great way to find ' . $full_city . ' meeting rooms, ' . $full_city . ' conference rooms, administrative services and other meeting room solutions.';
	}

	// special checks and changes for Mike 06-27-2012
	if( $full_city == 'Houston' )
	{
		$title = 'Meeting Rooms Houston | Locate Meeting and Conference Rooms in Houson TX';
		$keywords = 'meeting rooms houston, conference facility, conference venue, venue facilities, conference center, conference meeting room';
	}
	if( $full_city == 'Las Vegas' )
	{
		$title = 'Meeting Rooms Las Vegas | Locate Meeting and Conference Rooms in Las Vegas';
		$keywords = 'vegas meeting rooms, conference facility, conference venue, venue facilities, conference center, conference meeting room';
	}
	if( $full_city == 'Washington' )
	{
		$title = 'Meeting Rooms Washington DC | Locate Meeting and Conference Rooms in DC';
		$keywords = 'rent meeting rooms dc, conference facility, conference venue, venue facilities, conference center, conference meeting room';
	}

	// new vars for new design
	if( $country_name == 'UNITED STATES' )
	{
		$header_1 = $full_city . ', ' . $full_state;
		$header_2 = $full_city . ', ' . $full_state;
	}
	else
	{
		$header_1 = $full_city;
		$header_2 = $full_city; 
	}
}


echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>$title</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="css/jquery.bxslider.css" rel="stylesheet" />
<!-- Lightbox Javascript file -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="https://www.alliancevirtualoffices.com/js/jquery.autocomplete1.js"></script>
<!-- Lightbox CSS file -->
<link href="css/magnific-popup.css" rel="stylesheet" />
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
						if($(window).width() < 700) {
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
						if($(window).width() < 700) {
							this.st.focus = false;
						} else {
							this.st.focus = '#name';
						}
					}
				}
			});

			//end LightBox
    $("#suggest1").autocomplete('../js/lookup.php', {
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
             $("#avoS").attr("action", "../search2.php");
        }
        else{
            $("#avoS").attr("action", "../mr-search.php");
        } 
	
    });
        });
		
</script>
</head>
<body>
<div class="contentWrap">

<div class="headMenu">
        <div class="logo"><a href="http://www.alliancevirtualoffices.com"><img src="images/AVOlogo.png" width="279" height="55" border="0" alt="Alliance Virtual Offices"></a></div><!--/logo-->
        <a href="#" class="menuBtnLink"><div class="menuBtn"></div></a>
        <div class="menu">
        <div class="btnMenu"><a href="/virtual-office-locations.php">VIRTUAL OFFICES</a></div>
        <div class="btnMenu"><a href="/meeting-room-locations.php">MEETING ROOMS</a></div>
        <div class="btnMenu"><a href="/live-receptionist.php">LIVE RECEPTIONISTS</a></div>
        <div class="btnMenu"><a href="/login.php"><span class="light">Login</span></a></div>
        <div class="btnMenu"><a href="/contact.php"><span class="light">Contact</span></a></div>
        <div class="btnMenu"><a href="/cart.php"><span class="orange">CART</span><img src="images/cart-icon.png" class="cartIcon" border="0" width="23" height="23"></a></div>
        </div><!--/menu-->
</div><!--/headMenu-->

        
      

<div class="intWrap">
		<div class="searchInt">
        <form action="../search2.php" autocomplete="off" id="avoS" method="get">
	<input type="hidden" name="step" value="search" />
          <div class="searchWrap">
          <input type="text" class="SearchInputInt" id="suggest1" name="inputy" placeholder="Find Your Location Here" />
          </div>
          <div class="selectService">
              <select id="Services" name="avo1" class="avo1">
                    <option value="VO">Virtual Offices</option>
                    <option value="MR">Meeting Rooms</option>
              </select>   
          </div>
          <input type="hidden" name="source" value="bb">
          <button type="submit" class="searchBtnInt" id="searchBtn">
            <span class="mobileS">Search</span>
          </button>
        </form>
        </div><!--/searchInt-->

        <div class="breadcrumbs">
        $crumbs
        </div><!--/breadcrumbs-->

        <div class="resutsTop">
        <div class="ResutlsTitle">
        <h1>$h1</h1>
        <p class="gray2">$h2</p>
        </div><!--/ResutlsTitle-->

        <div class="toggleMap">
        <div class="toggleBtns">
            <!-- <a href="#" class="toggleActive"><div class="listViewBtn">LIST VIEW</div></a>
            <a href="#"><div class="mapViewBtn">MAP VIEW</div></a> -->
        </div><!--/toggleBtns-->
        </div><!--/toggleMap-->

        </div><!--/resutsTop-->
        <div class="resutsWrap">
        <div class="contactForm">
            <div class="contactPhones">
            <div class="centerForm">
                NORTH AMERICA:    +1 888.869.9494 <br/>
		INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhones-->
            <div class="cForm">
            <div class="centerForm">
            <h3>INQUIRE ABOUT<br/>
            <span class="bold">MEETING ROOMS</span></h3>
            <form name="signup" action="/sendcontact.php" method="post" onSubmit="return validate_contact_form ( );">
			
					<label for="name"><div class="label">Name:</div></label>
					<input name="name" id="name" type="text"><br/>
				
					<label for="email"><div class="label">Email:</div></label>
					<input name="email" id="email" type="text"><br/>
				
					<label for="company"><div class="label">Company:</div></label>
			  		<input name="company" id="company" type="text"><br/>
		
			  		<label for="label"><div class="label">Phone:</div></label>
			  		<input name="phone" id="label" type="text"><br/>
                    
					<label for="label"><div class="label"><a href="https://www.alliancevirtualoffices.com/privacy_policy.php" class="privateP">Privacy Policy</a></div></label>
					<label for="submit"></label>
					<button type="submit" id="submit">SEND</button> 		
				<script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
		                  var frmvalidator  = new Validator("signup");
		                  frmvalidator.addValidation("name","req","Please enter your Full Name");
		                  frmvalidator.addValidation("email","maxlen=50");
		                  frmvalidator.addValidation("email","req", "Please enter your Email Address");
		                  frmvalidator.addValidation("email","email");
		                
		                //]]></script>
                
                </form></fieldset>
                </div><!--/centerForm-->
            </div><!--/cForm-->
        </div><!--/contactForm-->
END;

	if( $city_level == 'yes' )
	{
		// Start making some variables
		$next_URL = '';
		$next_URL_MR = '';
		$buy_URL = '';

		$center_count = '0';
		$city_array = array();

		// Show the list of centers now
		foreach( $center_list as $center_ID )
		{
			get_center_info($center_ID);
			check_filter($center_ID);

			if( ($center_status == 'Y') && ($meeting_result != 'Remove') )
			{
				get_seo_city_sentence($center_ID);
				get_meeting_room_info($center_mr_list[0]);

				// Start making some variables
				$next_URL = '';
			
				// get pricing
				get_meeting_room_info($center_mr_list[0]);

				if( ($mr_rate == '0' ) || ($mr_rate == '') )
				{
					$start_pricing = '<span class="starting gray3">Call for pricing</span>';	
				}
				else
				{
					$start_pricing = '<span class="starting gray3">STARTING AT:</span> <span class="signo">$</span><span class="ammount">' . $mr_rate . '</span> <span class="usd">per hour</span>';
				}
				
				if( $center_country_abbrv != 'US' )
				{
					$cityStateZip = "$center_city, $center_country_full $center_postal_code";
				}
				else
				{
					$cityStateZip = "$center_city, $center_state_abbrv $center_postal_code";
				}
			
				// URL for next step
				$small_address = preg_replace('/^[^a-zA-Z]*/', '', $center_address_1);
				$formatted_street = name_into_url($small_address);
				$next_URL = $formatted_street . '-virtual-office-' . $center_ID;
				$next_URL_MR = $formatted_street . '-meeting-room-' . $center_ID;
				$buy_URL = 'http://www.alliancevirtualoffices.com/customize.php?cid=' . $center_ID . '&s=2';

				// set javascript array
				$meeting_room_names[$center_ID] = $mr_name;

				// put "no image" image if necessary
				if( $center_photos[0] == '' ) {
					$img_loc1 = 'http://www.abcn.com/images/photos/no_pic.gif';
					$img_seo_alt1 = '';
				}
				else {
					// get image seo info
					get_image_info($center_photos[0]);
					$img_loc1 = 'http://www.abcn.com/images/photos/' . $center_photos[0];
					$image_seo_alt1 = $image_seo_alt;
				}

				if( $center_photos[1] == '' ) {
					$img_loc2 = 'http://www.abcn.com/images/photos/no_pic.gif';
					$img_seo_alt2 = '';
				}
				else {
					// get image seo info
					get_image_info($center_photos[1]);
					$img_loc2 = 'http://www.abcn.com/images/photos/' . $center_photos[1];
					$image_seo_alt2 = $image_seo_alt;
				}

				if( $center_photos[2] == '' ) {
					$img_loc3 = 'http://www.abcn.com/images/photos/no_pic.gif';
					$img_seo_alt3 = '';
				}
				else {
					// get image seo info
					get_image_info($center_photos[2]);
					$img_loc3 = 'http://www.abcn.com/images/photos/' . $center_photos[2];
					$image_seo_alt3 = $image_seo_alt;
				}

				$h3 = $SEOCenterFound['H3'];

				// print out the content
				echo <<<END

        <div class="TheResult">
       	    <div class="ImageInfo">
                <div class="moreInfoBtn"><img src="images/moreInfo.png" border="0" /></div><!--/moreInfoBtn-->
                <div class="ImageInfo2">
                    <p>$final_sentence_1 $final_sentence_2 $final_sentence_3</p>
                </div><!--/ImageInfo2-->
            </div><!--/ImageInfo-->

            <div class="imageSlider">
                <ul class="bxslider">
                    <li><div class="img-wrapper"><img src="$img_loc1" alt="$image_seo_alt1" /></div></li>
                    <li><div class="img-wrapper"><img src="$img_loc2" alt="$image_seo_alt2" /></div></li>
                    <li><div class="img-wrapper"><img src="$img_loc3" alt="$image_seo_alt3" /></div></li>
                </ul>
            </div><!--/imageSlider-->

            <div class="ResultBtns"><a href="$next_URL_MR"><div class="btnMoreInfo" style="width: 100%;">MORE INFORMATION</div></a></div><!--/ResultBtns-->
            <div class="CenterPrice gray1">$start_pricing</div><!--/CenterPrice-->

            <div class="CenterImpInf">
                <h2>$h3</h2>
                <p>
                    <span class="rcName gray2">$center_building_name</span><br>
                    <span class="rcAddress gray3">$center_address_1 $center_address_2, $cityStateZip</span>
                </p>
            </div><!--/CenterImpInf-->
        </div><!--/TheResult-->
END;
			}
		}
	}

echo <<<END
        
        <div style="clear:both;"></div>
        </div><!--/resutsWrap-->
        
        <div class="spotlight">
        <h3>Virtual Office Location Spotlight: <span class="orange">$full_city</span></h3>
        <div class="spotlightsWrap">
            <div class="spotLeft">
                <h4>BUSINESS INFORMATION</h4>
                <p class="gray2">$seo_footer_business_info</p>
            </div><!--/spotLeft-->
            <div class="spotRight">
                <h4>GENERAL LOCATION INFORMATION</h4>
                <p class="gray2">$seo_footer_general_info</p>
            </div><!--/spotRight-->
        </div><!--/spotlightsWrap-->
        <div class="by">By: Monica Ochoa</div>
        </div><!--/spotlight-->

</div><!--/intWrap-->

<div class="TopCities">
<div class="Wrapper">
<h2 class="smallh2">TOP CITIES</h2>
<ul>
<a href="http://www.alliancevirtualoffices.com/US/los-angeles-virtual-office"><li>Los Angeles</li></a>
<a href="http://www.alliancevirtualoffices.com/US/new-york-virtual-office"><li>New York</li></a>
<a href="http://www.alliancevirtualoffices.com/US/chicago-virtual-office"><li>Chicago</li></a>
<a href="http://www.alliancevirtualoffices.com/US/dallas-virtual-office"><li>Dallas</li></a>
<a href="http://www.alliancevirtualoffices.com/US/atlanta-virtual-office"><li>Atlanta</li></a>
<a href="http://www.alliancevirtualoffices.com/US/houston-virtual-office"><li>Houston</li></a>
<a href="http://www.alliancevirtualoffices.com/GB/london-virtual-office"><li>London</li></a>
<a href="http://www.alliancevirtualoffices.com/CN/beijing-virtual-office"><li>Beijing</li></a>
<a href="http://www.alliancevirtualoffices.com/JP/tokyo-virtual-office"><li>Tokyo</li></a>
<a href="http://www.alliancevirtualoffices.com/AE/dubai-virtual-office"><li>Dubai</li></a>
<a href="http://www.alliancevirtualoffices.com/DE/berlin-virtual-office"><li>Berlin</li></a>
<a href="http://www.alliancevirtualoffices.com/NL/amsterdam-virtual-office"><li>Amsterdam</li></a>
<a href="http://www.alliancevirtualoffices.com/FR/paris-virtual-office"><li>Paris</li></a>
<a href="http://www.alliancevirtualoffices.com/US/las-vegas-virtual-office"><li>Las Vegas</li></a>
<a href="http://www.alliancevirtualoffices.com/US/washington-virtual-office"><li>Washington</li></a>
</ul>
</div><!--/Wrapper-->
</div><!--/TopCities-->

<div class="MoreResources">
<div class="Wrapper">
<h3>MORE RESOURCES</h3>
<ul>
<li><a href="http://www.abcn.com/">Serviced Office Space</a></li>
<li><a href="http://www.alliancevirtualoffices.com/about.php">About Alliance Virtual</a></li>
<li><a href="http://www.alliancevirtualoffices.com/faq.php">FAQ</a></li>
<li><a href="http://www.alliancevirtualoffices.com/blogs.php">Blogs</a></li>
</ul>
</div><!--/Wrapper-->
</div><!--/MoreResources-->
<div class="footer">
<div class="Wrapper">
<div class="FooterBtns"><div class="footerMob"><ul><a href="http://www.alliancevirtualoffices.com/terms-of-use.php"><li>Terms of Use</li></a><a href="http://www.alliancevirtualoffices.com/privacy_policy.php"><li>Privacy Policy</li></a></ul></div></div><!--/FooterBtns-->
<div class="rights">©2014 Alliance Virtual Offices. All rights reserved.</div>

<div class="social">
    <a href="https://twitter.com/alliancevirtual"><div class="tweeter"></div></a>
    <a href="https://www.facebook.com/alliancevirtual"><div class="facebook"></div></a>
    <a href="https://www.linkedin.com/company/1493610"><div class="linkedin"></div></a>
</div><!--/social-->

</div><!--/Wrapper-->
</div><!--/footer-->
</div><!--/contentWrap-->

<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
</body>
</html>
END;
?>