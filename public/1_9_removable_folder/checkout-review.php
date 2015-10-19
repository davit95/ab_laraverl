<?php
require '../ccvs.inc';
require_once("xajax.inc.php");
require '../PasswordHash.php';
include ("../connect_db.php");
include ("../siteFunctions.php");

// set some vars
$meeting_room_in_cart = 'no';
$cartID = mysql_real_escape_string($_COOKIE["CINFO"]);
$customerID = mysql_real_escape_string($_COOKIE["CUSTINFO"]);

if( $customerID != '' ) {
    $returning_customer = 'yes';
}

if( $_POST['new_customer'] == '1' )
{
	$t_hasher = new PasswordHash(8, FALSE);

	// escape input
	$_POST['First_Name'] 	= mysql_real_escape_string($_POST['First_Name']);
	$_POST['Last_Name'] 	= mysql_real_escape_string($_POST['Last_Name']);
	$_POST['Company_Name'] 	= mysql_real_escape_string($_POST['Company_Name']);
	$_POST['Email_Address']	= mysql_real_escape_string($_POST['Email_Address']);
	$_POST['Username'] 	= mysql_real_escape_string($_POST['Username']);
	$_POST['Phone_Number'] 	= mysql_real_escape_string($_POST['Phone_Number']);
	$_POST['Password_Hint']	= mysql_real_escape_string($_POST['Password_Hint']);
	$_POST['Address_1'] 	= mysql_real_escape_string($_POST['Address_1']);
	$_POST['Address_2'] 	= mysql_real_escape_string($_POST['Address_2']);
	$_POST['City'] 		= mysql_real_escape_string($_POST['City']);
	$_POST['State'] 	= mysql_real_escape_string($_POST['State']);
	$_POST['Postal_Code'] 	= mysql_real_escape_string($_POST['Postal_Code']);
	$_POST['Country'] 	= mysql_real_escape_string($_POST['Country']);
	$_POST['Password'] 	= mysql_real_escape_string($_POST['Password']);
	$_POST['CC_Name'] 	= mysql_real_escape_string($_POST['CC_Name']);
	$_POST['CC_Number'] 	= mysql_real_escape_string($_POST['CC_Number']);
	$_POST['CC_Year'] 	= mysql_real_escape_string($_POST['CC_Year']);
	$_POST['CC_Month'] 	= mysql_real_escape_string($_POST['CC_Month']);
	$_POST['CVV2'] 		= mysql_real_escape_string($_POST['CVV2']);
	$_POST['Fax1'] 		= mysql_real_escape_string($_POST['Fax1']);
	$_POST['Hint_Answer'] 	= mysql_real_escape_string($_POST['Hint_Answer']);

	if( $_REQUEST['payType'] != 'bitcoin' && $_POST['update'] != 'yes' )
	{
		$Form = new CreditCardValidationSolution;
	    	$Accepted = '';
	    	$Month = $_POST['CC_Month'];
	    	$Year  = '20'.$_POST['CC_Year'];
	    	if ( !$Form->validateCreditCard($_POST['CC_Number'], 'en', $Accepted, 'Y', $Month, $Year) ) 
	    	{
			$etext = $Form->CCVSError;
			$error = array("Please enter a valid Credit Card Number. $etext");
			dispErrors($error);
	    	} 
	    	else 
	    	{
	        	$CCLeftNumbers = $Form->CCVSNumberLeft;
	        	$CCRightNumbers = $Form->CCVSNumberRight;
	    	}
	}

	$customerTime = time();
	if( $_POST['update'] == 'yes' )
	{
		//-- UPDATE CUSTOMER INFO --#
		$query = "UPDATE Customers SET First_Name='$_POST[First_Name]',Last_Name='$_POST[Last_Name]', Company_Name='$_POST[Company_Name]', Email='$_POST[Email_Address]', Phone1= '$_POST[Phone_Number]', Address1='$_POST[Address_1]', Address2='$_POST[Address_2]', City='$_POST[City]', State='$_POST[State]', Postal_Code='$_POST[Postal_Code]', Country='$_POST[Country]' WHERE Customer_ID='$customerID'";
		mysql_query($query) or die('Error, query failed' . mysql_error());
	}
	else
	{
		//-- ADD THIS PERSON AS A NEW CUSTOMER REGARDLESS --#
		$AddProdsToCart=mysql_query("INSERT into Customers values ('','$_POST[First_Name]','$_POST[Last_Name]','$_POST[Company_Name]','$_POST[Email_Address]','$_POST[Username]','$_POST[Phone_Number]','$_POST[Password_Hint]','$_POST[Address_1]','$_POST[Address_2]','$_POST[City]','$_POST[State]','$_POST[Postal_Code]','$_POST[Country]','','$_POST[CC_Name]','$encrypted_string','$_POST[CC_Year]','$_POST[CC_Month]','$_POST[CVV2]','Pending','$_POST[Fax1]','$_POST[Hint_Answer]','$customerTime','','')") or die("Error:" . mysql_error());
		$customerID = mysql_insert_id();

		// ENCRYPT CC NUMBER
		$string = $_POST['CC_Number'];
		$key = $customerID;
		$cipher_alg = MCRYPT_BLOWFISH;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt($cipher_alg, $key, $string, MCRYPT_MODE_CBC, $iv);
		$encrypted_string = addslashes($encrypted_string);
		$query = "UPDATE Customers SET CC_Number='$encrypted_string' WHERE Customer_ID='$customerID'";
		mysql_query($query) or die('Error3' .  mysql_error());

		$iv = addslashes($iv);
		$AddEncrypted=mysql_query("INSERT into sectest values ('','$key','$iv')") or die("Error67:" . mysql_error());

		makeCookie2($customerID);
	}

	// Now update the mail forwarding for all the centers in their cart.
	$_POST['MF_First_Name']		= mysql_real_escape_string($_POST['MF_First_Name']);
	$_POST['MF_Last_Name'] 		= mysql_real_escape_string($_POST['MF_Last_Name']);
	$_POST['MF_Company_Name'] 	= mysql_real_escape_string($_POST['MF_Company_Name']);
	$_POST['MF_Address1'] 		= mysql_real_escape_string($_POST['MF_Address1']);
	$_POST['MF_Address2'] 		= mysql_real_escape_string($_POST['MF_Address2']);
	$_POST['MF_City'] 		= mysql_real_escape_string($_POST['MF_City']);
	$_POST['MF_State'] 		= mysql_real_escape_string($_POST['MF_State']);
	$_POST['MF_Postal_Code'] 	= mysql_real_escape_string($_POST['MF_Postal_Code']);
	$_POST['MF_Country'] 		= mysql_real_escape_string($_POST['MF_Country']);
	
	// if by some chance there is an entry then update it
	$query = "UPDATE SC_MF_Options SET First_Name='$_POST[MF_First_Name]', Last_Name='$_POST[MF_Last_Name]', Company_Name='$_POST[MF_Company_Name]', Address_1='$_POST[MF_Address1]', Address_2='$_POST[MF_Address2]', City='$_POST[MF_City]', State='$_POST[MF_State]', Postal_Code='$_POST[MF_Postal_Code]', Country='$_POST[MF_Country]' WHERE Session_ID = '$sessionID'";
	mysql_query($query) or die('Error, query failed2' . mysql_error());

	// hash password
	$hash = $t_hasher->HashPassword($_POST['Password']);
	$insert_hash = mysql_query("INSERT into Customer_Hashes values('$customerID','$hash')") or die("Hash Insert Error: " . mysql_error());
	unset($t_hasher);

	// decide where to go
	if( $_REQUEST['payType'] != 'bitcoin' )
	{
		header("Location: https://www.alliancevirtualoffices.com/order-review2.php");	
	}
	else
	{
		header("Location:https://www.alliancevirtualoffices.com/order-review-bit.php");
	}

}
elseif( $_POST['returning_customer_yes'] == '1' || $_COOKIE['csr_customer_id'] != '' )
{
	$t_hasher = new PasswordHash(8, FALSE);
	$username = addslashes($_REQUEST['Email']);

	// if it's a CSR forced 
	if( $_COOKIE['csr_customer_id'] != '' ) {
		$csr_force_id = mysql_real_escape_string($_COOKIE['csr_customer_id']);
		makeCookie2($csr_force_id);
		setcookie('csr_customer_id',$cartID,time()-3600,'/');
		header("Location: https://www.alliancevirtualoffices.com/customer-information3.php");
	}
	
	// check for info
	$check_q = mysql_query("SELECT * from Customers where Email = '$username'") or die("Error: " . mysql_error());
	while( $check_d = mysql_fetch_array($check_q) )
	{
		// get their hash
		$hash_q = mysql_query("SELECT * from Customer_Hashes where Customer_ID = '$check_d[Customer_ID]'") or die("Hash Error: " . mysql_error());
		$hash_d = mysql_fetch_array($hash_q);
		$check_against = $hash_d['Password'];
		$check = $t_hasher->CheckPassword($_REQUEST['LPassword'], $check_against);
	
		if( $check )
		{
			makeCookie2($check_d['Customer_ID']);
			header("Location: https://www.alliancevirtualoffices.com/customer-information3.php");
		}
		else
		{
			$error = array('Email / Password not recognized. Please try again.');
			dispErrors($error);
			exit;
		}
	}
}


echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alliance Virtual Offices - Customer Information</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js"></script>
<link href="css/flat/grey.css" rel="stylesheet">
<script src="js/icheck.js"></script>
<script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
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
		contentAsHTML: true,
		interactive: true,
                content: $('<span> We have recently updated our login procedure.<br><br>Now, you can use the email address you gave us when you became a client, or if you were a customer starting before August 13, 2012, you can also use your your old username (be sure to type username@abcnvirtual.com).<br><br><span class="mediumBold">If you have forgotten your password please use our <br><a href="https://www.alliancevirtualoffices.com/password-recover.php" class="blue mediumBold">password recovery page</a></span> </span>')
        });
			
	if ($(window).width() > 850) {
		$(".dformright2").stick_in_parent()
	}
	else {};
			
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
	
	$('#creditCard').on('ifChecked', function(event){
	  if($('#creditCard').is(':checked')){
			$('#checkout-fields').show();
			$('#bitpay-fields').hide();
		}else{
		}
	});
	$('#bitcoin').on('ifChecked', function(event){
	  if($('#bitcoin').is(':checked')){
			$('#bitpay-fields').show();
			$('#checkout-fields').hide();
		}else{
		}
	});


    });
</script>

<SCRIPT LANGUAGE="JavaScript">
<!--
function mfchange(f) {
	for (var i = 1; i<arguments.length; i+=2)
	f.elements[arguments[i+1]].value = f.elements[arguments[i]].value;
}

//-->
</SCRIPT>
END;
include("google_code.php");
echo <<<END
    
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
        
        <div class="dsidecart radiusTop">
            <div class="contactPhonesCart">
                <div class="centerForm">
                    NORTH AMERICA:    +1 888.869.9494<br>
	            INTERNATIONAL:     +1 949.777.6340
                </div><!--/centerForm-->
            </div><!--/contactPhonesCart-->
            
            <div class="clear"></div>

	    <!-- sidebar cart show -->
            <div class="theSideCartWrap changeMtop hide">
                <div class="MyCart"><div class="mcartTxt">MY CART</div> <img src="images/myCart.png" class="myCartImg"/></div><!--/MyCart-->
                <div class="eachSCartWrap marginTop paddingtop">
                    <h3 class=" bold">S. Grand Ave. in Los Angeles, CA</h3>
                    <h4 class="bold blue">ADDRESS</h4>
                    <p><span class="mediumBold">KPMG Building</span><br>
                    355 S. Grand Ave. Los Angeles, CA 90071<br><span class="smallLine mediumBold">12 month term</span></p>
                    <table width="100%">
                        <tr>
                            <td class="sideCartL3">PLATINUM PLAN:</td><td class="sideCartr2"><span class="mediumBold">$80</span><span class="smallLine gray3"> /month</span></td>
                        </tr>
                        <tr>
                            <td class="sideCartL3">MAIL FORWARDING:</td><td class="sideCartr2"><span class="mediumBold">$0</span><span class="smallLine gray3"> /month</span></td>
                        </tr>
                        <tr>
                            <td class="sideCartL3">SET UP FEE:</td><td class="sideCartr2"><span class="mediumBold">$100</span><br><span class="smallLine gray3">(one time only)</span></td>
                        </tr>
                    </table>
                    <table width="100%">
                    <tr>
                        <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$180</span></td>
                    </tr>
                    </table>
                </div><!--/eachSCartWrap-->
            
                <div class="eachSCartWrap marginTop paddingtop">
                    <h3 class=" bold">High Bluff Drive</h3>
                    <h4 class="bold blue">ADDRESS</h4>
                    <p><span class="mediumBold">Plaza Del Mar</span><br>
                    12526 High Bluff Drive San Diego CA 92130<br><span class="smallLine mediumBold">04/29/2015<br>11:30 am - 1:30 pm</span></p>
                    <table width="100%">
                        <tr>
                            <td class="sideCartL2">MEETING ROOM:</td><td class="sideCartr2"><span class="mediumBold">$45</span></td>
                        </tr>
                        <tr>
                            <td class="sideCartL2">TOTAL AMOUNT:</td><td class="sideCartr2"><span class="mediumBold">$90</span></td>
                        </tr>
                        <tr>
                            <td class="sideCartL2">30% DUE NOW:</td><td class="sideCartr2"><span class="mediumBold">$27</span></td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$14</span></td>
                        </tr>
                    </table>
                </div><!--/eachSCartWrap-->
            
                <table class="totalLine" width="100%">
                    <tr>
                        <td class="sideCartL3">ORDER TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$194</span></td>
                    </tr>
                </table>
                <div class="clear"></div>
                <div class="bottomSideCart">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div><!--/bottomSideCart-->
            </div><!--/theSideCartWrap-->
        </div><!--/dsidecart-->
        
        <div class="wrapMRdetails">
        <div class="StepsContentLeft">
            <div class="fL sone"><div class="stepOne">STEP 1 - Customize</div><div class="sfR Rd"></div></div>
            <div class="fL stwo"><div class="sfL La"></div><div class="stepTwo sactive">STEP 2 - Checkout & Review</div><div class="sfR Ra"></div></div>
            <div class="fL sthree"><div class="sfL Ld"></div><div class="stepThree">STEP 3 - Confirm</div></div>
        </div><!--/StepsContentLeft-->

        <div class="StepsContentLeft">
        <div class="wrapDescrip">
        <h1 class="gray2">ACCOUNT INFORMATION & CHECKOUT</h1>
END;

if( $returning_customer != 'yes' )
{
    echo <<<END
	<div class="signin-info changeMtop2 ">
	<form action="" method="post" name="signin" >
	<input type="hidden" name="returning_customer_yes" value="1" />
		
		<p><span class="mediumBold">Please enter your email and password below.</span></p><br>
		<div class="existingL"><label>Email Address</label></div><div class="existingR"><input class="checkOutInput" type="text" name="Email" value=""/></div>
		<div class="clear"></div>
		<div class="existingL"><label>Password</label></div><div class="existingR"><input class="checkOutInput" type="password" name="LPassword" value=""/></div>
		<div class="clear"></div>
		<div class="existingL"></div><input value="SUBMIT" class="aquaBtn changeMtop minW" type="submit"><br>

		<div class="existingL"></div><div class="help"><img src="images/info.png" class="tooltip"/> Having problems signing in?</div>
        	
	</form>
	</div><!--/signin-info-->

	<form action="" method="post" class="custInfoForm" name="form1" >
	<input type="hidden" name="new_customer" value="1" >
    	<div class="newCinfo">
		<h3><span class="newCust">NEW CUSTOMERS - <span class="medium">ENTER YOUR BILLING INFORMATION</span></span></h3>
		<br><p>Please enter the required information about yourself below.</p>
		<span class="smallLine"><span class="orange">*</span> Indicates a required field</span><br>
		
	<div class="clear"></div>
			<div class="newL"><label>First Name <span class="orange">*</span></label><input type="text" name="First_Name" value=""/></div>
			<div class="newL"><label>Last Name <span class="orange">*</span></label><input type="text" name="Last_Name" value=""/></div>
			<div class="clear"></div>
			<div class="newL"><label>Email <span class="orange">*</span></label><input type="text" name="Email_Address" value=""/></div>
            <div class="newL"><label>Phone Number <span class="orange">*</span></label><input type="text" name="Phone_Number" value=""/></div>
            <div class="clear"></div>
			<div class="newL2"><label>Company <span class="orange">*</span></label><input class="inputLong" type="text" name="Company_Name" value=""/></div>
			<div class="newL2"><label>Address 1 <span class="orange">*</span></label><br><input class="inputLong" type="text" name="Address_1" value=""/></div>
			<div class="newL2"><label>Address 2</label><br><input class="inputLong" type="text" name="Address_2" value=""/></div>
			<div class="clear"></div>
            <div class="newL">
			<label>Country</label><br/>
			<select name="Country" class="field-select">
			        <option value="">Please Select A Country </option>
END;
	$query=mysql_query("SELECT * from Country ORDER BY Name");
	while ($row=mysql_fetch_array($query) )
	{
		$varlength = strlen($row['Name']);
		if ($varlength > 25) 
		{
			$row['Name'] = substr($row['Name'],0,25) . "...";
		}
		$row['Name'] = ucfirst(strtolower($row['Name']));
		if( $row['Code'] == 'US' ){ $row['Name'] = 'United States'; }
		echo <<<END
 		<option value="$row[Code]" $MFselected>$row[Name]</option>

END;
	}
	echo <<<END
			</select>
			</div>
            <div class="clear"></div>
			
			
			<div class="newL3"><label>City</label><input class="inputSmall" type="text" name="City" value=""/></div>
			<div class="newL3"><label>State</label><input class="inputSmall" type="text" name="State" value=""/></div>
			<div class="newL3"><label>Postcal Code<span class="orange">*</span></label><input class="inputSmall" type="text" name="Postal_Code" value=""/></div>	

    </div><!--/newCinfo-->
	<!-- end billing info //-->
END;

	// show or don't show mail forwarding info
	$show_mail_forwarding = 'no';
	$mf_count = '0';
	$showMF_q = mysql_query("SELECT * from SC_VO_Options WHERE Session_ID = '$sessionID'") or die("Error x4r: " . mysql_error());
	while( $showMF_d = mysql_fetch_array($showMF_q) )
	{
		checkForVO($showMF_d['Package_ID'],$showMF_d['Cart_ID'],$sessionID);
		if( $sesh_vo_package == 'valid' )
		{
			$mf_count++;
		}

		if( $sesh_mf_option != 'local' )
		{
			$mf_count++;
		}
	}
	
	if( $mf_count >= '2' )
	{
		$show_mail_forwarding = 'yes';
	}

	// show mail forwarding if we should
	if( $show_mail_forwarding == 'yes' )
	{
		echo <<<END
		<div class="mailFinfo">
		    <h3><span class="newCust">MAIL FORWARDING INFORMATION</span></h3>
       
		      <div class="newL"><label>First Name <span class="orange">*</span></label>
                      <input type="text" name="MF_First_Name" value="" /></div>

		      <div class="newL"><label>Last Name <span class="orange">*</span></label>
                      <input type="text" name="MF_Last_Name" value="" /></div>

		      <div class="clear"></div>

		      <div class="newL2"><label>Address 1 <span class="orange">*</span></label>
                      <input class="inputLong" type="text" name="MF_Address1" value="" /></div>

		      <div class="newL2"><label>Address 2</label>
                      <input class="inputLong" type="text" name="MF_Address2" value="" /></div>

		      <div class="newL2"><label>Company Name <span class="orange">*</span></label>
                      <input class="inputLong" type="text" name="MF_Company_Name" value="" /></div>
          
          	      <div class="newL"><label>Country <span class="orange">*</span></label><br/>
                      <select name="MF_Country">
                          <option value="">Please Select A Country </option>
END;
			  $query=mysql_query("SELECT * from Country ORDER BY Name");
		          while ($row=mysql_fetch_array($query) )
			  {
			      $varlength = strlen($row['Name']);
			      if ($varlength > 25) 
			      {
			          $row['Name'] = substr($row['Name'],0,25) . "...";
			      }
			      $row['Name'] = ucfirst(strtolower($row['Name']));
			      if( $row['Code'] == 'US' ){ $row['Name'] = 'United States'; }
			      echo <<<END
 			  <option value="$row[Code]" $MFselected>$row[Name]</option>

END;
			  }
		echo <<<END
                      </select>
                </div>

		  <div class="clear"></div>
		  <div class="newL3"><label>City</label>
                  <input class="inputSmall" type="text" name="MF_City" value="" /></div>

		  <div class="newL3"><label>State</label>
                  <input class="inputSmall" type="text" name="MF_State" value="" /></div>

		  <div class="newL3"><label>Postal Code <span class="orange">*</span></label>
                  <input class="inputSmall" type="text" name="MF_Postal_Code" value="" /></div>

		  <div class="clear"></div>
		<!-- end username information//-->

	</div><!--/mailFinfo-->
	<!-- end mail forwarding info //-->
END;
	}

	echo <<<END
	<div class="AccountPW">
		<h3><span class="newCust">ACCOUNT PASSWORD INFORMATION</span></h3>
		
			<div class="newL"><label>Password <span class="orange">*</span></label><br/><input type="password" name="Password" value=""/><br><span class="smallLine">10 character limit</span></div>
			<div class="newL"><label>Confirm Password <span class="orange">*</span></label><br/><input type="password" name="Password_2" value=""/></div>
			<div class="clear"></div>
		<!-- end username information//-->
	</div><!--/AccountPW-->
    
	<div class="PaymentInfo">
		<h3><span class="newCust">PAYMENT INFORMATION</span></h3>
			<input type="radio" name="payType" id="creditCard" value="cc"> Pay by Credit Card  &nbsp; &nbsp; 
			<input type="radio" name="payType" id="bitcoin" value="bitcoin">Pay with Bitcoin<br>
			<div class="clear"></div>
		
			<div id="checkout-fields" style="display:none;">
			<div class="newL2"><label>Cardholder's Name<span class="orange">*</span></label><input class="inputLong" name="CC_Name" type="text"></div>
			<div class="newL"><label>Card Number<span class="orange">*</span></label><input name="CC_Number" type="text"></div>
			<div class="newL"><label>CVV2 Number<span class="orange">*</span></label><input name="CVV2" id="CVV2" type="text"><br/><abbr><a href="cvv2.html" class="aqua smallLine" onclick="window.open (this.href, 'child', 'height=300,width=600, scrollbars=yes'); return false" title="Click for more information">Where's my CVV2?</a></abbr></div>
			<div class="clear"></div>
			<div class="newL">
				<label>Expiration Date: <span class="orange">*</span></label>
				<select name="CC_Month">
					<option value="01">January (01)
					</option><option value="02">February (02)
					</option><option value="03">March (03)
					</option><option value="04">April (04)
					</option><option value="05">May (05)
					</option><option value="06">June (06)
					</option><option value="07">July (07)
					</option><option value="08">August (08)
					</option><option value="09">September (09)
					</option><option value="10">October (10)
					</option><option value="11">November (11)
					</option><option value="12">December (12)
					</option></select>
			</div>
			<div class="newL">
				<label>Expiration Date: <span class="orange">*</span></label>
				<select name="CC_Year">
					</option><option value="14">2014
					</option><option value="15">2015
					</option><option value="16">2016
					</option><option value="17">2017
					</option><option value="18">2018
					</option><option value="19">2019
					</option><option value="20">2020
					</option><option value="21">2021
					</option><option value="22">2022
					</option><option value="23">2023
					</option><option value="24">2024
					</option>
				</select>
			</div>
			<div class="clear"></div>
			</div>

		<div id="bitpay-fields" style="display: none;">
			<br /><br /><p><span class="bold">Please accept the terms and hit continue to go to the Bitpay checkout</span></p>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>

	</div><!--/PaymentInfo-->
	<!-- end payment information//-->
END;

			// see which terms to include
			if( $meeting_room_in_cart == 'no' )
			{
				//include 'vo-terms.html';
				$term_link = 'vo-terms.html';
			}
			else
			{
				//include 'mr-terms.html';
				$term_link = 'mr-terms.html';
			}

		echo <<<END

	<div class="acceptTerms">
			<input name="agree" value="yes" type="checkbox"><label> <span class="orange">*</span> I agree to the Terms of Service - </label> <a href="$term_link" class="aqua" target="V">Terms of Service</a>
			<br/><br/>
			 <input value="CONTINUE" class="aquaBtn changeMtop continueBTN" type="submit">
			
			
		<div class="clear"></div>
	</div><!--/acceptTerms-->
		<!-- end terms information//-->
		</form>
	<!-- END BRM CODE //-->
	

	<form action="" method="post" class="custInfoForm" name="form1" >
	<input type="hidden" name="new_customer" value="1" />
	<input type="hidden" name="update" value = "yes" />
	<!-- end checkout-detail-total //-->
END;
}
else 
{
	//-- GET CUSTOMER INFORMATION --#
	$query=mysql_query("SELECT * from Customers WHERE Customer_ID='$customerID'");
	$customer_info = mysql_fetch_array($query);

	//-- Get Customer's Credit Card information --#
	$GetcryptInfo=mysql_query("SELECT * from sectest where ID_Key='$customerID'") or die(mysql_error());
	$cryptData = mysql_fetch_array($GetcryptInfo); 
		
	//-- CC DECRYPTION --#
	$encrypted_string = $customer_info['CC_Number'];
	$iv = $cryptData['IV'];
	$key = $customerID;
	$cipher_alg = MCRYPT_BLOWFISH;
	$cc_number = mcrypt_decrypt($cipher_alg, $key, $encrypted_string, MCRYPT_MODE_CBC, $iv);

	//-- Get first and last four digits of CC --#
	$length = strlen($cc_number);
	$characters = 4;
	$start = $length - $characters;
	$cust_cc_right = substr($cc_number, $start ,$characters);
	$cust_cc_left = substr($cc_number, '0', $characters);

 	echo <<<END
    <div class="ExistingCinfo">
		<h3><span class="newCust">BILLING INFORMATION</span></h3>
		<br><p>Please enter the required information about yourself below.</p>
		<span class="smallLine"><span class="orange">*</span> Indicates a required field</span><br>
		
        <div class="clear"></div>
			<div class="newL"><label>First Name <span class="orange">*</span></label><input type="text" name="First_Name" value="$customer_info[First_Name]"/></div>
			<div class="newL"><label>Last Name <span class="orange">*</span></label><input type="text" name="Last_Name" value="$customer_info[Last_Name]"/></div>
			<div class="clear"></div>
			<div class="newL"><label>Email <span class="orange">*</span></label><input type="text" name="Email_Address" value="$customer_info[Email]"/></div>
            <div class="newL"><label>Phone Number <span class="orange">*</span></label><input type="text" name="Phone_Number" value="$customer_info[Phone1]"/></div>
            <div class="clear"></div>
			<div class="newL2"><label>Company <span class="orange">*</span></label><input class="inputLong" type="text" name="Company_Name" value="$customer_info[Company_Name]"/></div>
			<div class="newL2"><label>Address 1 <span class="orange">*</span></label><br><input class="inputLong" type="text" name="Address_1" value="$customer_info[Address1]"/></div>
			<div class="newL2"><label>Address 2</label><br><input class="inputLong" type="text" name="Address_2" value="$customer_info[Address2]"/></div>
			<div class="clear"></div>
            <div class="newL">
			<label>Country</label><br/>
			<select name="Country" class="field-select">
			        <option value="">Please Select A Country </option>
END;
	$query=mysql_query("SELECT * from Country");
	while ($row=mysql_fetch_array($query) )
	{
		$varlength = strlen($row['Name']);
		if ($varlength > 25) 
		{
			$row['Name'] = substr($row['Name'],0,25) . "...";
		}
		if(  $customer_info['Country'] == $row['Code'] )
		{
			$selected = 'selected';
		}
		else
		{
			$selected = '';
		}
		$row['Name'] = ucfirst(strtolower($row['Name']));
		echo <<<END
 		<option value="$row[Code]" $selected>$row[Name]</option>

END;
	}
	echo <<<END
			</select>
			</div>
            <div class="clear"></div>
			
			
			<div class="newL3"><label>City</label><input class="inputSmall" type="text" name="City" value="$customer_info[City]"/></div>
			<div class="newL3"><label>State</label><input class="inputSmall" type="text" name="State" value="$customer_info[State]"/></div>
			<div class="newL3"><label>Postcal Code<span class="orange">*</span></label><input class="inputSmall" type="text" name="Postal_Code" value="$customer_info[Postal_Code]"/></div>
			
    </div><!--/ExistingCinfo-->
    
END;

	// show or don't show mail forwarding info
	$show_mail_forwarding = 'no';
	$mf_count = '0';
	$showMF_q = mysql_query("SELECT * from SC_VO_Options WHERE Session_ID = '$sessionID'") or die("Error x4r: " . mysql_error());
	while( $showMF_d = mysql_fetch_array($showMF_q) )
	{
		checkForVO($showMF_d['Package_ID'],$showMF_d['Cart_ID'],$sessionID);
		if( $sesh_vo_package == 'valid' )
		{
			$mf_count++;
		}
	
		if( $sesh_mf_option != 'local' )
		{
			$mf_count++;
		}
	}
	
	if( $mf_count >= '2' )
	{
		$show_mail_forwarding = 'yes';
	}
	
	if( $show_mail_forwarding == 'yes' )
	{
		// get the mail forwarding info
		getMFAddress($customerID);

		echo <<<END
	<div class="mailFinfo">
		<h3><span class="newCust">MAIL FORWARDING INFORMATION</span></h3>
       
		  <div class="newL"><label>First Name <span class="orange">*</span></label>
                  <input type="text" name="MF_First_Name" value="$mf_first_name" /></div>

		  <div class="newL"><label>Last Name <span class="orange">*</span></label>
                  <input type="text" name="MF_Last_Name" value="$mf_last_name" /></div>

		  <div class="clear"></div>

		  <div class="newL2"><label>Address 1 <span class="orange">*</span></label>
                  <input class="inputLong" type="text" name="MF_Address1" value="$mf_address1" /></div>

		  <div class="newL2"><label>Address 2</label>
                  <input class="inputLong" type="text" name="MF_Address2" value="$mf_address2" /></div>


		  <div class="newL2"><label>Company Name <span class="orange">*</span></label>
                  <input class="inputLong" type="text" name="MF_Company_Name" value="$mf_company_name" /></div>
          
          <div class="newL"><label>Country <span class="orange">*</span></label><br/>
                  <select name="MF_Country">
                  <option value="">Please Select A Country </option>
END;

		$query=mysql_query("SELECT * from Country ORDER BY Name");
		while ($row=mysql_fetch_array($query) )
		{
			$mfselector = '';
			$varlength = strlen($row['Name']);
			if ($varlength > 25) 
			{
				$row['Name'] = substr($row['Name'],0,25) . "...";
			}
			$row['Name'] = ucfirst(strtolower($row['Name']));
			if( $row['Code'] == 'US' ){ $row['Name'] = 'United States'; }
			if($row['Code'] == $mf_country)
			{
				$mfselecter = 'selected';
			}
			else
			{
				$mfselecter = '';
			}
	
			echo <<<END
 		<option value="$row[Code]" $mfselecter>$row[Name]</option>

END;
		}
		echo <<<END
                  </select>
          </div>

			<div class="clear"></div>
		  <div class="newL3"><label>City</label>
                  <input class="inputSmall" type="text" name="MF_City" value="$mf_city" /></div>

		  <div class="newL3"><label>State</label>
                  <input class="inputSmall" type="text" name="MF_State" value="$mf_state" /></div>

		  <div class="newL3"><label>Postal Code <span class="orange">*</span></label>
                  <input class="inputSmall" type="text" name="MF_Postal_Code" value="$mf_postal_code" /></div>

		  <div class="clear"></div>
		<!-- end username information//-->

	</div><!--/mailFinfo-->
END;
	}

	echo <<<END
	<div class="PaymentInfo">
		<h3><span class="newCust">PAYMENT INFORMATION</span></h3>
			<p><span class="mediumBold">Card on file:</span> <br />$customer_info[CC_Name]<br />XXXX-XXXX-XXXX-$cust_cc_right</p>

	</div><!--/PaymentInfo-->
END;

			// see which terms to include
			if( $meeting_room_in_cart == 'no' )
			{
				//include 'vo-terms.html';
				$term_link = 'vo-terms.html';
			}
			else
			{
				//include 'mr-terms.html';
				$term_link = 'mr-terms.html';
			}

		echo <<<END
	
    <div class="acceptTerms">
			<input name="agree" value="yes" type="checkbox"><label> <span class="orange">*</span> I agree to the Terms of Service - </label> <a href="$term_link" class="aqua" target="V">Terms of Service</a>
			<br/><br/>
			 <input value="CONTINUE" class="aquaBtn changeMtop continueBTN" type="submit">
			
			
		<div class="clear"></div>
	</div><!--/acceptTerms-->
END;
}
	echo <<<END
			</form>

        </div><!--/wrapDescrip-->
        </div><!--/StepsContentLeft-->
        </div><!--/wrapMRdetails-->
        
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


<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-17741668-1');
ga('require', 'ec');
END;


					$vo_skus = array();
					$vo_names = array();
					$vo_center_ids = array();
					$vo_prices = array();
					$vo_records = '0';

					$complete_VO_cart_IDs = array();
					$GetVOCart=mysql_query("SELECT * from Shopping_Cart where Session_ID='$sessionID'");
					while( $VOData=mysql_fetch_array($GetVOCart) )
					{
						// check to make sure that it has an associated mail forwarding entry
						$GetMFCart=mysql_query("SELECT * from SC_MF_Options where Session_ID='$sessionID' and Cart_ID='$VOData[Cart_ID]'");
						$MFData=mysql_fetch_array($GetMFCart);
					
						if( $MFData[MF_Courier] != '' )
						{
							$num++;
							$location_in_cart = 'yes';
							// add this cart id to the list
							array_push($complete_VO_cart_IDs, "$VOData[Cart_ID]");
						}
					}

					// get virtual office info and display it
					foreach( $complete_VO_cart_IDs as $virtual_id )
					{
						// get center info for each one
						$GetCenterInfo=mysql_query("SELECT * from Shopping_Cart where Session_ID='$sessionID' AND Cart_ID='$virtual_id'") or die(mysql_error());
						$LNavCenterData = mysql_fetch_array($GetCenterInfo);
				
						$GetPackageInfo=mysql_query("SELECT * from SC_VO_Options where Session_ID='$sessionID' AND Cart_ID='$virtual_id'") or die(mysql_error());
						$LNavPackageData = mysql_fetch_array($GetPackageInfo);
				
						$GetPackageDetails=mysql_query("SELECT package.Name, center.Price from Products AS package, Center_Package_Pricing AS center where package.Part_Number='$LNavPackageData[Package_ID]' AND center.Package_ID='$LNavPackageData[Package_ID]' AND center.Center_ID='$LNavCenterData[Center_ID]'") or die(mysql_error());
						$LNavPackageDetails = mysql_fetch_array($GetPackageDetails);
					
						$Disp_Package_Price = $LNavPackageDetails[Price];
						$Package_Part_Number = $LNavPackageData[Package_ID];
						$Package_Terms = $LNavPackageData[VO_Term];
						$Package_Name = $LNavPackageDetails[Name];
						$Disp_Package_Price = number_format($Disp_Package_Price, 2, '.', ',');
				
						// populate the vo javascript vars
						$vo_skus[$vo_records] = $Package_Part_Number;
						$vo_names[$vo_records] = $Package_Name;
						$vo_center_ids[$vo_records] = $LNavCenterData['Center_ID'];
						$vo_prices[$vo_records] = $Disp_Package_Price;
				
						$vo_records++;
					}

					$cp_skus = array();
					$cp_names = array();
					$cp_prices = array();
					$cp_records = '0';

					// now get the telephony stuff
					$tel_error = 'no';
					$active_center_id = '';

					// check to see if there is a euro center in the DB
					$GetCenterID=mysql_query("SELECT Center_ID from Shopping_Cart where Session_ID='$sessionID'") or die(mysql_error());
					while( $CenterIDData = mysql_fetch_row($GetCenterID) )
					{
						customTelephonyCheck($CenterIDData[0]);
						if( $customTelephonyCenter == 'C' )
						{
							$active_center_id = $CenterIDData[0];
							break;
						}
					}

					if( $customTelephonyCenter == 'C' )
					{
						// GET CP DETAILS
						$GetCPInfo=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die(mysql_error());
						$LNavCPData = mysql_fetch_array($GetCPInfo);
				
						// If there is a telephony plan then show it
						if( $LNavCPData[Com_Plan] != '' )
						{
							$telephony_in_cart = 'yes';
							#-- GET CP PRODUCT DETAILS --#
							$GetCPProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavCPData[Com_Plan]'") or die(mysql_error());
							$LNavCPProdData = mysql_fetch_array($GetCPProdInfo);
				
							#-- CREATE CP VARS --#
							$CP_Plan = $LNavCPProdData[Name];
				
							if( ($LNavCPData[Com_Plan] == '309') || ($LNavCPData[Com_Plan] == '312') )
							{
								#-- Get Name --#
								$CNameHandle=mysql_query("SELECT * from Telephony_Descriptions where Owner_ID='$customOwnerID' AND Sku='309'");
								$CData=mysql_fetch_row($CNameHandle);
					
								$CP_Org = "$TDataName1";
								$CP_Plan = 'N/A';
								$CP_Total = "$TDataPrice1";
							}
							elseif( ($LNavCPData[Com_Plan] == '310') || ($LNavCPData[Com_Plan] == '313') )
							{
								$CP_Org = "$TDataName2";
								$CP_Plan = 'N/A';
								$CP_Total = "$TDataPrice2";
							}
							elseif( ($LNavCPData[Com_Plan] == '311') || ($LNavCPData[Com_Plan] == '314') )
							{
								$CP_Org = "$TDataName3";
								$CP_Plan = 'N/A';
								$CP_Total = "$TDataPrice3";
							}
							elseif( $LNavCPData[Com_Plan] == '206' )
							{
								$CP_Org = 'No Telephony Option';
								$CP_Plan = 'No Plan';
							}
							else
							{
								$tel_error = 'yes';
								$CP_Total = "0";
							}

							$CP_Total = number_format($CP_Total, 2, '.', ',');
	
							// populate the cp javascript vars
							$cp_skus[$cp_records] = $LNavCPData['Com_Plan'];
							$cp_names[$cp_records] = $CP_Plan;
							$cp_prices[$cp_records] = $CP_Total;
				
							$cp_records++;
						}
					}
					else
					{	
						// GET CP DETAILS --#
						$GetCPInfo=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die(mysql_error());
						while( $LNavCPData = mysql_fetch_array($GetCPInfo) )
						{
							$Telephony_Cart_ID = $LNavCPData['Cart_ID'];
	
							// If there is a telephony plan then show it
							if( $LNavCPData['Com_Plan'] != '' )
							{
								$telephony_in_cart = 'yes';	
								//-- GET CP PRODUCT DETAILS --#
								$GetCPProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavCPData[Com_Plan]'") or die(mysql_error());
								$LNavCPProdData = mysql_fetch_array($GetCPProdInfo);
							
								//-- CREATE CP VARS --#
								$CP_Plan = $LNavCPProdData[Name];
								$CP_Org = 'Telephony Plan';
								$CP_Total = $LNavCPProdData[Price];
								
								// format the numbers
								$CP_Total = number_format($CP_Total, 2, '.', ',');

							}
							// populate the cp javascript vars
							$cp_skus[$cp_records] = $LNavCPData['Com_Plan'];
							$cp_names[$cp_records] = $CP_Plan;
							$cp_prices[$cp_records] = $CP_Total;
				
							$cp_records++;
						}
					}

					$mr_names = array();
					$mr_center_ids = array();
					$mr_prices = array();
					$mr_records = '0';

					// show meeting room info
					$GetMRInfo = mysql_query("SELECT * from SC_MR where Session_ID = '$sessionID'") or die("error MR: " . mysql_error());
					while( $MRData = mysql_fetch_array($GetMRInfo))
					{
						$meeting_room_in_cart = 'yes';
						get_meeting_room_info($MRData[Meeting_Room_ID]);
				
						// adjust money
						$mr_total_disp = number_format($MRData[Total], 2, '.', ',');

						// populate javascript vars
						$mr_names[$mr_records] = $MRData[Name];
						$mr_center_ids[$mr_records] = $mr_center_id;
						$mr_prices[$mr_records] = $mr_total_disp;

						$mr_records++;
					}

// print out the google javascript

$records_vo = $vo_records - 1;
for( $i=0; $i<=$records_vo; $i++ )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '$vo_skus[$i]',
  'name': '$vo_names[$i]',
  'variant': '$vo_center_ids[$i]',
  'price': '$vo_prices[$i]'
});


END;
}

$records_cp = $cp_records - 1;
for( $x=0; $x<=$records_cp; $x++ )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '$cp_skus[$x]',
  'name': '$cp_names[$x]',
  'price': '$cp_prices[$x]'
});


END;
}

$records_mr = $mr_records - 1;
for( $j=0; $j<=$records_mr; $j++ )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '601',
  'name': '$mr_names[$j]',
  'variant': '$mr_center_ids[$j]',
  'price': '$mr_prices[$j]'
});


END;
}


echo <<<END
ga('ec:setAction','checkout', {
    'step': 1
});
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
END;

echo <<<END
</body>
</html>
END;

?>