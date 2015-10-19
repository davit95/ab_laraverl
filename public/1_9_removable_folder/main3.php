<?php
include ("../connect_db.php");
include ("../siteFunctions.php");

if( $_REQUEST['n'] == '1' )
{
	$cartTime = time();
	$_REQUEST['cid'] = mysql_real_escape_string($_REQUEST['cid']);
	
	// vo plan id
	$_REQUEST['p'] = mysql_real_escape_string($_REQUEST['p']);

	// vo plan term
	$_REQUEST['t'] = mysql_real_escape_string($_REQUEST['t']);

	// phone
	$_REQUEST['b'] = mysql_real_escape_string($_REQUEST['b']);

	// insert new items into new shopping cart
	$AddCart=mysql_query("INSERT into Shopping_Cart values ('','$sessionID','$ipAddress','$cartTime','','$_REQUEST[cid]','Pending')") or die("Error:" . mysql_error());
	$cartID = mysql_insert_id();

	$AddProdsToCart=mysql_query("INSERT into SC_VO_Options values ('$cartID','$sessionID','$_REQUEST[p]','$_REQUEST[t]')") or die("Error 103:" . mysql_error());

	// add a temp mail forwarding entry
	$AddProdsToCart=mysql_query("INSERT into SC_MF_Options values ('$cartID','$sessionID','20','2','','','','','','','','','')") or die("Error j7:" . mysql_error());

	// if a bundle piece is added then add the correct phone
	if( $_REQUEST['b'] == '402' && ($_REQUEST['p'] == '103' || $_REQUEST['p'] == '105') ) {
		$AddProdsToCart = mysql_query("INSERT INTO SC_CP_Options values('$cartID', '$sessionID', '$_REQUEST[b]')") or die("Error2: " . mysql_error());
		$AddProdsToCart = mysql_query("INSERT INTO SC_CP_Options values('$cartID', '$sessionID', '801')") or die("Error2: " . mysql_error());
		$_SESSION['cpt'] = $cartID;	
	}

	makeCookie($cartID);
	
	header("Location: http://www.alliancevirtualoffices.com/customize.php");
}

// custom js code for Mike 11-11-2010
if( $_REQUEST['cid'] == '136' || $_REQUEST['cid'] == '2638' )
{
	$custom_js = '<script type="text/javascript" src="http://dnn506yrbagrg.cloudfront.net/pages/scripts/0011/2521.js"> </script>';
}

// escape input
$_REQUEST['cid'] = mysql_real_escape_string($_REQUEST['cid']);

// get center info based on passed in center ID
get_center_info($_REQUEST['cid']);

// Do some things to some vars
$address_2 = '';
if( $center_address_2 != '' )
{
	$address_2 = $center_address_2 . '<br />';
}

// Get phone number based on region
$MainTel=SetRegionPhone($center_country_abbrv);

// make the address header
$address_header0 = preg_replace('/^[^a-zA-Z]*/', '', $center_address_1);
$address_header = $address_header0 . ' Virtual Office';
if( $center_country_abbrv != 'US' )
{
	$address_header = 'Virtual Office Information';
}

// Check to see if this center has pricing
$empty = 'no';
if( (($center_platinum_price == '0') || ($center_platinum_price == '')) && (($center_platinum_plus_price == '0') || ($center_platinum_plus_price == '')) ) 
{
	$empty = 'yes';
}
else
{
	$empty = 'no';
}

// Populate all the SEO stuff
$SEOCenterCheck=mysql_query("SELECT * from Center_SEO WHERE Center_ID='$_REQUEST[cid]'") or die("Error01r:" .mysql_error());
$SEOCenterFound = mysql_fetch_array($SEOCenterCheck);

if( $SEOCenterFound['Center_ID'] == '' )
{
	// get street name only
	$street_name = preg_replace('/^[^a-zA-Z]*/', '', $center_address_1);
	
	$title = $center_city . ' Virtual Offices and Conference Rooms on ' . $street_name;
	$description = 'Are you looking for a virtual office in ' . $center_city . '? Our on-demand offices on ' . $street_name . ' are perfect for meetings or temporary use offices. We also offer a range of administrative, phone and reception services!';
	$keywords = 'virtual office space in ' . $center_city . ' ' . $center_state_abbrv . ', executive suites in ' . $center_city . ' ' . $center_state_abbrv . ', meeting rooms, conference rooms, virtual receptionists, virtual assistants, virtual offices, administrative assistants';
	$h1 = 'Virtual Offices in ' . $center_city . '<span class="blue">/</span> <span class="medium">' . $street_name . '</span>';
	$h2 = 'Live Answering & Advanced Telephony';
	$seo_footer = 'Alliance Virtual Offices is a great way to find ' . $center_city . ' virtual offices, ' . $center_city . ' meeting rooms, virtual receptionists and other virtual office solutions.';
}
else
{
	$title = $SEOCenterFound['Meta_Title'];
	$description = $SEOCenterFound['Meta_Description'];
	$keywords = $SEOCenterFound['Meta_Keywords'];
	$h1 = $SEOCenterFound['H1'];
	$h2 = $SEOCenterFound['H2'];
	$h3 = $SEOCenterFound['H3'];
	$subheader = $SEOCenterFound['Subhead'];
	$seo_footer = $SEOCenterFound['SEO_Footer'];
}

// make breadcrumbs
$crumb_q = mysql_query("SELECT * from Center_Extras where Center_ID = '$_REQUEST[cid]'");
$crumb_d = mysql_fetch_array($crumb_q);

$url_state = $crumb_d['URL_State'];
$url_country = $crumb_d['URL_Country'];
$full_country = ucwords(strtolower($crumb_d['Full_Country']));
$url_city = $crumb_d['URL_City'];
$full_city = $crumb_d['Full_City'];
$url_state = $crumb_d['URL_State'];
$full_state = $crumb_d['Full_State'];

if( $center_building_name == '' )
{
	$end_point = "Virtual Office in $center_city";
}
else
{
	$end_point = $center_building_name;
}
if( $center_country_abbrv == 'US' )
{
	$state_insert = <<<END
<a href="http://www.alliancevirtualoffices.com/$url_state-virtual-offices">$full_state</a> / 
END;
}

$crumbs = <<<END
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/virtual-office-locations.php">Virtual Offices</a> / <a href="http://www.alliancevirtualoffices.com/$url_country-virtual-offices">$full_country</a> / $state_insert <a href="http://www.alliancevirtualoffices.com/$center_country_abbrv/$url_city-virtual-office">$full_city</a> / $end_point
END;

$main_image = 'http://www.abcn.com/images/photos/' . $center_photos[0];
get_image_info($center_photos[0]);

// create correct address format depending on if the Center is US or not
if( $center_country_abbrv == 'US' )
{
	$cityStateZip = <<<END
		<span class="city" itemprop="addressLocality">$center_city, </span>
		<span class="city" itemprop="addressRegion">$center_state_abbrv </span>
		<span class="city" itemprop="postalCode">$center_postal_code </span>
END;
}
else
{
	$cityStateZip = <<<END
		<span class="city" itemprop="addressLocality">$center_city, </span>
		<span class="city" itemprop="addressRegion">$center_country_full </span>
		<span class="city" itemprop="postalCode">$center_postal_code </span>
END;
}

echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>$title</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- bxSlider Javascript file -->
<script src="js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="css/jquery.bxslider.css" rel="stylesheet" />
<!-- Lightbox Javascript file -->
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- Lightbox CSS file -->
<link href="css/magnific-popup.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
<link rel="stylesheet" type="text/css" href="css/themes/tooltipster-light.css" />
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="js/jquery.tosrus.min.all.js"></script>
<script type="text/javascript" src="js/hammer.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.tosrus.all.css" />
<script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
<script>
function done() {
	$( ".aPlanBottom2" ).show();
	$( ".extras2" ).show();
	$( ".expl2" ).show();
	$(".dformright").trigger("sticky_kit:detach");
	$(".dformright").stick_in_parent()
	
	}
        jQuery(document).ready(function($) {
			
			$( ".menuBtnLink" ).click(function() {
			  $( ".menu" ).slideToggle( "slow", function() {
				// Animation complete.
			  });
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
			   caption    : {
				  add        : true
			   }
			});

			if ($(window).width() > 750) {
			   $(".dformright").stick_in_parent()
			}
			else {
			   
			};
			
			$( window ).resize(function() {
			  if ($(window).width() < 750) {
			   $(".dformright").trigger("sticky_kit:detach");
			}
			else {
			   $(".dformright").stick_in_parent()
			};
			});
			$('.tooltip').tooltipster('update', '<span> Entry level plan for startups looking for a way to have the lowest cost presence in a desirable market. <br><span class="bold">Receive mail anywhere; redirect it anywhere.</span><br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span>');
			$('.tooltip2').tooltipster('update', '<span> Entry level plan <span class="bold">for startups and small business</span> who want a full virtual presence. Great for those looking for those opening a remote office who need a full local presence. <br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
			$('.tooltip3').tooltipster('update', '<span> <span class="bold">One of our most popular services.</span> Best for startups and growing businesses who expect to meet with clients and colleagues on a regular basis in a stylish business setting.<br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
			$('.tooltip4').tooltipster('update', '<span> <span class="bold">Our most popular service.</span> Best for startups and growing businesses who want a full complement of virtual services and who expect to meet with clients and colleagues on a regular basis in a stylish business setting. <br><a class="update" href="javascript:done()"><div class="showAllFplans">Show and compare plan features</div></a> </span></span>');
        });
		
		
    </script>
    
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng($center_latitude,$center_longitude);
    var myOptions = {
      zoom: 15,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var iconBase = 'images/';
    var marker = new google.maps.Marker({
        position: myLatlng, 
        map: map,
		icon: iconBase + 'marker.png',
        title:"$center_address_1"
    });   
  }
  google.maps.event.addDomListener(window, 'load', initialize);
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
		
        <div class="breadcrumbs dtails">
        $crumbs
        </div><!--/breadcrumbs-->
        
        <div class="resutsTop">
        <div class="ResutlsTitle">
        <h1>$h1</h1>
        <p class="gray2">$h2</p>
        </div><!--/ResutlsTitle-->
        <div style="clear:both"></div>
        
        <div class="detailsTopWrap">
        <div class="detailTopLeft">
        <div class="dimg"><div class="img-wrapper2"><img src="$main_image" alt="$image_seo_alt" /></div></div>
        <div class="dcInfo">
        <h2 class="gray1 cf2 bold">$h3</h2>
        <h3 class="gray3">$subheader</h3>
        <p class="gray2"><span class="bold">$center_building_name</span><br>$center_address_1<br />$address_2 $cityStateZip</p>
        </div><!--/dcInfo-->
        </div><!--/detailTopLeft-->
        <div class="detailTopRight">
        <div class="dmap"><div id="map_canvas" style="width:100%; height:100%"></div></div>
        </div><!--/detailTopRight-->
        <div class="clear"></div>
        </div><!--/detailsTopWrap-->
END;

	// pricing grid
	check_filter($_REQUEST['cid']);
	$platinum_found_here = 'no';
	$platinum_plus_found_here = 'no';
	$platinum_buy_link = '';
	$platinum_with_buy_link = '';
	$platinum_plus_buy_link = '';
	$platinum_plus_with_buy_link = '';
	$center_platinum_price_disp = '<span class="price">Not Available</span>';
	$center_platinum_with_price_disp = '<span class="price">Not Available</span>';
	$center_platinum_plus_price_disp = '<span class="price">Not Available</span>';
	$center_platinum_plus_with_price_disp = '<span class="price">Not Available</span>';

	// if center has active pricing and isn't filtered show the grid
	if( $empty == 'no' && $filter_result != 'Remove' && $active_result != 'Remove' )
	{
		if( $center_platinum_price > '0' )
		{
			$platinum_found_here = 'yes';
			$full_price = $center_platinum_price + 95;
			$pack_price = $center_platinum_price + 85;

			$platinum_buy_link = '<a href="?n=1&p=103&cid=' . $_REQUEST['cid'] . '"><div class="btnSelectP2">SELECT PLAN</div></a>';
			$platinum_with_buy_link = '<a href="?n=1&p=103&b=402&cid=' . $_REQUEST['cid'] . '"><div class="btnSelectP2 orb">SELECT PLAN</div></a>';

			$center_platinum_price_disp = '<span class="price">$' . $center_platinum_price . '</span><span class="pMonth"> /MONTH</span>';
			$center_platinum_with_price_disp = '<span class="nonPrice orange cf1 bold">&nbsp;$' . $full_price . '</span>&nbsp;&nbsp; <span class="price">$' . $pack_price . '</span><span class="pMonth"> /MONTH</span><br><span class="save">You save $10</span>';
		}

		if( $center_platinum_plus_price > '0' )
		{
			$platinum_plus_found_here = 'yes';
			$full_price = $center_platinum_plus_price + 95;
			$pack_price = $center_platinum_plus_price + 85;

			$platinum_plus_buy_link = '<a href="?n=1&p=105&cid=' . $_REQUEST['cid'] . '"><div class="btnSelectP2">SELECT PLAN</div></a>';
			$platinum_plus_with_buy_link = '<a href="?n=1&p=105&b=402&cid=' . $_REQUEST['cid'] . '"><div class="btnSelectP2 orb">SELECT PLAN</div></a>';

			$center_platinum_plus_price_disp = '<span class="price">$' . $center_platinum_plus_price . '</span><span class="pMonth"> /MONTH</span>';
			$center_platinum_plus_with_price_disp = '<span class="nonPrice orange cf1 bold">&nbsp;$' . $full_price . '</span>&nbsp;&nbsp; <span class="price">$' . $pack_price . '</span><span class="pMonth"> /MONTH</span><br><span class="save">You save $10</span>';
		}
	
        echo <<<END
        <div class="dPlansWrap">
        <div class="dPlansAllWrap">
        <div class="dPlansAll">

	    <!-- PLATINUM -->
            <div class="aPlan2">
                <div class="aPlanTop2 bordeRight">
                <div class="wrapPP">
                <div id="startPlan" class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM <img src="images/info.png" class="tooltip"/></h3></div>
                <div class="secondline gray3">$center_platinum_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH bordeBottom bordeRight hide">
                <ul class="check gray3">
                <li>Business Address</li>
                <li>Mail Receipt</li>
                <li>Mail Forwarding *</li>
                <li>Personal Mail Box</li>
                </ul>
                </div><!--/aPlanBottom2-->
            </div><!--/aPlan-->
            
	    <!-- PLATINUM WITH LR -->
            <div class="aPlan2 goright mobilePlan2">
                <div class="aPlanTop2 bordeRight">
                <div class="wrapPP">
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM<a href="#" title=""> <img src="images/info.png" class="tooltip2"/></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="secondline gray3">$center_platinum_with_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_with_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH bordeRight hide">
                <ul class="check gray2 bold">
                <li><span class="cf1">EVERYTHING IN PLATINUM</span></li>
                </ul>
                <ul class="plus">
                <li>PLUS</li>
                </ul>
                <ul class="check gray3">
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
                </div><!--/aPlanBottom2-->
            </div><!--/aPlan-->
            

	    <!-- PLATINUM PLUS -->
            <div class="aPlan2 mobilePlan">
                <div class="aPlanTop2 bordeRight">
                <div class="wrapPP">
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM PLUS<a href="#" title=""> <img src="images/info.png" class="tooltip3"/></a></h3></div>
                <div class="secondline gray3">$center_platinum_plus_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_plus_buy_link
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
                </div><!--/aPlanBottom2-->
            </div><!--/aPlan-->
            
	    <!-- PLATINUM PLUS WITH LR -->
            <div class="aPlan2 goright mobilePlan">
                <div class="aPlanTop2">
                <div class="wrapPP">
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM PLUS<a href="#" title=""> <img src="images/info.png" class="tooltip4"/></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="secondline gray3">$center_platinum_plus_with_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_plus_with_buy_link
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
                </div><!--/aPlanBottom2-->
            </div><!--/aPlan-->
            
        </div><!--/dPlansAll-->
        </div><!--/dPlansAllWrap-->
        </div><!--/dPlansWrap-->
         <div class="extras2 gray3 hide"><p><span class="bold">ALL PLANS MAY OFFER WITH ADDITIONAL CHARGES:</span> Main Building Directory Listing (where available) *   -  Professional Admin Services *   -  Professional Business Support Center *</p></div>
        <div class="expl2 gray3 hide">* Extra fees may apply</div>
        
        <div class="detailsTopWrap2">
        <div class="dformright radiusTop">
        <div class="contactPhones2">
            <div class="centerForm">
            NORTH AMERICA:    +1 888.869.9494<br>
			INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhones2-->
            <div class="cForm2">
            <div class="centerForm2">
            <h3>INQUIRE ABOUT 
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
					<button type="submit" id="submit2">SEND</button> 		
				<script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                //You should create the validator only after the definition of the HTML form
                  var frmvalidator  = new Validator("signup");
                  frmvalidator.addValidation("name","req","Please enter your Full Name");
                  frmvalidator.addValidation("email","maxlen=50");
                  frmvalidator.addValidation("email","req", "Please enter your Email Address");
                  frmvalidator.addValidation("email","email");
                
                //]]></script>
                
                </form></fieldset>
                </div><!--/centerForm-->
            </div><!--/cForm2-->
            
        </div><!--/dformright-->
        
        <div class="descTopLeft">
        <div class="wrapDescrip">
        <h3 class="gray2">VIRTUAL OFFICE DESCRIPTION</h3>
        <p class="gray3">$center_seo_description</p>
        <br><h3>PHOTOS</h3>
        <div class="littleImgs">
        <div id="links">
END;

	foreach( $center_photos as $photo )
	{
		if( $photo != '' )
		{
			$img_loc = 'http://www.abcn.com/images/photos/' . $photo;

			// get seo info for each photo
			get_image_info($photo);
			echo <<<END
           <a href="$img_loc" title="$image_seo_caption"><div class="centerimg"><div class="img-wrapper3"><img src="$img_loc" alt=""/></div></div></a>
END;
		}

	}

echo <<<END
        </div>
        
        </div><!--/littleImgs-->
        </div><!--/wrapDescrip-->
        </div><!--/descTopLeft-->
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
        
  
        </div><!--/resutsTop-->
END;
	}

	// do the surrounding area stuff
	if( $center_country_abbrv == 'US' )
	{
		$found_centers = '0';
		echo <<<END
        	<div class="nearWrap">
        	<h3 class="gray2">NEARBY CENTERS</h3>
END;

		require_once('../zipcode.class.php');
		$z = new zipcode_class;
		$zips = $z->get_zips_in_range("$center_postal_code", 50, _ZIPS_SORT_BY_DISTANCE_ASC, true);

   		foreach ($zips as $key => $value) 
		{
			if( $found_centers <= '11' )
			{
				// do a lookup for this zip
				$proximity_query = mysql_query("SELECT * from Center where PostalCode = '$key' and ActiveFlag = 'Y' and Country = '$center_country_abbrv'");
				$proximity_center = mysql_fetch_array($proximity_query);
				if( $proximity_center['CenterID'] )
				{
					$found_centers++;
					get_center_info($proximity_center['CenterID']);
					makeCorrectURL($center_address_1, $center_city, $center_country_abbrv, $proximity_center['CenterID']);

					if( $center_detail_url != 'error' && $_REQUEST['cid'] != $proximity_center['CenterID'] )
					{
						$img_loc_8 = 'http://www.abcn.com/images/photos/' . $center_photos[0];

						get_image_info($center_photos[0]);

						if( $center_building_name == '' )
						{
							$center_building_name = $center_city . ' Office Space';
							 }

							 echo <<<END
						         <a href="$center_detail_url"><div class="cNear">
						         <div class="nearImg"><div class="img-wrapper4"><img src="$img_loc_8" alt="$image_seo_alt" /></div></div>
						         <div class="nearInfo gray2 medium">$center_building_name<span class="gray3 light"> <br />($value miles away)</span></div><!--/cNear-->
						         </div><!--/cNear--></a>
END;
						}
						else
						{
							$found_centers--;
						}
					}
				}
   			}

				echo <<<END
       				 </div><!--/nearWrap-->
END;
		}

echo <<<END
</div><!--/intWrap-->


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
<div class="rights">©2015 Alliance Virtual Offices. All rights reserved.</div>

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