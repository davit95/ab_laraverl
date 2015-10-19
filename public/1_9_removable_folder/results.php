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
	$full_city_name = '';
	$full_name = $_GET['ss'];
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
		check_filter($Sresults['Center_ID']);
		if( ($filter_result != 'Remove') && ($active_result != 'Remove') ) 
		{
			array_push($center_list, $Sresults['Center_ID']);
			if( $city_name != $Sresults['URL_City'] )
			{
				$city_list[$Sresults['Full_City']] = $Sresults['URL_City'];
				$city_name = $Sresults['URL_City'];
				$full_city_name = $Sresults['Full_City'];
			}
			$start_full_country = $Sresults['Full_Country'];
			$full_state = $Sresults['Full_State'];
			$url_state = $Sresults['URL_State'];
			$city_header = $Sresults['Full_State'] . ' Virtual Office Solutions | Virtual Receptionists';
		}
	}

	// See if there were any centers from that search
	$number_of_centers = count($center_list);

	// Get country abbrv for the URL later on
	$queryC = mysql_query("SELECT Code FROM Country WHERE Name = '$start_full_country'");
	$Cresult = mysql_fetch_row($queryC);
	$immed_country_abbrv = $Cresult[0];

	// Do all the SEO stuff for State Level
	$title = $full_state . ' Virtual Office Space | ' . $full_state . ' Virtual Office Services';
	$description = 'Are you looking for virtual office space or services in ' . $full_state . '? We have nice range of PBX solutions, virtual admins and receptionists!';
	$keywords = $full_state . ', virtual office space in ' . $full_state . ', serviced offices, virtual office, meeting rooms, conference rooms, virtual solutions';
	$h1 = $city_header;
	$h2 = 'On-Demand Offices and Live Receptionists';
	$seo_footer = 'Alliance Virtual Offices is a great way to find ' . $full_state . ' virtual offices, ' . $full_state . ' meeting rooms, virtual receptionists and other virtual office solutions.';

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
			check_filter($CNresults['Center_ID']);
			if( ($filter_result != 'Remove') && ($active_result != 'Remove') ) 
			{ 
				array_push($center_list, $CNresults['Center_ID']);
				if( $city_name != $CNresults['URL_City'] )
				{
					$city_list[$CNresults['Full_City']] = $CNresults['URL_City'];
					$city_name = $CNresults['URL_City'];
					$full_city_name = $CNresults['Full_City'];
				}
				$start_full_country = ucwords(strtolower($CNresults['Full_Country']));
			}
		}
		// Get country abbrv for the URL later on
		$queryCN = mysql_query("SELECT Code FROM Country WHERE Name = '$start_full_country'");
		$CNresult = mysql_fetch_row($queryCN);
		$immed_country_abbrv = $CNresult[0];
		$city_header = $start_full_country . ' Virtual Offices | Virtual Receptionists';

		// Do all the SEO stuff for Country Level
		$title = 'Virtual Offices in ' . $start_full_country . ' | ' . $start_full_country . ' Meeting Rooms';
		$description = 'Alliance offers the best portfolio of virtual office options available in ' . $start_full_country . '. Turnkey virtual office services at affordable rates.';
		$keywords = $start_full_country . ', virtual office space in ' . $start_full_country . ', virtual receptionists, virtual assitants, serviced offices, virtual office, meeting rooms, virtual offices, conference rooms, pbx';
		$h1 = $city_header;
		$h2 = 'On-demand Offices and Live Receptionists';
		$seo_footer = '';

		// all the stuff for the new design
		$header_1 = $start_full_country;
		$header_2 = $start_full_country;

		// make the breadcrumbs, baby
		$formatted_country = ucwords(strtolower($start_full_country));
		$crumbs = <<<END
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/virtual-office-locations.php">Virtual Offices</a> / $formatted_country
END;
	}
	else
	{
		$state_level = 'yes';
		// make the state breadcrumbs
		$crumbs = <<<END
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/virtual-office-locations.php">Virtual Offices</a> / <a href="http://www.alliancevirtualoffices.com/united-states-virtual-offices">United States</a> / $full_state
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
	if( $_GET['ct'] == 'houston' )
	{
		// Laura, add your code below
		$custom_js = <<<END

<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6021420631657', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=6021420631657&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1' /></noscript>


END;
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
	$center_list_filtered = array();
	$center_list_empty = array();
	$city_list = array();
	$city_name = '';
	$full_name = $_GET['ct'];
	$l_price = '';
	$url_state = '';
	$url_country = '';
	$full_country = '';

	// Get list of centers
	$CityCheck = mysql_query("SELECT Center_ID, URL_City, Full_City, Full_Country, Full_State, URL_State, URL_Country FROM Center_Extras WHERE URL_City = '$full_name' AND Full_Country='$country_name'");
	while( $CityResults = mysql_fetch_array($CityCheck) )
	{
		check_filter($CityResults['Center_ID']);
		if( ($filter_result != 'Remove') && ($active_result != 'Remove') ) 
		{
			get_center_info($CityResults['Center_ID']);
				
			// get pricing
			if( ($center_platinum_price == '0') || ($center_platinum_price == '') )
			{
				$l_price = $center_platinum_plus_price;
			}
			else
			{
				$l_price = $center_platinum_price;
			}
			
			// put empty ones into another array to push to the end later
			if( $l_price == '0' || $l_price == '' )
			{
				$center_list_empty[$CityResults['Center_ID']] = $l_price;
			}
			else
			{
				$center_list_filtered[$CityResults['Center_ID']] = $l_price;
			}
			array_push($center_list, $CityResults['Center_ID']);
			$full_city = $CityResults['Full_City'];
			$full_state = $CityResults['Full_State'];
			$url_state = $CityResults['URL_State'];
			$url_country = $CityResults['URL_Country'];
			$full_country = ucwords(strtolower($country_name));
		}
	}

	// now sort the filtered list
	asort($center_list_filtered, SORT_NUMERIC);
	$center_list = array();
	$center_list = array_keys($center_list_filtered);

	$center_list2 = array();
	$center_list2 = array_keys($center_list_empty);

	$center_list = array_merge($center_list, $center_list2);

	// Do all the SEO stuff for City Level
	$title = $full_city . ' Virtual Office Space, Live Answering and Advanced PBX';
	$description = 'Check out our ' . $full_city . ' virtual office location options. We also have virtual receptionist and PBX automated phone systems services available.';
	$keywords = $full_city . ' ' . $full_city . ' virtual office space, virtual receptionist ' . $full_city . ' ' . $full_state . ', meeting rooms in ' . $full_city . ' ' . $full_state . ',  virtual offices, conference rooms ' . $full_city . ' ' . $full_state . ',meeting rooms, virtual offices, receptionists, assistants';

	if( $_GET['ccn'] != 'US' )
	{
		$add_on = ', ' . $_GET['ccn'];
	}
	else
	{
		$add_on = ', ' . $center_state_abbrv;
	}
	$h1 = 'Virtual Offices in ' . $full_city . $add_on . ' | ' . $full_city . ' Virtual Office Services';
	$h2 = 'Prestigious Addresses and On-demand Office Space';

	// make breadcrumbs
	if( $_REQUEST['ccn'] == 'US' )
	{
		$state_insert = <<<END
<a href="http://www.alliancevirtualoffices.com/$url_state-virtual-offices">$full_state</a> / 
END;
	}

	$crumbs = <<<END
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/virtual-office-locations.php">Virtual Offices</a> / <a href="http://www.alliancevirtualoffices.com/$url_country-virtual-offices">$full_country</a> / $state_insert $full_city
END;

	// special checks and changes for Mike 06-27-2012
	if( $full_city == 'Houston' )
	{
		$title = 'Virtual Office Space | Locate Virtual Offices in Houston';
		$keywords = 'virtual receptionist, virtual assistant, houston virtual office';
	}
	if( $full_city == 'Las Vegas' )
	{
		$title = 'Virtual Office Space | Locate Virtual Offices in Las Vegas';
		$keywords = 'virtual receptionist, virtual assistant, las vegas virtual office';
	}
	if( $full_city == 'Washington' )
	{
		$title = 'Virtual Office Space | Locate Virtual Offices in Washington DC';
		$keywords = 'virtual receptionist, virtual assistant, washington virtual office, dc virtual office';
	}
	if( $full_city == 'Amsterdam' )
	{
		$title = 'Virtual office Amsterdam, Live Answering and Advanced PBX';
		$keywords = 'virtual office Amsterdam, postadres Amsterdam, virtueel kantoor, virtual offices, virtual receptionist, virtual office space';
		$description = 'Virtual Office? Check out our Amsterdam virtual office options. We also have virtual receptionist & PBX automated phone systems services available.';
	}
	if( $full_city == 'Berlin' )
	{
		$title = 'Virtual Office Berlin: Live Answering and Advanced PBX';
		$keywords = 'virtual office berlin, Virtuelles büro Berlin, virtual offices, live answering, virtual receptionist, meeting rooms, receptionist, virtual office space';
		$description = 'Virtual office in Berlin. Check out our Berlin virtual office location options. We provide virtual receptionists & PBX automated phone systems.';
	}

	//now to look if there's any information regarding the city in the database
	$queryCityInfo = mysql_query("SELECT * FROM cityInformationAVONew WHERE name = '" . strtolower($full_city) . "'");
	$tempCount = mysql_num_rows($queryCityInfo);
	if ($tempCount >= 1)
	{
		$cityDescription  = mysql_fetch_object($queryCityInfo);
		$seo_footer_business_info = $cityDescription->business_info;
		$seo_footer_general_info = $cityDescription->general_info;
		$seo_footer = "<h3>Virtual Office Location Spotlight: " . $full_city . "</h3>" . $cityDescription->description;
	}
	else
	{
		$seo_footer = '<p style="margin:0;">Alliance Virtual Offices is a great way to find ' . $full_city . ' virtual offices, ' . $full_city . ' meeting rooms, virtual receptionists and other virtual office solutions.</p>';
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

// get the spotlight center
$sc_query = mysql_query("SELECT * from Spotlight_Center_VO where URL_Location = '$full_name'");
$sc_data = mysql_fetch_array($sc_query);

if( $sc_data['Center_ID'] == '' )
{
	$spotlight_center = array_rand($center_list,1);
	$spotlight_center = $center_list["$spotlight_center"];
}
else
{
	$spotlight_center = $sc_data['Center_ID'];
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
<!-- Lightbox CSS file -->
<link href="css/magnific-popup.css" rel="stylesheet" />
<script type="text/javascript" src="https://www.alliancevirtualoffices.com/js/jquery.autocomplete1.js"></script>
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
            <span class="bold">VIRTUAL OFFICES</span></h3>
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
		$buy_URL = '';

		$center_count = '0';
		$city_array = array();

		// Show the list of centers now
		foreach( $center_list as $center_ID )
		{
			check_filter($center_ID);
			if( ($center_status == 'Y') && ($filter_result != 'Remove') )
			{
				// get seo info
				$SEOCenterCheck=mysql_query("SELECT * from Center_SEO WHERE Center_ID='$center_ID'") or die("Error01r:" .mysql_error());
				$SEOCenterFound = mysql_fetch_array($SEOCenterCheck);

				get_center_info($center_ID);
				get_seo_city_sentence($center_ID);

				// Start making some variables
				$next_URL = '';
				$buy_URL = '';
			
				// get pricing
				if( ($center_platinum_price == '0') || ($center_platinum_price == '') )
				{
					if( ($center_platinum_plus_price == '0') || ($center_platinum_plus_price == '') )
					{
						$start_pricing = '<span class="starting gray3">CALL FOR PRICING</span>';
					}
					else
					{
						$start_pricing = '<span class="starting gray3">STARTING AT:</span> <span class="signo">$</span><span class="ammount">' . $center_platinum_plus_price . '</span> <span class="usd">USD</span>';
					}
				}
				else
				{
					$start_pricing = '<span class="starting gray3">STARTING AT:</span> <span class="signo">$</span><span class="ammount">' . $center_platinum_price . '</span> <span class="usd">USD</span>';
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
		
				// Shorten description if necessary
				$limit = '350';
		   		if (strlen($center_description) > $limit)
				{
		      			$center_description = substr($center_description, 0, strrpos(substr($center_description, 0, $limit), ' ')) . '...';
				}

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

            <div class="ResultBtns"><a class="popup-with-form" href="pricing-grids.php?id=$center_ID"><div class="btnPlans">SEE PLANS</div></a><a href="$next_URL"><div class="btnMoreInfo">MORE INFORMATION</div></a></div><!--/ResultBtns-->
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