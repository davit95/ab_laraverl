<?php
require_once("xajax.inc.php");
include ("../connect_db.php");
$cartID = mysql_real_escape_string($_COOKIE['CINFO']);
include ("../siteFunctions.php");

// set up ajax calls
$xajax = new xajax();
$xajax->registerFunction("getPrefix");
$xajax->registerFunction("showNumbers");
$xajax->registerFunction("getTollFree");

$newContent = '';

// check if it's a LR plan, if it is then we will display a message
$prodCheck = mysql_query("SELECT * from SC_CP_Options where Session_ID = '$sessionID' and Cart_ID = '$cartID'") or die("ERROR: " . mysql_error());
$prodData = mysql_fetch_array($prodCheck);
$callPlan = $prodData['Com_Plan'];

// set up the functions to be called
function getPrefix($countrycode, $callPlan)
{
	$errors = '';
	if( $countrycode == '1' )
	{
		// Get list of prefixes (area codes) for a country
		$none = '';
		$newContent = <<<EOF
            <div id="areaCode" >
            <p><span class="mediumBold">Please select the area code you'd like:</span></p>
		<select name="" class="TollFPhone changeMtop" onChange="xajax_showNumbers(this.value,$countrycode);">
			<option value="">Please Select</option>
EOF;
		$PrefixHandle=mysql_query("SELECT * from tel_Prefixes where Country_Code='$countrycode' order by Prefix");
		while($PrefixData=mysql_fetch_array($PrefixHandle)) 
		{
			$newContent = $newContent . <<<EOF
			<option value="$PrefixData[Prefix]">$PrefixData[Prefix]</option>

EOF;
		}
	
		$newContent = $newContent . '</select></center>';
		mysql_free_result($PrefixHandle);
	}
	else
	{
		if( ($callPlan == '402') || ($callPlan == '403') || ($callPlan == '404') || ($callPlan == '406') || ($callPlan == '407') ) {
			$newContent = <<<EOF
				<div style="margin: 10px 0 5px 0;"><strong>Not Available</strong></div>
				This location is not compatible with the package you've selected. Please choose another location.
EOF;
		}
		else {
			$counter = '0';
			$post_array = array 
			(
				"action"		=>	"getPhoneNumberInventory",
				"username" 		=>	"abcn",
				"password"		=>	'Jn5Gzc4%',
				"clTRID"		=>	"12345678",
				"countryCode"		=>	"$countrycode"
			);
			reset ($post_array);
		
		
			foreach ($post_array as $key => $val) 
			{
				$data .= $key."=".urlencode ($val)."&"; // setup the data properly for a POST action
			}
		
			$ch = curl_init ();
		
			curl_setopt ($ch, CURLOPT_URL, "https://control.phone.com/special/xmlapi");
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		
			$response = curl_exec ($ch);
		
			curl_close ($ch);
		
			#echo "$response";
			$human = array();
			$printer_friendly_number = '';
		
			$newContent = <<<EOF
            		<div id="numSelect" >
            		<p><span class="mediumBold">Please select a number:</span></p>
				<select name="full_number" class="TollFPhone changeMtop">
					<option value="">Please Select</option>
EOF;
	
			// get the info we want
		  	preg_match_all( "/\<phoneNumber\>(.*?)\<\/phoneNumber\>/s", $response, $numberblocks );
		  	foreach( $numberblocks[1] as $block )
		  	{
				$counter++;
				#echo "$block -<br />";
		  		preg_match_all( "/\<humanReadable\>(.*?)\<\/humanReadable\>/", $block, $human );
				$plain_number = preg_replace('/[^0-9]/', '', $human[0][0]);
				$plain_number = $countrycode . $plain_number;
				$non_formatted_number = $countrycode . $plain_number;
				$comp = $human[0][0];
				$print_friendly_number = str_replace('<humanReadable>', "", "$comp");
				$print_friendly_number = str_replace('</humanReadable>', "", "$print_friendly_number");
		
				$newContent = $newContent . <<<EOF
				<option value="$plain_number">$print_friendly_number</option>

EOF;
	
				$human = array();
				$printer_friendly_number = '';
		  	}
	
			$newContent = $newContent . '</select></div>';
	
			if( $counter < '1' )
			{
				$errors = 'No Phone Numbers are available for your selected Country.<br />Please select another Country.';
				$newContent = $newContent . '<br /><br />';
			}
			else
			{
				$newContent = $newContent . '<br /><br /><input value=" CONTINUE TO CHECK OUT" class="aquaBtn changeMtop continueBTN" type="submit" >';
			}
		}
	}

	$objResponse = new xajaxResponse();
	$objResponse->addAssign("Prefix","innerHTML", $newContent);
	$objResponse->addAssign("Numbers","innerHTML", $none);
	$objResponse->addAssign("Errors","innerHTML",$errors);
    	return $objResponse;
}

function showNumbers($prefix,$countrycode)
{
	// Show the numbers associated with the prefix

	$pattern = $countrycode . $prefix . '*******';

	$post_array = array 
	(
		"action"		=>	"getPhoneNumberInventory",
		"username" 		=>	"abcn",
		"password"		=>	'Jn5Gzc4%',
		"clTRID"		=>	"12345678",
		"countryCode"		=>	"$countrycode",
		"pattern"		=>	"$pattern"
	);
	reset ($post_array);


	foreach ($post_array as $key => $val) 
	{
		$data .= $key."=".urlencode ($val)."&"; // setup the data properly for a POST action
	}

	$ch = curl_init ();

	curl_setopt ($ch, CURLOPT_URL, "https://control.phone.com/special/xmlapi");
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec ($ch);

	curl_close ($ch);

	#echo "$response";
	$human = array();
	$printer_friendly_number = '';

	$newContent = <<<EOF
            <div id="numSelect" >
            <p><span class="mediumBold">Please select a number:</span></p>
		<select name="full_number" class="TollFPhone changeMtop">
			<option value="">Please Select</option>
EOF;

	// get the info we want
  	preg_match_all( "/\<phoneNumber\>(.*?)\<\/phoneNumber\>/s", $response, $numberblocks );
  	foreach( $numberblocks[1] as $block )
  	{
		#echo "$block -<br />";
  		preg_match_all( "/\<humanReadable\>(.*?)\<\/humanReadable\>/", $block, $human );
		$plain_number = preg_replace('/[^0-9]/', '', $human[0][0]);
		$plain_number = $countrycode . $plain_number;
		$non_formatted_number = $countrycode . $plain_number;
		$comp = $human[0][0];
		$print_friendly_number = str_replace('<humanReadable>', "", "$comp");
		$print_friendly_number = str_replace('</humanReadable>', "", "$print_friendly_number");

		$newContent = $newContent . <<<EOF
			<option value="$plain_number">$print_friendly_number</option>

EOF;

		$human = array();
		$printer_friendly_number = '';
  	}
	$newContent = $newContent . '</select></div>';

	// add submit button
	$newContent = $newContent . '<br /><br /><input value=" CONTINUE TO CHECK OUT" class="aquaBtn changeMtop continueBTN" type="submit" >'; 

	$objResponse = new xajaxResponse();
	#$objResponse->addAssign("Prefix","innerHTML", $none);
	$objResponse->addAssign("Numbers","innerHTML", $newContent);
	$objResponse->addAssign("Errors","innerHTML",$errors);
    	return $objResponse;
}

function getTollFree($prefix)
{
	// Show the numbers associated with the prefix

	$pattern = '1' . $prefix . '*******';

	$post_array = array 
	(
		"action"		=>	"getPhoneNumberInventory",
		"username" 		=>	"abcn",
		"password"		=>	'Jn5Gzc4%',
		"clTRID"		=>	"12345678",
		"type"			=>	"TF",
		"pattern"		=>	"$pattern",
		"countryCode"		=>	"1",
		"quantity"		=>	"30"
	);
	reset ($post_array);


	foreach ($post_array as $key => $val) 
	{
		$data .= $key."=".urlencode ($val)."&"; // setup the data properly for a POST action
	}

	$ch = curl_init ();

	curl_setopt ($ch, CURLOPT_URL, "https://control.phone.com/special/xmlapi");
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec ($ch);

	curl_close ($ch);

	#echo "$response";
	$human = array();
	$printer_friendly_number = '';

	$newContent = <<<EOF
		<div id="numSelect" >
		<p><span class="mediumBold">Please select a number:</span></p>
		<select name="full_number" class="TollFPhone changeMtop">
			<option value="">Please Select</option>
EOF;

	// get the info we want
  	preg_match_all( "/\<phoneNumber\>(.*?)\<\/phoneNumber\>/s", $response, $numberblocks );
  	foreach( $numberblocks[1] as $block )
  	{
		#echo "$block -<br />";
  		preg_match_all( "/\<humanReadable\>(.*?)\<\/humanReadable\>/", $block, $human );
		$plain_number = preg_replace('/[^0-9]/', '', $human[0][0]);
		$plain_number = $countrycode . $plain_number;
		$non_formatted_number = $countrycode . $plain_number;
		$comp = $human[0][0];
		$print_friendly_number = str_replace('<humanReadable>', "", "$comp");
		$print_friendly_number = str_replace('</humanReadable>', "", "$print_friendly_number");

		$newContent = $newContent . <<<EOF
			<option value="1$plain_number">$print_friendly_number</option>

EOF;

		$human = array();
		$printer_friendly_number = '';
  	}
	$newContent = $newContent . '</select></div>';

	// add submit button
	$newContent = $newContent . '<br /><br /><input value=" CONTINUE TO CHECK OUT" class="aquaBtn changeMtop continueBTN" type="submit" >'; 

	$objResponse = new xajaxResponse();
	$objResponse->addAssign("Prefix","innerHTML", $none);
	$objResponse->addAssign("Numbers","innerHTML", $newContent);
	$objResponse->addAssign("Errors","innerHTML",$errors);
    	return $objResponse;
}
$xajax->processRequests();

// do the processing and forward to the next page
if( $_REQUEST['step'] == '2' )
{
	$_POST['full_number'] = mysql_real_escape_string($_POST['full_number']);

	if( $cartID == '' )
	{
		$cartID = rand(10000000000,99999999999);
		makeCookie($cartID);
	}

	$GetDupe=mysql_query("SELECT * from SC_TEL_Options where Session_ID='$sessionID'") or die(mysql_error());
	$DupeInfo = mysql_fetch_array($GetDupe);

	if( $DupeInfo['Cart_ID'] == '' )
	{
		$AddProdsToCart=mysql_query("INSERT into SC_TEL_Options values ('$cartID','$sessionID','$_POST[full_number]')") or die("Error22:" . mysql_error());
	}
	else
	{
		$AddProdsToCart = mysql_query("INSERT INTO SC_TEL_Options values('$cartID','$sessionID','$_POST[full_number]')") or die("Error3: " . mysql_error());
	}

	//-- COMPLETE THIS ITEM IN THE CART
	mysql_query("UPDATE Shopping_Cart SET Status = 'Complete' WHERE Session_ID = '$sessionID' and Cart_ID = '$cartID'") or die("SC Update Error");
	
	// check to see which order this came in from
	if( $_SESSION['telOrder'] == '2' )
	{
		header("Location: cart.php");
	}
	else
	{
		$_SESSION['telOrder'] = '2';
		header("Location: cart.php");
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

	$('#tollFreeSelected').on('ifChecked', function(event){
	  if($('#tollFreeSelected').is(':checked')){
			$('#TollFree').show();
			$('#CountrySelect').hide();
		}else{
		}
	});
	$('#localNumber').on('ifChecked', function(event){
	  if($('#localNumber').is(':checked')){
			$('#CountrySelect').show();
			$('#TollFree').hide();
		}else{
		}
	});
        });
    </script>
END;
$xajax->printJavascript();

include("google_code.php");
echo <<<END
<SCRIPT>
function toggleTel (el1, el2) {
	var myElement = document.getElementById(el1);
	var myElement2 = document.getElementById(el2);

	if (!myElement.style.display || myElement.style.display == "none") {
		myElement.style.display = "block";
		myElement2.style.display = "none";
	}

}
</SCRIPT>
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

        <div class="detailsTopWrap2 changeMtop3">
        
        <div class="wrapMRdetails">
        <div class="StepsContentLeft">
        <div class="fL sone"><div class="stepOne sactive">STEP 1 - Customize</div><div class="sfR Ra"></div></div>
        <div class="fL stwo"><div class="sfL Ld"></div><div class="stepTwo">STEP 2 - Checkout & Review</div><div class="sfR Rd"></div></div>
        <div class="fL sthree"><div class="sfL Ld"></div><div class="stepThree">STEP 3 - Confirm</div></div>
        </div><!--/StepsContentLeft-->
        <div class="StepsContentLeft">
        <div class="wrapDescrip">
        <h1 class="gray2">CUSTOMIZE AND CHOOSE OPTIONS</h1>
         <p>Please customize your phone</p>
         
        <div class="customPhoneTop">
		<p><span class="mediumBold">Select whether you would like a local or toll free number.</span></p>
            <br>
		<input type="radio" id="localNumber" name="phoneValue" value="phoneValue"/> <label> local number</label> &nbsp; &nbsp; <input type="radio" id="tollFreeSelected" name="phoneValue" value=""/> <label> toll free number</label>
	    <br><br>
	</div>

            <form method="post" action="" name="form1" id="form1" >
            <input type="hidden" name="step" value="2" />

            <div id="CountrySelect" style="display: none;">
            <p><span class="mediumBold">Please select the country you'd like your number to be in:</span></p>
            <select class="countryPhone changeMtop" name="" onChange="xajax_getPrefix(this.value, '$callPlan');">
                <option value="">Please Select</option>
END;

	// get countries
	$GetCountry=mysql_query("SELECT * from tel_Countries ORDER BY Country_Code") or die(mysql_error());
	while( $CountryInfo = mysql_fetch_array($GetCountry) )
	{
		echo <<<END
		<option value="$CountryInfo[Country_Code]">$CountryInfo[Full_Name]</option>
END;
	}

	echo <<<END
	    </select>
            <br><br>
            </div><!--/CountrySelect-->
            
            <div id="TollFree" style="display: none;">
            <p><span class="mediumBold">Select a toll-free prefix below to see available numbers.</span></p>
            <select class="TollFPhone changeMtop" name="" onChange="xajax_getTollFree(this.value);">
                <option value="">Please Select</option>
                <option value="800">800</option>
                <option value="888">888</option>
                <option value="866">866</option>
                <option value="877">877</option>
            </select>
            <br><br>
            </div><!--/TollFree-->

	    <div id="Prefix"></div>
	    <div id="Numbers"></div>
	    <div id="Errors"></div>
    
        </form>

        </div><!--/wrapDescrip-->
        </div><!--/StepsContentLeft-->
        </div><!--/wrapMRdetails-->
        
        
         <div class="dsidecart radiusTop hide">
        	<div class="contactPhonesCart">
            <div class="centerForm">
            NORTH AMERICA:    +1 888.869.9494<br>
			INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhonesCart-->
            <div class="dimgSideCart"><div class="img-wrapper2"><img src="http://www.abcn.com/images/photos/3056_Los-Angeles-office-space.jpg" /></div></div><!--/dimg-->
            <div class="clear"></div>
            <div class="theSideCartWrap">
            <div class="eachSCartWrap">
            <h3 class=" bold">S. Grand Ave. in Los Angeles, CA</h3>
            <h4 class="bold blue">ADDRESS</h4>
            <p><span class="mediumBold">KPMG Building</span><br>
            355 S. Grand Ave. Los Angeles, CA 90071</p>
            <div class="sideCartLine"><div class="sideCartL">PLATINUM PLAN:</div><div class="sideCartr"><span class="mediumBold">$80</span>/month</div></div><!--/sideCartLine--><div class="clear"></div>
            <div class="sideCartLine"><div class="sideCartL">MAIL FORWARDING:</div><div class="sideCartr"><span class="mediumBold">$0</span>/month</div></div><!--/sideCartLine--><div class="clear"></div>
            <div class="sideCartLine"><div class="sideCartL">SET UP FEE:</div><div class="sideCartr"><span class="mediumBold">$100</span><br>(one time only)</div></div><!--/sideCartLine--><div class="clear"></div>
            </div><!--/eachSCartWrap-->
            <div class="sideCartLine"><div class="sideCartL">TOTAL:</div><div class="sideCartr aqua mediumBold">$180</div></div><!--/sideCartLine-->
            <div class="clear"></div>
            <div class="bottomSideCart">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div><!--/bottomSideCart-->
            </div><!--/theSideCartWrap-->
        </div><!--/dsidecart-->
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
        
        
       
        <div class="nearWrap">
        
        </div><!--/nearWrap-->
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
    
</body>
</html>
END;

?>