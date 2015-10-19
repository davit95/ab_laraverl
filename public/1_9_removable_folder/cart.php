<?php
include ("../connect_db.php");
include ("../siteFunctions.php");

// set some vars
$grand_total = '';
$line_total = '';
$telephony_in_cart = 'no';
$location_in_cart = 'no';

// remove any item if they want to
if( $_REQUEST['del'] == 'yes' )
{
	// escape input
	$_REQUEST['cartid'] = mysql_real_escape_string($_REQUEST['cartid']);
	if( $_REQUEST['option'] == 'vo' )
	{
		if( $coupon_attached == 'yes' )
		{
			// remove the product from the shopping cart and all it's telephony stuff too
			$query = "DELETE FROM SC_CP_Options WHERE Session_ID='$sessionID' AND Cart_ID='$coupon_telephony_cart_id'";
			mysql_query($query);
			$query = "DELETE FROM SC_TEL_Options WHERE Session_ID='$sessionID' AND Cart_ID='$coupon_telephony_cart_id'";
			mysql_query($query);
			$query = "DELETE FROM SC_Coupon WHERE Session_ID='$sessionID' AND Cart_ID='$_REQUEST[cartid]'";
			mysql_query($query);
		}

		// remove the product from the shopping cart and all it's mail forwarding stuff too
		$query = "DELETE FROM Shopping_Cart WHERE Session_ID='$sessionID' and Cart_ID='$_REQUEST[cartid]'";
		mysql_query($query);
		$query = "DELETE FROM SC_MF_Options WHERE Session_ID='$sessionID' and Cart_ID='$_REQUEST[cartid]'";
		mysql_query($query);
		$query = "DELETE FROM SC_VO_Options WHERE Session_ID='$sessionID' and Cart_ID='$_REQUEST[cartid]'";
		mysql_query($query);
	}

	if( $_REQUEST['option'] == 'tel' )
	{
		$_REQUEST['cartid'] = mysql_real_escape_string($_REQUEST['cartid']);
		is_coupon_attached($sessionID, '', $_REQUEST['cartid']);
		if( $coupon_attached == 'yes' )
		{
			// remove the product from the shopping cart and all it's telephony stuff too
			$query = "DELETE FROM Shopping_Cart WHERE Session_ID='$sessionID' and Cart_ID='$coupon_office_cart_id'";
			mysql_query($query);
			$query = "DELETE FROM SC_MF_Options WHERE Session_ID='$sessionID' and Cart_ID='$coupon_office_cart_id'";
			mysql_query($query);
			$query = "DELETE FROM SC_VO_Options WHERE Session_ID='$sessionID' and Cart_ID='$coupon_office_cart_id'";
			mysql_query($query);
			$query = "DELETE FROM SC_Coupon WHERE Session_ID='$sessionID' AND Telephony_Cart_ID='$_REQUEST[cartid]'";
			mysql_query($query);
		}

		// remove the product from the shopping cart and all it's telephony stuff too
		$query = "DELETE FROM SC_CP_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_TEL_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
	}
}

echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Virtual Office, Virtual Office Solutions from Alliance Virtual Offices</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
		                content: $('<span> Entry level plan for startups looking for a way to have the lowest cost presence in a desirable market. <br><span class="bold">Receive mail anywhere; redirect it anywhere.</span> </span>')
		            });
			$('.tooltip2').tooltipster({
				animation: 'fade',   
				theme: 'tooltipster-light',
				trigger: 'hover',
		                content: $('<span> Entry level plan <span class="bold">for startups and small business</span> who want a full virtual presence. Great for those looking for those opening a remote office who need a full local presence. </span>')
		            });
			$('.tooltip3').tooltipster({
				animation: 'fade',   
				theme: 'tooltipster-light',
				trigger: 'hover',
		                content: $('<span> <span class="bold">One of our most popular services.</span> Best for startups and growing businesses who expect to meet with clients and colleagues on a regular basis in a stylish business setting.</span>')
		            });
			$('.tooltip4').tooltipster({
				animation: 'fade',   
				theme: 'tooltipster-light',
				trigger: 'hover',
		                content: $('<span> <span class="bold">Our most popular service.</span> Best for startups and growing businesses who want a full complement of virtual services and who expect to meet with clients and colleagues on a regular basis in a stylish business setting. </span>')
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
			};;
			});
			
        });
    </script>
<script language="JavaScript">
<!--
var cartid;
var option;
function confirm_entry(cartid, option)
{
	input_box=confirm("Are you sure you want to delete this Item?");
	if (input_box==true)
	{ 
		window.location = "cart.php?del=yes&option=" + option + "&cartid=" + cartid + ""; 

	}
}

-->
</script>
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
		
        
        <div class="resutsTop">
        <div class="ResutlsTitle">
        <span class="bold">MY CART</span> &nbsp; <img src="images/myCart.png" class="myCartImg"/>
        
        </div><!--/ResutlsTitle-->
        <div style="clear:both"></div>
        
      
        
        <div class="detailsTopWrap2 changeMtop2">
        
        
        
        <div class="LeftCart">
        
END;
          
					// make google javascript vars
					$vo_skus = array();
					$vo_names = array();
					$vo_center_ids = array();
					$vo_prices = array();
					$vo_records = '0';
					
					$cp_skus = array();
					$cp_names = array();
					$cp_prices = array();
					$cp_records = '0';

					$mr_names = array();
					$mr_center_ids = array();
					$mr_prices = array();
					$mr_records = '0';

					$num = '0';
					$complete_VO_cart_IDs = array();
					$complete_TEL_cart_IDs = array();
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
				
						// get all center info
						get_center_info($LNavCenterData[Center_ID]);
					
						// format the second address
						if( $center_address_2 != '' )
						{
							$center_address_2 = $center_address_2 . '<br>';
						}
						else
						{
							$center_address_2 = '';
						}
				
						// get virtual office package selected for each one
						#-- GET LEFT NAV PACKAGE DETAILS --#
						$GetPackageInfo=mysql_query("SELECT * from SC_VO_Options where Session_ID='$sessionID' AND Cart_ID='$virtual_id'") or die(mysql_error());
						$LNavPackageData = mysql_fetch_array($GetPackageInfo);
				
						$GetPackageDetails=mysql_query("SELECT package.Name, center.Price from Products AS package, Center_Package_Pricing AS center where package.Part_Number='$LNavPackageData[Package_ID]' AND center.Package_ID='$LNavPackageData[Package_ID]' AND center.Center_ID='$LNavCenterData[Center_ID]'") or die(mysql_error());
						$LNavPackageDetails = mysql_fetch_array($GetPackageDetails);
					
						$Disp_Package_Price = $LNavPackageDetails[Price];
						if( $_SESSION['setup_fee'] == '' )
						{
							$Disp_Setup_Price = '100';
						}
						else
						{
							$Disp_Setup_Price = $_SESSION['setup_fee'];
						}

						$Package_Part_Number = $LNavPackageData[Package_ID];
						$Package_Terms = $LNavPackageData[VO_Term];
						$Package_Name = $LNavPackageDetails[Name];
				
						// get mail forwarding info
						#-- GET MF DETAILS --#
						$GetMFInfo=mysql_query("SELECT * from SC_MF_Options where Session_ID='$sessionID' AND Cart_ID='$virtual_id'") or die(mysql_error());
						$LNavMFData = mysql_fetch_array($GetMFInfo);
					
						#-- GET MF PRODUCT DETAILS --#
						$GetProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavMFData[MF_Courier]'") or die(mysql_error());
						$LNavProdData = mysql_fetch_array($GetProdInfo);
					
						#-- CREATE MF VARS --#
						$MF_Courier = $LNavProdData[Name];
						$MF_Freq = $LNavMFData[MF_Frequency];
						if( $MF_Freq == '1' )
						{
							$Disp_MF_Freq = 'Monthly';
						}
						elseif( $MF_Freq == '2' )
						{
							$Disp_MF_Freq = 'Bi-Weekly';
						}
						elseif( $MF_Freq == '4' )
						{
							$Disp_MF_Freq = 'Weekly';
						}
						$MF_Total = $LNavProdData[Price] * $MF_Freq;
				
						$Disp_Package_Price = number_format($Disp_Package_Price, 2, '.', ',');
						$Disp_Setup_Price = number_format($Disp_Setup_Price, 2, '.', ',');
						$MF_Total = number_format($MF_Total, 2, '.', ',');
				
						// get taxes
						Get_Taxes($LNavCenterData[Center_ID], $Disp_Package_Price, $MF_Total, '', '');
				
						// set converted tax vars
						$CenTaxes1Amount = $CenterTax[Taxes1Amount];
						$CenTaxes1Name = $CenterTax[Taxes1Name];
						$CenTaxes2Amount = $CenterTax[Taxes2Amount];
						$CenTaxes2Name = $CenterTax[Taxes2Name];
						$CenTaxes3Amount = $CenterTax[Taxes3Amount];
						$CenTaxes3Name = $CenterTax[Taxes3Name];
						$CenTaxes4Amount = $CenterTax[Taxes4Amount];
						$CenTaxes4Name = $CenterTax[Taxes4Name];
				
			
						// strip commas for the math
						$Math_Package_Price = str_replace(',', '', $Disp_Package_Price);
						$Math_Setup_Price = str_replace(',', '', $Disp_Setup_Price);
						$Math_MF_Total = str_replace(',', '', $MF_Total);
						$Math_CenTaxes1Amount = str_replace(',', '', $CenTaxes1Amount);
						$Math_CenTaxes2Amount = str_replace(',', '', $CenTaxes2Amount);
						$Math_CenTaxes3Amount = str_replace(',', '', $CenTaxes3Amount);
						$Math_CenTaxes4Amount = str_replace(',', '', $CenTaxes4Amount);
				
						// format the numbers
						$line_total = $Math_Package_Price + $Math_Setup_Price + $Math_MF_Total + $Math_CenTaxes1Amount + $Math_CenTaxes2Amount + $Math_CenTaxes3Amount + $Math_CenTaxes4Amount;
				
						$grand_total = $grand_total + $line_total;
				
						// format the numbers
						$line_total = number_format($line_total, 2, '.', ',');

						// see if there are any taxes, if there are then show them
						if( $CenTaxes1Amount != '' )
						{
							$cen_tax_shown = number_format($CenTaxes1Amount, 2, '.', ',');
							$cen_taxes = <<<END
							<br />$CenTaxes1Name: <span class="convert">$$cen_tax_shown</span><br />

END;
						}
	
						echo <<<END
					        <div class="productCartW">
					            <div class="sideCartTL"><h4 class="bold aqua">PRODUCT:</h4></div><div class="sideCartTr orange"><a href="#" onClick="JavaScript:confirm_entry('$virtual_id', 'vo')" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a></div><div class="clear"></div>
					            <p><span class="mediumBold">Virtual Office</span><br><span class="gray3">$center_building_name -  $center_address_1 $center_address_2 $center_city, $center_state_abbrv $center_postal_code</span><br><span class="smallLine mediumBold">$Package_Terms month term</span></p>
					            
					            <table width="100%">
					            <tr>
					            <td class="sideCartL2">$Package_Name:</td><td class="sideCartr2"><span class="mediumBold">$$Disp_Package_Price</span><span class="smallLine gray3"> /month</span></td>
					            </tr>
					            <tr>
					            <td class="sideCartL2">MAIL FORWARDING:</td><td class="sideCartr2"><span class="mediumBold">$$MF_Total</span><span class="smallLine gray3"> /month</span></td>
					            </tr>
					            <tr>
					            <td class="sideCartL2">SET UP FEE:</td><td class="sideCartr2"><span class="mediumBold">$$Disp_Setup_Price</span><span class="smallLine gray3">(one time only)</span></td>
					            </tr>
					            </table>
					            <table width="100%">
					            <tr>
					            <td class="sideCartL2">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
					            </tr>
					            </table>
					           
					          </div><!--/productCartW-->
END;
						// populate the vo javascript vars
						$vo_skus[$vo_records] = $Package_Part_Number;
						$vo_names[$vo_records] = $Package_Name;
						$vo_center_ids[$vo_records] = $LNavCenterData['Center_ID'];
						$vo_prices[$vo_records] = $Disp_Package_Price;
				
						$vo_records++;
					}

					#-- GET MF DETAILS --#
					$GetMFInfo=mysql_query("SELECT * from SC_MF_Options where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
					$LNavMFData = mysql_fetch_array($GetMFInfo);
			
					#-- GET MF PRODUCT DETAILS --#
					$GetProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavMFData[MF_Courier]'") or die(mysql_error());
					$LNavProdData = mysql_fetch_array($GetProdInfo);
			
					#-- CREATE MF VARS --#
					$MF_Courier = $LNavProdData[Name];
					$MF_Freq = $LNavMFData[MF_Frequency];
					if( $MF_Freq == '1' )
					{
						$Disp_MF_Freq = 'Monthly';
					}
					elseif( $MF_Freq == '2' )
					{
						$Disp_MF_Freq = 'Bi-Weekly';
					}
					elseif( $MF_Freq == '4' )
					{
						$Disp_MF_Freq = 'Weekly';
					}
					$MF_Total = $LNavProdData[Price] * $MF_Freq;
					$MF_Total = $exchanger->exchange(USD, $curLabel, $MF_Total, true);
					$USD_MF_Total = $LNavProdData[Price] * $MF_Freq;

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
						#-- GET CP DETAILS --#
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
							#$CP_Total = $exchanger->exchange(USD, $curLabel, $CP_Total, true);
				
							// get taxes
							Get_Taxes($active_center_id, '', '', $CP_Total, $LNavCPData[Com_Plan]);
				
							// set converted tax vars
							$TelTaxes1Amount = $TeleTax[Taxes1Amount];
							$TelTaxes1Name = $TeleTax[Taxes1Name];
							$TelTaxes2Amount = $TeleTax[Taxes2Amount];
							$TelTaxes2Name = $TeleTax[Taxes2Name];
							$TelTaxes3Amount = $TeleTax[Taxes3Amount];
							$TelTaxes3Name = $TeleTax[Taxes3Name];
							$TelTaxes4Amount = $TeleTax[Taxes4Amount];
							$TelTaxes4Name = $TeleTax[Taxes4Name];


							// strip commas for the math
							$Math_CP_Total = str_replace(',', '', $CP_Total);
							$Math_TelTaxes1Amount = str_replace(',', '', $TelTaxes1Amount);
							$Math_TelTaxes2Amount = str_replace(',', '', $TelTaxes2Amount);
							$Math_TelTaxes3Amount = str_replace(',', '', $TelTaxes3Amount);
							$Math_TelTaxes4Amount = str_replace(',', '', $TelTaxes4Amount);

							// format the numbers
							$line_total = $Math_CP_Total + $Math_TelTaxes1Amount + $Math_TelTaxes2Amount + $Math_TelTaxes3Amount + $Math_TelTaxes4Amount;

							$grand_total = $grand_total + $line_total;

							$line_total = number_format($line_total, 2, '.', ',');
							$CP_Total = number_format($CP_Total, 2, '.', ',');
	
							if( $tel_error != 'yes' )
							{
								// see if there are any taxes, if there are then show them
								if( $TelTaxes1Amount != '' )
								{
									$tax_shown = number_format($TelTaxes1Amount, 2, '.', ',');
									$taxes = <<<END
									<br />$TelTaxes1Name: <span class="convert">$$tax_shown</span><br />

END;
								}
								echo <<<END
							          <div class="productCartW">
							            <div class="sideCartTL"><h4 class="bold aqua">PRODUCT:</h4></div><div class="sideCartTr orange"><a href="#" onClick="JavaScript:confirm_entry('$virtual_id', 'tel')" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a></div><div class="clear"></div>
							            <p><span class="mediumBold">$CP_Plan</span><br></p>
							            
							            <table width="100%">
							            <tr>
							                <td class="sideCartL2">Price:</td><td class="sideCartr2"><span class="mediumBold">$$CP_Total</span></td>
							            </tr>
								    <tr>
								       <td class="sideCartL3">$taxes</td>
								    </tr>
							            </table>
							            <table width="100%">
							            <tr>
							            <td class="sideCartL2">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
							            </tr>
							            </table>
							           
							          </div><!--/productCartW-->
END;
							}
							else
							{
								// remove the product from the shopping cart and all it's telephony stuff too
								$query = "DELETE FROM SC_CP_Options WHERE Session_ID='$sessionID'";
								mysql_query($query);
								$query = "DELETE FROM SC_TEL_Options WHERE Session_ID='$sessionID'";
								mysql_query($query);
								echo <<<END
							<tr class="cart-items">
								<td colspan="6">
								<div style="color: red; font-weight: bold;">Error!</div> The telephony plan you selected is not compatible with the Virtual Office location in your cart. Please <a href="telephony-options.php">click here</a> to select a compatible plan.
								</td>
							</tr>
END;
							}
							// populate the cp javascript vars
							$cp_skus[$cp_records] = $LNavCPData['Com_Plan'];
							$cp_names[$cp_records] = $CP_Plan;
							$cp_prices[$cp_records] = $CP_Total;
				
							$cp_records++;
						}
					}
					else
					{	
						#-- GET CP DETAILS --#
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
					
								$grand_total = $grand_total + $CP_Total;
					
								// format the numbers
								$line_total = number_format($CP_Total, 2, '.', ',');
								$CP_Total = number_format($CP_Total, 2, '.', ',');
		
								echo <<<END
							          <div class="productCartW">
							            <div class="sideCartTL"><h4 class="bold aqua">PRODUCT:</h4></div><div class="sideCartTr orange"><a href="#" onClick="JavaScript:confirm_entry('$virtual_id', 'tel')" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a></div><div class="clear"></div>
							            <p><span class="mediumBold">$CP_Plan</span><br></p>
							            
							            <table width="100%">
							            <tr>
							                <td class="sideCartL2">Price:</td><td class="sideCartr2"><span class="mediumBold">$$CP_Total</span></td>
							            </tr>
								    <tr>
								       <td class="sideCartL3">$taxes</td>
								    </tr>
							            </table>
							            <table width="100%">
							            <tr>
							            <td class="sideCartL2">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
							            </tr>
							            </table>
							           
							          </div><!--/productCartW-->
END;
							}
							// populate the cp javascript vars
							$cp_skus[$cp_records] = $LNavCPData['Com_Plan'];
							$cp_names[$cp_records] = $CP_Plan;
							$cp_prices[$cp_records] = $CP_Total;
				
							$cp_records++;
						}
					}

					// show meeting room info
					$GetMRInfo = mysql_query("SELECT * from SC_MR where Session_ID = '$sessionID'") or die("error MR: " . mysql_error());
					while( $MRData = mysql_fetch_array($GetMRInfo))
					{
						$meeting_room_in_cart = 'yes';
						get_meeting_room_info($MRData[Meeting_Room_ID]);
				
						// format the second address
						if( $mr_center_address2 != '' )
						{
							$mr_center_address2 = $mr_center_address2 . '<br>';
						}
						else
						{
							$mr_center_address2 = '';
						}
				
						// same thing with the cener name
						if( $mr_center_building_name != '' )
						{
							$mr_center_building_name = $mr_center_building_name . '<br>';
						}
						else
						{
							$mr_center_building_name = '';
						}
				
						// fix display time
						$stime_in_12_hour_format  = DATE("g:i a", STRTOTIME($MRData[Start_Time]));
						$etime_in_12_hour_format  = DATE("g:i a", STRTOTIME($MRData[End_Time]));
				
						// adjust money
						$mr_total_disp = number_format($MRData[Total], 2, '.', ',');
						$line_total = $line_total + $mr_total_disp;
						$line_total = number_format($line_total, 2, '.', ',');		
				
						// get extras for this meeting room
						$extraQuery = mysql_query("SELECT * from SC_MR_Options where Session_ID = '$sessionID' and Meeting_Room_ID = '$MRData[Meeting_Room_ID]'");
						while( $extraData = mysql_fetch_array($extraQuery) )
						{
							$thisRowTotal = number_format($extraData[Total], 2, '.', ',');
							$line_total = $line_total + $thisRowTotal;
							echo <<<END
							<!-- $extraData[Name]: <span class="convert">$$thisRowTotal</span> <br /> -->
END;
						}
				
						$line_total = number_format($line_total, 2, '.', ',');
						$full_line_total = $line_total;
						$line_total = round( (($line_total * $mr_center_percentage) / 100 ), 2);
						$line_total = number_format($line_total, 2, '.', ',');
						$grand_total = $grand_total + $line_total;
						$difference_total = number_format(($full_line_total - $line_total), 2, '.', ',');

						echo <<<END

					          <div class="productCartW">
					            <div class="sideCartTL"><h4 class="bold aqua">PRODUCT:</h4></div><div class="sideCartTr orange"><a href="#" onClick="JavaScript:confirm_entry('$virtual_id', 'vo')" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a></div><div class="clear"></div>
					            <p><span class="mediumBold">$MRData[Name]</span><br><span class="gray3">$mr_center_building_name<br /> $mr_center_address1 $mr_center_address2 $mr_center_city $mr_center_state $mr_center_zip</span><br><span class="smallLine mediumBold">$MRData[Meeting_Date]<br>$stime_in_12_hour_format - $etime_in_12_hour_format</span></p>
					            
					            <table width="100%">
					            <tr>
					            <td class="sideCartL2">MEETING ROOM:</td><td class="sideCartr2"><span class="mediumBold">$$mr_total_disp</span></td>
					            </tr>
					            <tr>
					            <td class="sideCartL2">TOTAL AMOUNT:</td><td class="sideCartr2"><span class="mediumBold">$$full_line_total</span></td>
					            </tr>
					            <tr>
					            <td class="sideCartL2">$mr_center_percentage% DUE NOW:</td><td class="sideCartr2"><span class="mediumBold">$$line_total</span></td>
					            </tr>
					            </table>
					            <table width="100%">
					            <tr>
					            <td class="sideCartL2">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
					            </tr>
					            </table>
					           
					          </div><!--/productCartW-->
END;
						
						// populate javascript vars
						$mr_names[$mr_records] = $MRData[Name];
						$mr_center_ids[$mr_records] = $mr_center_id;
						$mr_prices[$mr_records] = $mr_total_disp;

						$mr_records++;
					}

					// show empty cart message if it's empty
					if( $location_in_cart == 'no' && $telephony_in_cart == 'no' && $meeting_room_in_cart == 'no' )
					{
						echo <<<END
				    		<tr class="cart-items">
				        		<td colspan="6">
							Your cart is empty
							</td>
				       		</tr>
END;
					}

					// close up the table
					$grand_total = number_format($grand_total, 2, '.', ',');

echo <<<END
        </div><!--/LeftCart-->
        
        <div class="dsidecart radiusTop">
        	<div class="contactPhonesCart">
            <div class="centerForm">
            NORTH AMERICA:    +1 888.869.9494<br>
	    INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhonesCart-->
            
            <div class="clear"></div>
            <div class="theSideCartWrap changeMtop">
            <div class="MyCart2">ORDER TOTAL: &nbsp; <span class="aqua">$$grand_total</span></div><!--/MyCart-->
            
            <a href="https://www.alliancevirtualoffices.com/1_9/checkout-review.php" style="text-decoration: none;"><div class="sideCartLine"><div class="aquaBtn">PLACE ORDER NOW</div></div></a><!--/sideCartLine-->
            <div class="clear"></div>
            <div class="bottomSideCart hide">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div><!--/bottomSideCart-->
            </div><!--/theSideCartWrap-->
        </div><!--/dsidecart-->
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
        
     
        
       
        </div><!--/resutsTop-->
        
       
        
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