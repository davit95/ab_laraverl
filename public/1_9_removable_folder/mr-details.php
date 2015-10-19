<?php
include ("../connect_db.php");
include ("../siteFunctions.php");

$mr_is_present = 'yes';
$_REQUEST['cid'] = mysql_real_escape_string($_REQUEST['cid']);

// get center info based on passed in center ID
get_center_info($_REQUEST['cid']);

// get header image seo info
get_image_info($center_photos[0]);

// put "no image" image if necessary
if( $center_photos[0] == '' )
{
	$center_photos[0] = 'no_pic.gif';
}
	
// set up the image
$img_loc_6 = 'http://www.abcn.com/images/photos/' . $center_photos[0];

// Do some things to some vars
$address2 = '';
if( $center_address_2 != '' )
{
	$address2 = $center_address_2 . '<br />';
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

$header_2 =  "$center_city" . ', ' . "$center_state_abbrv";

// Populate all the SEO stuff
$SEOCenterCheck=mysql_query("SELECT * from Center_SEO_MR WHERE Center_ID='$_REQUEST[cid]'") or die("Error01r:" .mysql_error());
$SEOCenterFound = mysql_fetch_array($SEOCenterCheck);

if( $SEOCenterFound['Center_ID'] == '' )
{
	// get street name only
	$street_name = preg_replace('/^[^a-zA-Z]*/', '', $center_address_1);
	
	$title = $center_city . ' Virtual Offices and Conference Rooms on ' . $street_name;
	$description = 'Are you looking for a virtual office in ' . $center_city . '? Our on-demand offices on ' . $street_name . ' are perfect for meetings or temporary use offices. We also offer a range of administrative, phone and reception services!';
	$keywords = 'virtual office space in ' . $center_city . ' ' . $center_state_abbrv . ', executive suites in ' . $center_city . ' ' . $center_state_abbrv . ', meeting rooms, conference rooms, virtual receptionists, virtual assistants, virtual offices, administrative assistants';
	$h1 = $street_name . ' Meeting Room / ' . $center_city . ', ' . $center_state_abbrv;
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

// check to see if this center has any meeting rooms. 
get_meeting_room_info($center_mr_list[0]);

if( ($mr_rate == '0' ) || ($mr_rate == '') )
{
	$mr_is_present = 'no';	
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
	$end_point = "Meeting Room in $center_city";
}
else
{
	$end_point = $center_building_name;
}

if( $center_country_abbrv == 'US' )
{
	$state_insert = <<<END
<a href="http://www.alliancevirtualoffices.com/$url_state-meeting-rooms">$full_state</a> / 
END;
}

$crumbs = <<<END
<div id="breadcrumbs">
<a href="http://www.alliancevirtualoffices.com">Home</a> / <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php">Meeting Rooms</a> / <a href="http://www.alliancevirtualoffices.com/$url_country-meeting-rooms">$full_country</a> / $state_insert <a href="http://www.alliancevirtualoffices.com/$center_country_abbrv/$url_city-meeting-room">$full_city</a> / $end_point
</div>
END;

$hideShow = 'style="display: none;"';
$showHide = 'style="display: block;"';
$js_alert = '';

// parse submissions

if( $_REQUEST['step'] == 'set_date_time' ) {

	$hideShow = 'style="display: block;"';
	$showHide = 'style="display: none;"';
	getTimeDiff($_REQUEST['from_time_submit'], $_REQUEST['to_time_submit']);
	$hours = "$mrhours";

	if( $mrminutes == '30' ) {
		$math_hours = $hours . '.5';
	}
	else {
		$math_hours = $hours;
	}

	$form_extras .= <<<END
	<input type="hidden" name="date" value="$_REQUEST[date_submit]" />
	<input type="hidden" name="start_time" value="$_REQUEST[from_time_submit]" />
	<input type="hidden" name="end_time" value="$_REQUEST[to_time_submit]" />
	<input type="hidden" name="duration_hours" value="$mrhours" />
	<input type="hidden" name="duration_mins" value="$mrminutes" />
	<input type="hidden" name="step" value="next" />
END;

}
elseif($_REQUEST['step'] == 'next') {

	$_REQUEST['meeting_room_choice'] = mysql_real_escape_string($_REQUEST['meeting_room_choice']);
	$_REQUEST['date'] = mysql_real_escape_string($_REQUEST['date']);
	$_REQUEST['start_time'] = mysql_real_escape_string($_REQUEST['start_time']);
	$_REQUEST['end_time'] = mysql_real_escape_string($_REQUEST['end_time']);

	get_meeting_room_info($_REQUEST['meeting_room_choice']);
	get_meeting_room_options($_REQUEST['meeting_room_choice']);

	// check to see if it's enough hours to cover the minimum
	if( $_REQUEST['duration_hours'] < $mr_min_hours )
	{
		$error_48 = "<div style=\"color: red; padding: 5px; float: left; text-align: left; width: 400px;\">This center requires a minimum of $mr_min_hours hours. Please select another date/time.</div>";

		// make js
		$js_alert = 'onclick="alert(\'Please set a date and time range to view pricing\')"';
	}
	// if it is enough time
	else
	{
		$cartTime = time();
		if( $_REQUEST['duration_mins'] == '30' )
		{
			$end_mins = '5';
		}
		else
		{
			$end_mins = '0';
		}
	
		$insert_duration = $_REQUEST['duration_hours'] . '.' . $end_mins;
		$insert_total = '';
	
		// Add the meeting room to the shopping cart
		$AddCart=mysql_query("INSERT into Shopping_Cart values ('','$sessionID','$ipAddress','$cartTime','','MR','Pending')") or die("Error:" . mysql_error());
		$cartID = mysql_insert_id();
	
		$insert_total = $mr_rate * $insert_duration;
	
		// insert Meeting Room SC info
		$AddMR = mysql_query("INSERT into SC_MR values ('$cartID','$sessionID','$_REQUEST[meeting_room_choice]','$mr_name','$insert_duration','$mr_rate','$insert_total','$_REQUEST[date]','$_REQUEST[start_time]','$_REQUEST[end_time]')") or die("Error2: " . mysql_error());
	
		// get meeting room option info
		$option_query = mysql_query("SELECT * from Meeting_Room_Options where Meeting_Room_ID = '$_REQUEST[meeting_room_choice]'");
		$option_data = mysql_fetch_array($option_query);
	
		// now add the options for this meeting room
		$services_name = 'services_' . $_REQUEST['meeting_room_choice'];
		foreach ( $_REQUEST["$services_name"] as $service )
		{
			$service = mysql_real_escape_string($service);
			get_display_meeting_room_option($service);
			$duration_name = 'duration_' . $_REQUEST['meeting_room_choice'] . '_' . $service;
	
			$option_total = $option_data["$service"] * $_REQUEST["$duration_name"];
			$AddMROption = mysql_query("INSERT into SC_MR_Options values ('$cartID','$sessionID','$_REQUEST[meeting_room_choice]','$mr_option_name','$option_data[$service]','$_REQUEST[$duration_name]','$option_total')") or die("Error3: " . mysql_error());
			#echo "$service - $option_data[$service] - $_REQUEST[$duration_name] - $sessionID <br />";
		}
	
		header("Location: https://www.alliancevirtualoffices.com/customer-information3.php");
	}
}
else {
	// make js
	$js_alert = 'onclick="alert(\'Please set a date and time range to view pricing\')"';
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
<link href="css/flat/grey.css" rel="stylesheet">
<script src="js/icheck.js"></script>
<script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
<link rel="stylesheet" href="css/themes/classic.css">
<link rel="stylesheet" href="css/themes/classic.date.css">
<link rel="stylesheet" href="css/themes/classic.time.css">
<!--[if lt IE 9]>
    <script>document.createElement('section')</script>
    <style type="text/css">
        .holder {
            position: relative;
            z-index: 10000;
        }
        .datepicker {
            display: block;
        }
    </style>
<![endif]-->
<script>
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
			}
			else {
			   $(".dformright2").stick_in_parent()
			};;
			});
			
			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-grey',
				radioClass: 'iradio_flat-grey'
			  });
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

<script type="text/javascript">
function submitform()
{
    document.getElementById('mrform').submit();
}

function notSetAlert() {
    alert('Please set a date and time range to view pricing');
}

</script>
</head>
<body>
<div class="contentWrap">

<div class="headMenu">
        <div class="logo"><a href="#"><img src="images/AVOlogo.png" width="279" height="55" border="0" alt="Alliance Virtual Offices"></a></div><!--/logo-->
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
        <div class="dimg"><div class="img-wrapper2"><img src="$img_loc_6" alt="$image_seo_alt" /></div></div>
        <div class="dcInfo">
        <h2 class="gray1 cf2 bold">$h3</h2>
        <h3 class="gray3">$subheader</h3>
        <p class="gray2"><span class="bold">$center_building_name</span><br>$center_address_1<br />$address_2 $center_city, $center_state_abbrv  $center_postal_code</p>
        </div><!--/dcInfo-->
        </div><!--/detailTopLeft-->
        <div class="detailTopRight">
        <div class="dmap"><div id="map_canvas" style="width:100%; height:100%"></div></div>
        </div><!--/detailTopRight-->
        <div class="clear"></div>
        </div><!--/detailsTopWrap-->
        
        <div class="detailsTopWrap3">
        <div class="mTopLeft2"><p class="mediumBold"><span class="blue">CONFIGURE YOUR MEETING ROOM OPTIONS</span> </p></div>
        <div class="mformright2"><p class=" mediumBold"><span class="gray2">FOR MORE INFORMATION PLEASE CONTACT US:</span> </p></div>
        </div>
        <div class="detailsTopWrap2 changeMtop">
        <div class="dformright2 radiusTop">
        <div class="contactPhones2">
            <div class="centerForm">
            NORTH AMERICA:    +1 888.869.9494<br>
	    INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhones2-->
            <div class="cForm2">
            <div class="centerForm2">
            <h3>INQUIRE ABOUT <span class="bold">MEETING ROOMS</span></h3>
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
            
        </div><!--/dformright2-->
        
        <div class="wrapMRdetails">
        
        <div class="descTopLeft2">
        <div class="wrapDescrip">
        <div class="number nOne"></div><h3 class="gray2">SET YOUR DATE AND TIME</h3>
        <div id="root-picker-outlet" style="margin-left:45px;"></div>
        <div id="root-picker-outlet2" style="margin-left:45px;"></div>
		
        <form method="post">
	<input type="hidden" name="cid" value="$_REQUEST[cid]" />
	<input type="hidden" name="step" value="set_date_time" />
        $error_48
            <fieldset class="dateAndTime">
            	<div class="yourDateT" $hideShow>
                    Your meeting room date is: <span class="mediumBold">$_REQUEST[date]</span><br>
                    From: <span class="mediumBold">$_REQUEST[from_time]</span> to: <span class="mediumBold">$_REQUEST[to_time]</span><br>
                    <a href="#" style="text-decoration:none;"><div class="otherTime lightBtn">CHANGE DATE</div></a>
                </div><!--/showHide-->

            	<div $showHide>
                    <label for="date"><div class="label">Set Date:</div></label><input id="input_01" class="datepicker" name="date" type="text" placeholder="Please select a date" required><br>
                    <label for="fromTime"><div class="label">Set Your Start Time:</div></label><input type="text" name="from_time" class="timepicker" placeholder="Please select a start time" id="input_from" required><br>
                    <label for="toTime"><div class="label">Set End Start Time:</div></label><input type="text" name="to_time" class="timepicker" placeholder="Please select an end time" id="input_to" required><br>		
                    <div class="label"></div><input class="aquaBtn sbmitDate" type="submit" width="170" value="SET DATE AND TIME">
            	</div>
            </fieldset>
         
        </form>

        </div><!--/wrapDescrip-->
        </div><!--/descTopLeft-->
        
        <div class="descTopLeft2" >
        <div class="wrapDescrip">
        <div class="number nTwo"></div><h3 class="gray2">PLEASE SELECT A MEETING ROOM AND OPTIONS</h3>
        <form action="" id="mrForm" name="mr-main-form" method="post">
	$form_extras
	

					<table id="hor-minimalist-b" summary="Meeting Room Summary" class="MRoptionT gray2">
						<tr>
							<th scope="col" style="">&nbsp;</th>
							<th scope="col" style=" text-align: left;">MEETING ROOM</th>
							<th scope="col" style="text-align: center;">CAPACITY</th>
							<th scope="col" style=" text-align: center;">RATE</th>
							<th scope="col" style="text-align: center;">TOTAL</th>
						</tr>
END;

			$meeting_room_names = array();
			$meeting_room_count = '0';
			foreach( $center_mr_list as $meeting_room_id )
			{
				$mr_query = mysql_query("SELECT * from Meeting_Rooms where Meeting_Room_ID = '$meeting_room_id'");
				$mr_data = mysql_fetch_array($mr_query);

				$num_meeting_rooms++;
				$mr_options_query = mysql_query("SELECT * from Meeting_Room_Options where Meeting_Room_ID = '$mr_data[Meeting_Room_ID]'");
				$mr_options_data = mysql_fetch_array($mr_options_query);

				$first_amount = $math_hours * $mr_data['Hourly_Rate'];
				$first_amount = round($first_amount);

				// set javascript array
				$meeting_room_names[$meeting_room_count] = $mr_data['Name'];
				$meeting_room_count++;
	
echo <<<END
						<tr class="MRline totalCost Mroom" Mroom="$mr_data[Meeting_Room_ID]" cost="$first_amount" bgcolor="#F3F4F4" >
							<td style="text-align: center; min-width:30px;"><input name="meeting_room_choice" type="radio" value="$mr_data[Meeting_Room_ID]" class="Mroom SelectMR" $js_alert /></td>
							<td class="theMR">$mr_data[Name]</td>
							<td style="text-align: center;">up to $mr_data[Capacity]</td>
							<td class="thePrice" style="text-align: center;"><span class="convert">$$mr_data[Hourly_Rate]</span>/hr</td>
							<td class="total bold" style="text-align: center;">$$first_amount</td>
						</tr>
                       
END;

					$included = array();
					$paid = array();
					$video_conf_extras = '';
					$parking_extras = '';
					// check to see what's included. If it doesn't have a price it's considered included

					// make the extras for some
					if( $mr_options_data['Parking_Description'] != '' )
					{
						$parking_extras = ' (' . $mr_options_data['Parking_Description'] . ')';
					}
					if( $mr_options_data['Video_Equipment'] != '' )
					{
						$video_conf_extras = ' (' . $mr_options_data['Video_Equipment'] . ')';
					}


					// Now populate the paid/included arrays
					$phone_rate_pieces = explode('||', $mr_options_data['Phone_Rate']);
					if( $phone_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $phone_rate_pieces[0] < '1' || $phone_rate_pieces[0] == '' )
					{
						array_push($included, 'Phone Access');
					}
					else
					{	
						array_push($paid, 'Phone Access|Phone_Rate');
					}

					$network_rate_pieces = explode('||', $mr_options_data['Network_Rate']);
					if( $network_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $network_rate_pieces[0] < '1' || $network_rate_pieces[0] == '' )
					{
						array_push($included, 'Network Connection');
					}
					else
					{	
						array_push($paid, 'Network Connection|Network_Rate');
					}

					$whiteboard_rate_pieces = explode('||', $mr_options_data['Whiteboard_Rate']);
					if( $whiteboard_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $whiteboard_rate_pieces[0] < '1' || $whiteboard_rate_pieces[0] == '' )
					{
						array_push($included, 'Whiteboard');
					}
					else
					{	
						array_push($paid, 'Whiteboard|Whiteboard_Rate');
					}

					$wireless_rate_pieces = explode('||', $mr_options_data['Wireless_Rate']);
					if( $wireless_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $wireless_rate_pieces[0] < '1' || $wireless_rate_pieces[0] == '' )
					{
						array_push($included, 'WiFi');
					}
					else
					{	
						array_push($paid, 'WiFi|Wireless_Rate');
					}

					$tvdvdplayer_rate_pieces = explode('||', $mr_options_data['Tvdvdplayer_Rate']);
					if( $tvdvdplayer_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $tvdvdplayer_rate_pieces[0] < '1' || $tvdvdplayer_rate_pieces[0] == '' )
					{
						array_push($included, 'TV / DVD Player');
					}
					else
					{	
						array_push($paid, 'TV / DVD Player|Tvdvdplayer_Rate');
					}

					$projector_rate_pieces = explode('||', $mr_options_data['Projector_Rate']);
					if( $projector_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $projector_rate_pieces[0] < '1' || $projector_rate_pieces[0] == '' )
					{
						array_push($included, 'Projector');
					}
					else
					{	
						array_push($paid, 'Projector|Projector_Rate');
					}

					$videoconferencing_rate_pieces = explode('||', $mr_options_data['Videoconferencing_Rate']);
					if( $videoconferencing_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $videoconferencing_rate_pieces[0] < '1' || $videoconferencing_rate_pieces[0] == '' )
					{
						array_push($included, 'Video Conferencing' . $video_conf_extras);
					}
					else
					{	
						array_push($paid, 'Video Conferencing' . $video_conf_extras . '|Videoconferencing_Rate');
					}

					$admin_services_rate_pieces = explode('||', $mr_options_data['Admin_Services_Rate']);
					if( $admin_services_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $admin_services_rate_pieces[0] < '1' || $admin_services_rate_pieces[0] == '' )
					{
						array_push($included, 'Admin Services');
					}
					else
					{	
						array_push($paid, 'Admin Services|Admin_Services_Rate');
					}

					$parking_rate_pieces = explode('||', $mr_options_data['Parking_Rate']);
					if( $parking_rate_pieces[0] == 'NA' )
					{
						1;
					}
					elseif( $parking_rate_pieces[0] < '1' || $parking_rate_pieces[0] == '' )
					{
						array_push($included, 'Parking' . $parking_extras);
					}
					else
					{	
						array_push($paid, 'Parking' . $parking_extras . '|Parking_Rate');
					}

					if( $mr_options_data['Bridge_Connection_Available'] == 'yes' )
					{
						array_push($included, 'Bridge Connection Available');
					}

					if( $mr_options_data[Catering] == 'yes' )
					{
						array_push($included, 'Catering Available');
					}

					// make room description if needed
					$room_description = '';
					if( $mr_options_data['Room_Description'] != '' )
					{
						$room_description =<<<END
						<h3>Room Description</h3>
						<div class="mr-description">$mr_options_data[Room_Description]</div>				
END;
					}

echo <<<END
						<tr class="service" Mroom="$mr_data[Meeting_Room_ID]" style="" cost="0">
							<td colspan="5" class="no-border">
$room_description
						<br><h2>INCLUDED AMENITIES</h2>
						<div class="mr-incl-amenities-box">
						<ul>
END;

					foreach ( $included as $amenity)
					{
						echo <<<END
							<li>$amenity</li>

END;
					}

echo <<<END
						</ul>
						</div>
						<div class="clear"></div>
							</td>
						</tr>
END;

					// now show the paid offerings
					if( count($paid) < 1 ) {
						$add_amen_header = '';
					}
					else {
						echo <<<END
						<tr class="service" Mroom="$mr_data[Meeting_Room_ID]" style="" cost="0">
							<td colspan="5" class="no-border">
						<h2>ADDITIONAL AMENITIES AVAILABLE</h2>
							</td>
						</tr>

END;
					}

/*
					foreach ( $paid as $paidOne )
					{
						// split the name and the var name
						$pieces = explode('|', $paidOne);
						$rate_pieces = explode('||', $mr_options_data[$pieces[1]]);
						$rate = $rate_pieces[0];
						$rate_type = $rate_pieces[1];
						
						if( $rate_type == 'H' )
						{
echo <<<END
							<tr class="service" Mroom="$mr_data[Meeting_Room_ID]" style="" rate="$rate" cost="$rate">
								<td class="no-border"><input type="checkbox" name="services_$mr_data[Meeting_Room_ID][]" class="service checkExtra" value="$pieces[1]" /></td>
								<td class="no-border">Admin Services</td>
								
								<td class="no-border"><span class="convert">$40/hr</td>
								<td class="no-border">
									<select name="duration_$mr_data[Meeting_Room_ID]_$pieces[1]" class="hours duration checkExtra">
									  $selected_hours
									  <option value="1">1 hour</option>
									  <option value="2">2 hours</option>
									  <option value="3">3 hours</option>
									  <option value="4">4 hours</option>
									  <option value="5">5 hours</option>
									  <option value="6">6 hours</option>
									  <option value="7">7 hours</option>
									  <option value="8">8 hours</option>
									</select>
								</td>
							</tr>
END;
						}
						elseif( $rate_type == 'T' )
						{
echo <<<END
							<tr class="service" Mroom="$mr_data[Meeting_Room_ID]" style="" rate="$rate" cost="$rate">
								<td class="no-border"><input type="checkbox" name="services_$mr_data[Meeting_Room_ID][]" class="service checkExtra" value="$pieces[1]" /></td>
								<td class="no-border">Other Service</td>
								
								<td class="no-border"><span class="convert">$80</span></td>
								<td class="no-border">
									<select name="duration_$mr_data[Meeting_Room_ID]_$pieces[1]" class="totl duration hidden">
									  <option value="1" disabled>Total</option>
									</select>
								</td>
							</tr>
END;
						}
						else
						{
echo <<<END
							<tr class="service" Mroom="$mr_data[Meeting_Room_ID]" style="" rate="$rate" cost="$rate">
								<td class="no-border"><input type="checkbox" name="services_$mr_data[Meeting_Room_ID][]" class="service checkExtra" value="$pieces[1]" /></td>
								<td class="no-border">Phone Access</td>
								
								<td class="no-border"><span class="convert">$70</span>/hr</td>
								<td class="no-border">
									<select name="duration_$mr_data[Meeting_Room_ID]_$pieces[1]" class="hours duration checkExtra">
									  $selected_hours
									  <option value="1">1 hour</option>
									  <option value="2">2 hours</option>
									  <option value="3">3 hours</option>
									  <option value="4">4 hours</option>
									  <option value="5">5 hours</option>
									  <option value="6">6 hours</option>
									  <option value="7">7 hours</option>
									  <option value="8">8 hours</option>
									</select>
								</td>
							</tr>
END;
						}
					}
*/

			}

echo <<<END
					</table>
        </div><!--/wrapDescrip-->
        </div><!--/descTopLeft-->
        
        <div class="descTopLeft2 noMbottom" $hideShow>
        <div class="wrapDescrip">
        <div class="number nThree"></div><h3 class="gray2">SUBMIT</h3>
        <div class="wrapSN3">
        <input type="submit" class="submitBook aquaBtn" value="SUBMIT BOOKING"> <!-- <div class="or">OR</div> -->
        
        <div class="bookOwrap">
        <!-- <input type="button" class="otherBook lightBtn" value="BOOK ANOTHER MEETING ROOM" onclick="submitform()"> -->
        <div class="OtherRadios gray3">

        <!-- <input type="radio" name="MrLocation" value="same" checked><label for="same"> Same location</label> &nbsp; &nbsp; 
        <input type="radio" name="MrLocation" value="different"> <label for="diff"> Different location</label> -->
        </form>

        </div><!--/OtherRadios-->
        </div><!--/bookOwrap-->
        
        </div><!--/wrapSN3-->
        </div><!--/wrapDescrip-->
        </div><!--/descTopLeft-->
        
        </div><!--/wrapMRdetails-->
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
        
        
        </div><!--/resutsTop-->
        
END;

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

    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
    <script src="js/picker.time.js"></script>
    <script src="js/legacy.js"></script>

    <script type="text/javascript">

        $( '.datepicker' ).pickadate({
	    format: 'mm/dd/yyyy',
            formatSubmit: 'mm/dd/yyyy',
            min: true,
            container: '#root-picker-outlet',
            // editable: true,
            closeOnSelect: true,	
            closeOnClear: false,
			disable: [
				1, 7
			],
			// Work-around for some mobile browsers clipping off the picker.
    	    onOpen: function() { $('pre').css('overflow', 'hidden') },
    	    onClose: function() { $('pre').css('overflow', '') }
        })
        
	$('.timepicker').pickatime({
	    min: [8,0],
	    max: [17,0],
	    container: '#root-picker-outlet2',
	    formatSubmit: 'HH:i',
	    onClose: function() {
    	        $('.timepicker').blur();
	    }
	})
		 
       var from_$input = $('#input_from').pickatime(),
       from_picker = from_$input.pickatime('picker')

       var to_$input = $('#input_to').pickatime({
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

       to_picker = to_$input.pickatime('picker')


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

if( date.length == 0){
    }else{
		$('.showHide').show();
		$('.hideShow').hide();
	}
	
	$( ".otherTime" ).click(function() {
			  $('.showHide').hide();
		$('.hideShow').show();
			});
		
    </script>
    
    
</body>
</html>
END;

?>