<?php
include ("../siteFunctions.php");
$cartID = $_COOKIE['CINFO'];

$_REQUEST['p'] = mysql_real_escape_string($_REQUEST['p']);
// process the requests and forward them to the chooser script
if( $_REQUEST['s'] == '2' )
{
	$_REQUEST['p'] = mysql_real_escape_string($_REQUEST['p']);

	if( $cartID == '' )
	{
		$cartID = rand(10000000000,99999999999);
		makeCookie($cartID);
	}

	$GetDupe=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die(mysql_error());
	$DupeInfo = mysql_fetch_array($GetDupe);

	if( $DupeInfo['Cart_ID'] == '' )
	{
		$AddProdsToCart=mysql_query("INSERT into SC_CP_Options values ('$cartID','$sessionID','$_REQUEST[p]')") or die("Error1: $cartID" . mysql_error());
	}
	else
	{
		$cartID = rand(10000000000,99999999999);
		makeCookie($cartID);
		$AddProdsToCart = mysql_query("INSERT INTO SC_CP_Options values('$cartID', '$sessionID', '$_REQUEST[p]')") or die("Error2: " . mysql_error());		
	}

	// check to see which order this came in from
	if( $_SESSION['telOrder'] == '2' )
	{
		header("Location: telephony-chooser2.php");
	}
	else
	{
		$_SESSION['telOrder'] = '2';
		header("Location: telephony-chooser2.php");
	}
}

echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Virtual Office, Virtual Office Solutions from Alliance Virtual Offices</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
<link rel="stylesheet" type="text/css" href="css/themes/tooltipster-light.css" />
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
<script>
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
                content: $('<span><span class="mediumBold">Add local, toll free and most iNum numbers for $6 monthly.</span><br> 718 and 917 area codes are $45 monthly.<br> 212 area codes are $75 monthly. </span>')
            });
			$('.tooltip2').tooltipster({
				animation: 'fade',   
				theme: 'tooltipster-light',
				trigger: 'hover',
                content: $('<span><span class="mediumBold">One extension is unlimited.</span> Addtional unlimited extensions are $25 each. Pay per minute extensions are free when forwarded to another number, charged at 5 cents per minute. Softphone or device extensions are $6 monthly. </span>')
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

<div class="contactMobile2">Call: +1 888.869.9494</div>


<div class="allFeatures">
<h1 class="gray2">LIVE RECEPTIONISTS PLANS & FEATURES</h1>
	<div class="allFtContWrap">
      <div class="LRtableWrap2" style="margin-top:30px;">
      <div class="LRtableWrap3">  
      <table class="newLRGrid">

      <tr>
        <th class="bgDGray tleftG">&nbsp;</th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 50</span></span></span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 100</span></span></span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 200</span></span></span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<br>Live Receptionist 300</span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<br>Live Receptionist 500</span></th>
        <th class="bgDGray noborder"><span class="mediumBold smallLine">VIRTUAL OFFICE<br><span class="smallLine">PHONE UNLIMITED</span></span></th>
     </tr>

      <tr>
        <td class="firstFT">Live Answering Minutes</td>
        <td class="bold">50</td>
        <td class="bold">100</td>
        <td class="bold">200</td>
        <td class="bold">300</td>
        <td class="bold">500</td>
        <td class="bold">0</td>
      </tr>

      <tr>
        <td class="firstFT tleftG">Local and Long Distance Minutes <img src="images/info.png" class="tooltip2"/></td>
        <td >Unlimited</td>
        <td >Unlimited</td>
        <td >Unlimited</td>
        <td >Unlimited</td>
        <td >Unlimited</td>
        <td >Unlimited</td>
      </tr>

      <tr>
        <td class="firstFT">Included Phone Numbers <img src="images/info.png" class="tooltip"/></td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
      </tr>

      <tr>
        <td class="firstFT">Personalized, Live Answering 9am-8pm EST</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
       <td ></td>
      </tr>

      <tr>
        <td class="firstFT">Call Screening / Attended Transfer</td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td></td>
      </tr>

      <tr>
        <td class=" firstFT">Voicemail, Email Delivery of   Voicemail</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /> </td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>

       <tr>
        <td class="tleftG2 ">Dial-by-Name Directory, Auto Attendant</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      
      <tr>
        <td class="firstFT">Custom Recordings,   Messages</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Full Online Control   Panel</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>    
      <tr>
        <td class="firstFT">Address Book</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">After Hours Greetings</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Analog Phone Adapter - Add-On</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Area Code &amp; Local Phone Selection</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Block Surcharged Calls</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Business Phones - Desk Phones</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Call Blocking</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Call Forwarding</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Call Handling Rules</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Call Logs</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Call Recording</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Call Screening</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT"> Call Transfer</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Call Voice Tagging</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Call Waiting</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Caller ID</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Caller ID Block</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Caller ID Routing</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Calling Cards</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Chatcalls</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Click to Call Buttons</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Conferencing</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Custom Menu Audio</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Dial-by-Name Directory</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Do Not Disturb</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">E911 / 911 Dialing</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Extensions</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Fax out - Internet Fax</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Global Numbers</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Greetings</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">HD Voice (Hi Definition)</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Hold Music - Bring Your Own</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Hold Music - Pre Recorded</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">How to Receive an Internet Fax</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">In-Call Features</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">International Call Blocking</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">International Calling</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Internet Voicemail Services</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Internet Voicemail Services: Email &amp; Internet </td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Voicemail Delivery</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">iNUM - Global Numbers</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Local Number Porting</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Menus (IVR)</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Mobile Office</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Mobile VoIP</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Online Account Management</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Outbound Calls</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Alliance Mobility - Avoid Roaming Charges</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT"> Professional Recording Services</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Queues</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Schedules</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Second Line</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">SMS Send &amp; Receive</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Special Numbers (411...)</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Support 24x7</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Text to Greeting</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Text Voicemail (Transcription)</td>
        
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Three Way Calling</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Toll Free Phone Numbers</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Vanity Toll-Free Phone Numbers</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Virtual Phone Attendant</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT ">Voicemail</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>
        <td class="firstFT">Voicemail &amp; Fax Notifications</td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
        <td ><img src="images/check2.png" width="15" height="15" border="0" /></td>
      </tr>
      <tr>

        <td class=" firstFT"><b>Monthly Cost</b></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$95</span></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$145</span></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$225</span></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$325</span></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$475</span></td>
        <td class=" borderBottom"><span class="melon bold bigPrice">$40</span></td>
      </tr>

      <tr>
        <td class="firstFT noBorder"><a href="all-features.php" class="aqua mediumBold">View All Features &amp; Options</a></td>
        <td class="noBorder"><a href="?s=2&amp;p=402" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
        <td class="noBorder"><a href="?s=2&amp;p=403" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
        <td class="noBorder"><a href="?s=2&amp;p=404" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
        <td class="noBorder"><a href="?s=2&amp;p=406" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
        <td class="noBorder"><a href="?s=2&amp;p=407" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
        <td class="noBorder"><a href="?s=2&p=401" class="noStyle"><div class="aquaBtn">SELECT</div></a></td>
      </tr>

    </table>
    </div><!--/LRtableWrap3->
    </div><!--/LRtableWrap2-->
        
       </div><!--/allFtContWrap-->
</div><!--/allFeatures-->

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

</body>
</html>
END;

?>