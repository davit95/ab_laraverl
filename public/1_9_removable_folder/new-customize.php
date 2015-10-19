<?php
require_once("xajax.inc.php");
include ("../connect_db.php");
include ("../siteFunctions.php");

// set some vars
$grand_total = '';
$line_total = '';
$telephony_in_cart = 'no';
$location_in_cart = 'no';
$cartID = mysql_real_escape_string($_COOKIE['CINFO']);
$customerID = mysql_real_escape_string($_COOKIE['CUSTINFO']);
$telephony_ready = $_SESSION['telephony_ready'];
$bundle_cart = $_SESSION['cpt'];

if( $_POST['step'] == '2' )
{
	// escape input
	$_POST['term'] = mysql_real_escape_string($_POST['term']);
	$_POST['product'] = mysql_real_escape_string($_POST['product']);
	$_POST['freq'] = mysql_real_escape_string($_POST['freq']);
	$_POST['term'] = mysql_real_escape_string($_POST['term']);
	$_REQUEST['Center_ID'] = mysql_real_escape_string($_REQUEST['Center_ID']);

	if( $cartID == '0' || $cartID == '' )
	{
		$error_text = 'There was a problem with your entry. Please <a href="http://www.alliancevirtualoffices.com/virtual-office-locations.php">click here</a> to try again.<br/><br />';
	}
	else
	{
		$query = "UPDATE SC_MF_Options SET MF_Courier='$_POST[product]', MF_Frequency='$_POST[freq]' WHERE Session_ID = '$sessionID' AND Cart_ID='$cartID'";
		mysql_query($query) or die('Error, query failed' . mysql_error());
	}

	// update term length
	$term_q = mysql_query("UPDATE SC_VO_Options SET VO_Term = '$_POST[term]' where Session_ID = '$sessionID' and Cart_ID = '$cartID'") or die("Udate Error: " . mysql_error());

	// see if they want to upgrade
	if( $_POST['upgrade'] == 'yes' )
	{
		$voQuery = "UPDATE SC_VO_Options SET Package_ID = '105' where Session_ID = '$sessionID' and Cart_ID = '$cartID'";
		mysql_query($voQuery) or die("Error updating: " . mysql_error());
	}

	customTelephonyCheck($_REQUEST['Center_ID']);

	if( $customTelephonyCenter == 'C' )
	{
		header("Location: international-plans.php?cid=$_REQUEST[Center_ID]");
		exit;
	}

	// if this is a bundle product then choose a number
	if( $bundle_cart == $cartID ) {
		header("Location: telephony-chooser2.php");
		exit;
	}
	
	// decide where to go next based on their cookie in the first step
	if( $telephony_ready == 'yes' )
	{
		header("Location: live-receptionist.php");
	}
	else
	{
		header("Location: cart.php");
	}
}

$xajax = new xajax();
$xajax->registerFunction("changePrice");

function changePrice($option, $freq)
{
	if( $option == '20' )
	{
		$price = '0.00';
	}
	if( $option == '21' )
	{
		$price = '5.00';
	}
	elseif( $option == '22' )
	{
		$price = '5.00';
	}
	elseif( $option == '23' )
	{
		$price = '7.00';
	}
	elseif( $option == '24' )
	{
		$price = '7.00';
	}
	$newContent = $price * $freq;
	$newContent = number_format($newContent, 2, '.', ',');
	$newContent = '$' . $newContent;
	if( ($option == '23') || ($option == '24') )
	{
		$newContent = $newContent . ' + postage per forwarding';
		$priceText = <<<END
<div style="font-size: 10px; color: #666;">*Please note that prices may vary according to frequency and amount of mail received and forwarded. Oversized shipments and items requiring special packaging will be charged duly. For international shipments requiring customs forms, an additional $5 fee will be added per forwarded shipment.</div>
END;
	}
	elseif( $option != '20' )
	{
		$newContent = $newContent . ' + postage per forwarding';
		$priceText = <<<END
<div style="font-size: 10px; color: #666;">*Please note that prices may vary according to frequency and amount of mail received and forwarded. Oversized shipments and items requiring special packaging will be charged duly. For international shipments requiring customs forms, an additional $5 fee will be added per forwarded shipment.</div>
END;
	}
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("price","innerHTML", $newContent);
	$objResponse->addAssign("price_text","innerHTML",$priceText);
    	return $objResponse;
}

$xajax->processRequests();

echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alliance Virtual Offices - Customize</title>
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
			};
			});
			
			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-grey',
				radioClass: 'iradio_flat-grey'
			});
        });
    </script>
END;

include("google_code.php");
$xajax->printJavascript();

echo <<<END
</head>
<body onload="initialize()">
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
         <p>Please customize your mail options first</p>
		
        <h3>Virtual Office Term Length:</h3>
        <form action="" method="post" name="form1" id="form1" >
	<input type="hidden" name="step" value="2" />
	<input type="hidden" name="Center_ID" value="$LNavCenterData[Center_ID]" />

           	<select name="term" class="term-drop">
			<option value="">Select Your Term Length</option>
			<option value="6" selected="selected">6 Month Term</option>
			<option value="12">12 Month Term</option>
		</select>
            
		<h3 class="changeMtop2">Please select your mail forwarding options:</h3>
		
           <table width="100%" border="0" cellspacing="5" cellpadding="5" class="table_fonts">
              <tr>
              <td>Forwarding Method:</td>
              </tr>
              <tr>
                <td width="150">
                <select name="product" id="forward" class="selcDrop" onChange="xajax_changePrice(this.value, document.getElementById("freq").selectedIndex);">
				  <option value="">Please Select </option>
				  <option value="20">Local Pickup</option>
                  		  <option value="21">Regular Mail </option>
                  		  <option value="22">Priority/Express Mail </option>
                  		  <option value="23">Next Day Courier </option>
                </select></td>
              </tr>
              <tr>
                <td class="FreqHide">Forwarding Frequency:</td>
              </tr>
              <tr>
                <td class="FreqHide">
                <select name="freq" id="freq" class="selcDrop" onChange="xajax_changePrice(document.form1.product.value, this.value);">
				  <option value="">Please Select </option>
                  		  <option value="1">Monthly </option>
                  		  <option value="2">Bi-Weekly </option>
                  		  <option value="4">Weekly </option>
                  		  <option value="30">Daily </option>
                </select>
                </td>
              </tr>
	      <tr>
                <td><div id="price">$0.00</div><div id="price_text">&nbsp;</div></td>
	      </tr>
	</table>

END;

	$GetVOCart=mysql_query("SELECT * from Shopping_Cart where Cart_ID='$cartID'");
	$VOData=mysql_fetch_array($GetVOCart);

	$GetPackageInfo=mysql_query("SELECT * from SC_VO_Options where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
	$LNavPackageData = mysql_fetch_array($GetPackageInfo);
	
	$Package_Part_Number = $LNavPackageData['Package_ID'];

	get_center_info($VOData[Center_ID]);

	// get info on what upgrades to sell them
	if( $Package_Part_Number == '103' )
	{
		$remainder = $center_platinum_plus_price - $center_platinum_price;
		if( $center_platinum_plus_price > '0' )
		{
			echo <<<END
		<div class="upgrade">
		<p>Would you like to add <span class="bold">16 hours of conference room time</span> monhtly for only <span class="bold aqua">$$remainder</span> more per month?</p><br><br>
		</div>

        	<p><input type="checkbox" name="upgrade" value="yes" style="width: 15px; height: auto;" /> <span class="bold">Yes!</span> I'd like to upgrade to the Platinum Plus package</p><br>
END;
		}
	}

	echo <<<END

	<input value=" CONTINUE " class="aquaBtn changeMtop continueBTN" type="submit" ><br>
         
        </form>

        </div><!--/wrapDescrip-->
        </div><!--/StepsContentLeft-->
        </div><!--/wrapMRdetails-->
        
         <div class="dsidecart radiusTop hide">
        	<div class="contactPhonesCart">
            <div class="centerForm">
            NORTH AMERICA: +1 888.869.9494<br>
	    INTERNATIONAL: +1 949.777.6340
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

 <script type="text/javascript">
$('#forward').change(function(){
	 if($(this).val() == '20'){
	 $('.FreqHide>option:eq(2)').attr('selected', true);
     $('.FreqHide').hide();
  }else if($(this).val() == ''){
	  $('.FreqHide>option:eq(2)').attr('selected', true);
	  $('.FreqHide').hide();
  }else{
	  $('.FreqHide').show();
	  $('.FreqHide>option:eq(0)').attr('selected', true);
	  }
});
</script>
     
</body>
</html>
END;

?>