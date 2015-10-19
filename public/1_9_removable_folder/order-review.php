<?php
include '../email_conf.php';
include ("../connect_db.php");
include ("../siteFunctions.php");

$cartID = mysql_real_escape_string($_COOKIE['CINFO']);
$customerID = mysql_real_escape_string($_COOKIE['CUSTINFO']);
$wsID = mysql_real_escape_string($_COOKIE['OID']);

// if they've confirmed then do it
if( $_POST['step'] == 'next' )
{
	// telephony only cart - defaulted to yes
	$tocart = 'yes';

	// if this is a telephony plan with a number selected then lets reserve the number. If it's not available we'll throw an error and reset. Invoice will not be created yet...

	// get the call plan details
	$GetDVProd1=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die("Error01r:" .mysql_error());
	while( $DVProdData1 = mysql_fetch_array($GetDVProd1) )
	{
		// if it's a plan that would have a number then try to reserve it
		if( ($DVProdData1['Com_Plan'] == '401') || ($DVProdData1['Com_Plan'] == '402') || ($DVProdData1['Com_Plan'] == '403') || ($DVProdData1['Com_Plan'] == '404') || ($DVProdData1['Com_Plan'] == '405') || ($DVProdData1['Com_Plan'] == '406') || ($DVProdData1['Com_Plan'] == '407') || ($DVProdData1['Com_Plan'] == '408') || ($DVProdData1['Com_Plan'] == '409') || ($DVProdData1['Com_Plan'] == '410') )
		{
			// get the number they selected
			$GetNumber=mysql_query("SELECT * from SC_TEL_Options where Session_ID='$sessionID' and Cart_ID='$DVProdData1[Cart_ID]'") or die("Error01f:" .mysql_error());
			$PhoneNumberData = mysql_fetch_array($GetNumber);
			$phone_number = $PhoneNumberData['Number'];
			// if it's one of the phone.com part numbers then we'll do the reservation
			$post_array = array 
			(
					"action"		=>	"reservePhoneNumber",
					"username" 		=>	"abcn",
					"password"		=>	'Jn5Gzc4%',
					"clTRID"		=>	"12345678",
					"phoneNumber"		=>	"$phone_number"
			);
			reset ($post_array);
		
			foreach ($post_array as $key => $val) 
			{
				$data .= $key."=".urlencode ($val)."&"; // setup the data properly for a POST action
			}
		
			$ch=curl_init('https://control.phone.com/special/xmlapi');
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			$response = curl_exec($ch);
	
			// check for confirmation
			preg_match_all( "/\<response\>(.*?)\<\/response\>/s", $response, $numberblocks );
			foreach( $numberblocks[1] as $block )
			{
				preg_match_all( "/\<msg\>(.*?)\<\/msg\>/", $block, $msg );
				$message = $msg[1][0];
			}
			
			/*
			if( $message == 'Command completed successfully' )
			{
				1;
			}
			else
			{
				$error = array("$message - $phone_number" . ' The phone number you selected is no longer available. Please <a href="telephony-chooser2.php">go back</a> and select another number.<br>Thank You.');
				dispErrors($error);
				exit;
			}
			*/
		}
	}

	// add invoice to db
	$status = '';
	$cartTime = time();
	$AddProdsToCart=mysql_query("INSERT into Invoices values ('','$customerID','Processing','$cartTime','','','','$ipAddress','')") or die("Error01:" . mysql_error());
	$invoiceID = mysql_insert_id();

	// get customer info
	$GetInvCustInfo=mysql_query("SELECT * from Customers where Customer_ID='$customerID'") or die(mysql_error());
	$CustInvData = mysql_fetch_array($GetInvCustInfo);

	// status is always good because it doesn't get charged till we have all the info needed
	$status = 'SUCCESS'; 
	if( $status == 'SUCCESS' )
	{
		// Do all the telphony stuff first since there can only be one telephony plan in cart
		$CP_Total = '';
		$CP_Plan = '';
		$Disp_Setup_Price = '';
		$Total_Setup_Price = '';

		// get call plan info for this cart ID
		$GetCPInfo=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die(mysql_error());
		while( $LNavCPData = mysql_fetch_array($GetCPInfo) )
		{
			$tel_cart_id = $LNavCPData[Cart_ID];
			
			// get call plan product info for this cart ID
			$GetCPProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavCPData[Com_Plan]'") or die(mysql_error());
			$LNavCPProdData = mysql_fetch_array($GetCPProdInfo);
		
			// create call plan vars
	
			// check to see if there is a euro center in the DB
			$GetCenterID=mysql_query("SELECT Center_ID from Shopping_Cart where Session_ID='$sessionID'") or die(mysql_error());
			while( $CenterIDData = mysql_fetch_row($GetCenterID) )
			{
				customTelephonyCheck($CenterIDData[0]);
				// if a center has a custom telephony plan then we'll break out of the loop
				if( $customTelephonyCenter == 'C' )
				{
					$active_center_id = $CenterIDData[0];
					break;
				}
			}
	
			if( $LNavCPData['Com_Plan'] == '309' )
			{
				$CP_Plan = $TDataName1;
				$CP_Total = $TDataPrice1;
				$LNavCPProdData['Price'] = $TDataPrice1;
			}
			elseif( $LNavCPData['Com_Plan'] == '310')
			{
				$CP_Plan = $TDataName2;
				$CP_Total = $TDataPrice2;
				$LNavCPProdData['Price'] = $TDataPrice2;
			}
			elseif( $LNavCPData['Com_Plan'] == '311' )
			{
				$CP_Plan = $TDataName3;
				$CP_Total = $TDataPrice3;
				$LNavCPProdData['Price'] = $TDataPrice3;
			}
			else
			{
				$CP_Plan = $LNavCPProdData['Name'];
				$CP_Total = $LNavCPProdData['Price'];
			}
		
			// get telephone number selected for this cart ID
			$GetCPNumberInfo=mysql_query("SELECT * from SC_TEL_Options where Session_ID='$sessionID' AND Cart_ID='$LNavCPData[Cart_ID]'") or die(mysql_error());
			$LNavCPNumberData = mysql_fetch_array($GetCPNumberInfo);
			$selected_phone_number = $LNavCPNumberData['Number'];

			// add telephony parts to DB
			$AddCPToCart=mysql_query("INSERT into Invoices_CP_Options values ('$invoiceID','$LNavCPData[Cart_ID]','$LNavCPData[Com_Plan]','$LNavCPProdData[Price]')") or die("Error4:" . mysql_error());
			$AddCPNumber=mysql_query("INSERT into Invoices_TEL_Options values ('$invoiceID','$selected_phone_number')") or die("Error45.4:" . mysql_error());
			$AddAssoc = mysql_query("INSERT into Invoices_TEL_IDs values ('$invoiceID','$LNavCPData[Cart_ID]','$selected_phone_number')") or die("Error 568: " . mysql_error());
		}

		// add tax info to cart for this cart ID
		Get_Taxes($active_center_id, '', '', $CP_Total, $LNavCPData['Com_Plan']);

		// set converted tax vars
		$telTaxes1Amount = $TeleTax['Taxes1Amount'];
		$telTaxes1Name = $TeleTax['Taxes1Name'];
		$telTaxes2Amount = $TeleTax['Taxes2Amount'];
		$telTaxes2Name = $TeleTax['Taxes2Name'];
		$telTaxes3Amount = $TeleTax['Taxes3Amount'];
		$telTaxes3Name = $TeleTax['Taxes3Name'];
		$telTaxes4Amount = $TeleTax['Taxes4Amount'];
		$telTaxes4Name = $TeleTax['Taxes4Name'];

		$AddTaxesToCart2=mysql_query("INSERT into Invoices_Taxes values ('$invoiceID','$tel_cart_id','','$telTaxes1Name','$telTaxes1Amount','$telTaxes2Name','$telTaxes2Amount','$telTaxes3Name','$telTaxes3Amount','$telTaxes4Name','$telTaxes4Amount')") or die("Error233:" . mysql_error());
		$CP_Taxes = $telTaxes1Amount + $telTaxes2Amount + $telTaxes3Amount + $telTaxes4Amount;

		// add any telephony coupons
		$GetTelCouponInfo=mysql_query("SELECT * from SC_Coupon where Session_ID='$sessionID' AND Telephony_Cart_ID='$cartID'") or die(mysql_error());
		$CouponTelData = mysql_fetch_array($GetTelCouponInfo);

		if( $CouponTelData['Object_ID'] != '' )
		{
			$coupon_name_text = $CouponTelData['Text'] . '[]' . $CouponTelData['Amount'];
			$AddTelCoupon=mysql_query("INSERT into New_Charges values ('','$invoiceID','$customerID','$CouponTelData[Amount]','Ready','$cartTime','$coupon_name_text','$cartTime')") or die("Error3:" . mysql_error());
		}


		// --------------------------------------------------------------------------------------------------------
		// start processing the virtual office part of the order

		$complete_VO_cart_IDs = array();
		$complete_TEL_cart_IDs = array();
		$mr_cart_yes = 'no';

		// select all carts with this session ID
		$GetVOCart=mysql_query("SELECT * from Shopping_Cart where Session_ID='$sessionID'");
		while( $CartData=mysql_fetch_array($GetVOCart) )
		{
			// check to make sure that it has an associated mail forwarding entry, if it is it's considered a complete item
			$GetMFCart=mysql_query("SELECT * from SC_MF_Options where Session_ID='$sessionID' and Cart_ID='$CartData[Cart_ID]'");
			$MFData=mysql_fetch_array($GetMFCart);
	
			// these are the complete carts
			if( $MFData['MF_Courier'] != '' )
			{
				$tocart = 'no';
				$cartID = $CartData['Cart_ID'];
				$Disp_Package_Price = '';
				$MF_Total = '';

				// get virtual office terms and package info for this cart ID
				$GetPackageInfo=mysql_query("SELECT * from SC_VO_Options where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
				$LNavPackageData = mysql_fetch_array($GetPackageInfo);
	
				// get center info for this cart ID
				$GetCenterInfo=mysql_query("SELECT * from Shopping_Cart where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
				$LNavCenterData = mysql_fetch_array($GetCenterInfo);
	
				// get virtual office package details for this cart ID
				$GetPackageDetails=mysql_query("SELECT package.Name, center.Price from Products AS package, Center_Package_Pricing AS center where package.Part_Number='$LNavPackageData[Package_ID]' AND center.Package_ID='$LNavPackageData[Package_ID]' AND center.Center_ID='$LNavCenterData[Center_ID]'") or die(mysql_error());
				$LNavPackageDetails = mysql_fetch_array($GetPackageDetails);
	
				// create virtual office package vars
				$Disp_Package_Price = $LNavPackageDetails['Price'];
				$Package_Part_Number = $LNavPackageData['Package_ID'];
				$Package_Terms = $LNavPackageData['VO_Term'];
				$Package_Name = $LNavPackageDetails['Name'];
				$centerID = $LNavCenterData['Center_ID'];
				if( $_SESSION['setup_fee'] == '' )
				{
					$Disp_Setup_Price = '100';
				}
				else
				{
					$Disp_Setup_Price = $_SESSION['setup_fee'];
				}
				$Total_Setup_Price = $Total_Setup_Price + $Disp_Setup_Price;
	
				// get mail forwarding info for this cart ID
				$GetMFInfo=mysql_query("SELECT * from SC_MF_Options where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
				$LNavMFData = mysql_fetch_array($GetMFInfo);
	
				// get mail forwarding product info for this cart ID
				$GetProdInfo=mysql_query("SELECT * from Products where Part_Number='$LNavMFData[MF_Courier]'") or die(mysql_error());
				$LNavProdData = mysql_fetch_array($GetProdInfo);
	
				// create mail forwarding vars
				$MF_Courier = $LNavProdData['Name'];
				$MF_Freq = $LNavMFData['MF_Frequency'];
				$MF_Total = $LNavProdData['Price'] * $MF_Freq;
	
				// get taxes info
				Get_Taxes($LNavCenterData['Center_ID'], $Disp_Package_Price, $MF_Total, $CP_Total, $LNavCPData['Com_Plan']);

				// set converted tax vars
				$Taxes1Amount = $CenterTax['Taxes1Amount'];
				$Taxes1Name = $CenterTax['Taxes1Name'];
				$Taxes2Amount = $CenterTax['Taxes2Amount'];
				$Taxes2Name = $CenterTax['Taxes2Name'];
				$Taxes3Amount = $CenterTax['Taxes3Amount'];
				$Taxes3Name = $CenterTax['Taxes3Name'];
				$Taxes4Amount = $CenterTax['Taxes4Amount'];
				$Taxes4Name = $CenterTax['Taxes4Name'];
	
				// add tax info to cart for this cart ID
				$AddTaxesToCart=mysql_query("INSERT into Invoices_Taxes values ('$invoiceID','$cartID','$centerID','$Taxes1Name','$Taxes1Amount','$Taxes2Name','$Taxes2Amount','$Taxes3Name','$Taxes3Amount','$Taxes4Name','$Taxes4Amount')") or die("Error233:" . mysql_error());
	
				// get totals
				$Temp_Total = $Disp_Package_Price + $Disp_Setup_Price + $MF_Total + $Taxes1Amount + $Taxes2Amount + $Taxes3Amount + $Taxes4Amount;
				$Temp_Total = number_format($Temp_Total, 2, '.', ',');
				$Complete_Total = $Complete_Total + $Temp_Total;

	
				// add invoice data to DBS
				
				#-- Addslashes for DB --#
				$LNavMFData['First_Name'] = addslashes($LNavMFData['First_Name']);
				$LNavMFData['Last_Name'] = addslashes($LNavMFData['Last_Name']);
				$LNavMFData['Company'] = addslashes($LNavMFData['Company']);
				$LNavMFData['Address_1'] = addslashes($LNavMFData['Address_1']);
				$LNavMFData['Address_2'] = addslashes($LNavMFData['Address_2']);
				$LNavMFData['City'] = addslashes($LNavMFData['City']);
	
				// add the virtual office info
				$AddVOToCart=mysql_query("INSERT into Invoices_VO_Options values ('$invoiceID','$cartID','$centerID','$Package_Part_Number','$Package_Terms','$Disp_Package_Price')") or die("Error2:" . mysql_error());
				$AddMFToCart=mysql_query("INSERT into Invoices_MF_Options values ('$invoiceID','$cartID','$LNavMFData[MF_Courier]','$MF_Freq','$LNavMFData[First_Name]','$LNavMFData[Last_Name]','$LNavMFData[Address_1]','$LNavMFData[Company]','$LNavMFData[Address_2]','$LNavMFData[City]','$LNavMFData[State]','$LNavMFData[Postal_Code]','$LNavMFData[Country]','$MF_Total')") or die("Error3:" . mysql_error());
				$AddFeesToCart=mysql_query("INSERT into Invoices_Fees values ('$invoiceID','$cartID','$Disp_Setup_Price')") or die("Error5:" . mysql_error());

				// check for coupons and add them if necessary
				$GetCouponInfo=mysql_query("SELECT * from SC_Coupon where Session_ID='$sessionID' AND Cart_ID='$cartID'") or die(mysql_error());
				$CouponData = mysql_fetch_array($GetCouponInfo);

				if( $CouponData['Object_ID'] != '' )
				{
					$coupon_name_text = $CouponData['Text'] . '[]' . $CouponData['Amount'];
					$AddCoupon=mysql_query("INSERT into New_Charges values ('','$invoiceID','$customerID','$CouponData[Amount]','Ready','$cartTime','$coupon_name_text','$cartTime')") or die("Error3:" . mysql_error());
				}
			}

			// now check for meeting rooms, might as well do it in this loop
			if( $CartData['Center_ID'] == 'MR' )
			{
				$mr_cart_yes = 'yes';
				$amenities = array();
				$thisone = '';
				// get meeting room info
				$getMRCart = mysql_query("SELECT * from SC_MR where Session_ID = '$sessionID'");
				$MRCartInfo = mysql_fetch_array($getMRCart);

				$MR_Temp_Total = ($MR_Temp_Total + $MRCartInfo['Total']);
				
				// get the %
				get_meeting_room_info($MRCartInfo['Meeting_Room_ID']);
				$dp_total = round( (($MRCartInfo['Total'] * $mr_center_percentage) / 100 ), 2);
				$dp_total = number_format($dp_total, 2, '.', ',');

				$AddMRToCart=mysql_query("INSERT into Invoices_MR values ('$invoiceID','$MRCartInfo[Meeting_Room_ID]','$MRCartInfo[Name]','$MRCartInfo[Rate]','$MRCartInfo[Duration]','$MRCartInfo[Meeting_Date]','$MRCartInfo[Start_Time]','$MRCartInfo[End_Time]', '$MRCartInfo[Total]', '$dp_total')") or die("Error1mr:" . mysql_error());

				// get all options for this entry and write them into the invoice
				$getMRCartExtras = mysql_query("SELECT * from SC_MR_Options where Session_ID = '$sessionID' and Meeting_Room_ID = '$MRCartInfo[Meeting_Room_ID]'");
				while( $MRCartExtrasData = mysql_fetch_array($getMRCartExtras) )
				{
					// get the %
					$dp_option_total = round( (($MRCartExtrasData['Total'] * $mr_center_percentage) / 100 ), 2);
					$dp_option_total = number_format($dp_option_total, 2, '.', ',');

					$MR_Temp_Total = $MR_Temp_Total + $MRCartExtrasData['Total'];
					$AddMRXtrasToCart=mysql_query("INSERT into Invoices_MR_Options values ('$invoiceID','$MRCartExtrasData[Meeting_Room_ID]','$MRCartExtrasData[Name]','$MRCartExtrasData[Rate]','$MRCartExtrasData[Duration]','$MRCartExtrasData[Total]', '$dp_option_total')") or die("Error2mr:" . mysql_error());

					// make amenities var
					$remainder_total = ($MRCartExtrasData['Total'] - $dp_option_total);
					$remainder_total = number_format($remainder_total, 2, '.', ',');
					$thisone = $MRCartExtrasData['Name'] . '||' . $remainder_total;
					array_push($amenities, $thisone);
				}

				// get totals
				$MR_Temp_Total = number_format($MR_Temp_Total, 2, '.', ',');
				$Complete_Total = $Complete_Total + $MR_Temp_Total;
	
				// make vars for the email
				$stime_in_12_hour_format  = DATE("g:i a", STRTOTIME($MRCartInfo['Start_Time']));
				$etime_in_12_hour_format  = DATE("g:i a", STRTOTIME($MRCartInfo['End_Time']));

				$meeting_date = $MRCartInfo['Meeting_Date'];
				$meeting_time = "$stime_in_12_hour_format" . ' - ' . "$etime_in_12_hour_format";
				$total_charge = $Complete_Total;
				$percentage_charge = $dp_total;
				$percentage = $mr_center_percentage;
				$meeting_center = "$mr_center_building_name, $mr_center_address1, $mr_center_address2, $mr_center_city, $mr_center_state, $mr_center_zip";
				$meeting_room_name = $mr_name;
				$mr_hourly_rate = $mr_rate;

				// now owner email stuff
				$owner_full_name = $mr_center_owner_name;
				$owner_email = $mr_center_owner_email;
				$owner_percentage_charge = ($MRCartInfo['Total'] - $dp_total);
				$owner_percentage_charge = number_format($owner_percentage_charge, 2, '.', ',');
			}
		}

		$Complete_Total = $Complete_Total + $CP_Total + $CP_Taxes;

		// update invoices and customer db tables
		$Complete_Total = number_format($Complete_Total, 2, '.', ',');
		$query = "UPDATE Invoices SET Auth_Code='$auth',Sub_Total='$Complete_Total',Total='$Complete_Total', Status='New' WHERE Invoice_Number='$invoiceID'";
		mysql_query($query) or die('Error1, query failed');

		$query = "UPDATE Customers SET Status='Active' WHERE Customer_ID='$customerID'";
		mysql_query($query) or die('Error2, query failed');

		// add whitesite entry if applicable
		if( $wsID != '' )
		{
			$GetWSOwnerInfo=mysql_query("SELECT * from Owner_Logins where Object_ID='$wsID'") or die(mysql_error());
			$WSData = mysql_fetch_array($GetWSOwnerInfo);
				
			$WSOwnerID = $WSData['Owner_ID'];				

			$wstime = time();
			$AddWhiteSite=mysql_query("INSERT into Whitesite_Invoices values ('','$invoiceID','$WSOwnerID','$wstime','$customerID')") or die("Error66:" . mysql_error());
		}

		// GET CUSTOMER INFO
		$CustData = $CustInvData;

		// GET PACKAGE, REGION & PHONE DATA FOR EMAILS
		$GetPackageInfo=mysql_query("SELECT * from SC_VO_Options where Session_ID='$sessionID'") or die(mysql_error());
		$LNavPackageData = mysql_fetch_array($GetPackageInfo);

		$GetCPInfo=mysql_query("SELECT * from SC_CP_Options where Session_ID='$sessionID'") or die(mysql_error());
		$LNavCPData = mysql_fetch_array($GetCPInfo);

		$GetRegionInfo=mysql_query("SELECT * from Center where CenterID='$centerID'") or die(mysql_error());
		$RegionData = mysql_fetch_array($GetRegionInfo);

		// SEND CONFIRMATION EMAILS 
		if( $mr_cart_yes == 'no' )
		{
			compose_emails_mandrill($LNavPackageData['Package_ID'], $LNavCPData['Com_Plan'], $CustData['First_Name'], $CustData['Last_Name'], $CustData['Email'], $Complete_Total, $invoiceID, $phone_number, $RegionData['Country']);
			company_emails($LNavPackageData['Package_ID'],$LNavCPData['Com_Plan'],$CustData['First_Name'],$CustData['Last_Name'],'services@alliancevirtualoffices.com',$Complete_Total,$invoiceID,$BonusData['Bonus_2'],$BonusData['Bonus_3'],$BonusData['Bonus_4'],$BonusData['Bonus_5'],$BonusData['Bonus_6'],$centerID,$phone_number,$CustData['Password'],$CustData['Username']);
		}
		else
		{
			send_mr_email_client($invoiceID, $CustData['First_Name'], $CustData['Last_Name'], $CustData['Email'], $meeting_date, $meeting_time, $total_charge, $percentage_charge, $amenities, $percentage, $meeting_center, $meeting_room_name);
			company_emails($LNavPackageData['Package_ID'],$LNavCPData['Com_Plan'],$CustData['First_Name'],$CustData['Last_Name'],'services@alliancevirtualoffices.com',$Complete_Total,$invoiceID,$BonusData['Bonus_2'],$BonusData['Bonus_3'],$BonusData['Bonus_4'],$BonusData['Bonus_5'],$BonusData['Bonus_6'],$centerID,$phone_number,$CustData['Password'],$CustData['Username']);
		}

		// REMOVE JUNK FROM SHOPPING CART DBS
		$query = "DELETE FROM Shopping_Cart WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_Bonus_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_CP_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC__Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_MF_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_VO_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_MR WHERE Session_ID='$sessionID'";
		mysql_query($query);
		$query = "DELETE FROM SC_MR_Options WHERE Session_ID='$sessionID'";
		mysql_query($query);

		// KILL COOKIE AND MOVE ON 
		makeCookie22(junk);
		header("Location: confirmation.php?invoice=$invoiceID");

		// ADD RECURRING INFO
		$chargedate = date("d");
		$remaining = $Package_Terms - 1;
		$charge_me = $Complete_Total - $Total_Setup_Price;
		$AddRecurringMain=mysql_query("INSERT into Recurring_Charges values ('','$customerID','$chargedate','$charge_me','Pending','$invoiceID','$cartID','$remaining')") or die("Error7:" . mysql_error());
		//$AddRecurringInvoice=mysql_query("INSERT into Recurring_Invoices values ('','$customerID','Pending','','','','$invoiceID','$cartID')") or die("Error7:" . mysql_error());

		// add to the affiliate table if necessary
		if( $affiliate_id != '' )
		{
			$AddAffiliate=mysql_query("INSERT into Affiliate_Invoices values ('','$affiliate_id','$ad_id','$invoiceID')") or die("Error45.8:" . mysql_error());
		}
	}
	else
	{
		$query = "UPDATE Invoices SET Status='Declined', Auth_Code='$status' WHERE Invoice_Number='$invoiceID'";
		mysql_query($query) or die('Error99, query failed');

		$error = array('There was a problem with your credit card. Please <a href="customer-information.php">go back</a> and enter a new card.<br>Thank You.');
		dispErrors($error);
	}
}

$Complete_Total = '';
$meeting_room_cart = 'no';
$top_review_text = 'Please review your order below';

// check to see if it's a meeting room
$mr_check_query = mysql_query("SELECT * from Shopping_Cart where Session_ID = '$sessionID'");
$mr_check_data = mysql_fetch_array($mr_check_query);
if( $mr_check_data['Center_ID'] == 'MR' )
{ 
	$meeting_room_cart = 'yes';
	$top_review_text = 'Please review your order request. Alliance will confirm your request as soon as possible. Please be advised that this time is not guaranteed until we have confirmed your request!';
}

$telephony_in_cart = 'no';
$location_in_cart = 'no';
$meeting_room_in_cart = 'no';

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
                content: $('<span>About this charge</span>')
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
            <div class="theSideCartWrap changeMtop">
            <div class="MyCart"><div class="mcartTxt">MY CART</div> <img src="images/myCart.png" class="myCartImg"/></div><!--/MyCart-->
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
					            <div class="eachSCartWrap marginTop paddingtop">
						            <h3 class=" bold">Virtual Office</h3>
						            <h4 class="bold blue">ADDRESS</h4>
						            <p><span class="mediumBold">$center_building_name</span><br>
						            $center_address_1 $center_address_2 $center_city, $center_state_abbrv $center_postal_code<br><span class="smallLine mediumBold">$Package_Terms month term</span></p>
						            <table width="100%">
						            <tr>
						            <td class="sideCartL3">$Package_Name:</td><td class="sideCartr2"><span class="mediumBold">$$Disp_Package_Price</span><span class="smallLine gray3"> /month</span></td>
						            </tr>
						            <tr>
						            <td class="sideCartL3">MAIL FORWARDING:</td><td class="sideCartr2"><span class="mediumBold">$$MF_Total</span><span class="smallLine gray3"> /month</span></td>
						            </tr>
						            <tr>
						            <td class="sideCartL3">SET UP FEE:</td><td class="sideCartr2"><span class="mediumBold">$$Disp_Setup_Price</span> <span class="smallLine gray3">(one time only)</span></td>
						            </tr>
						            </table>
						            <table width="100%">
						            <tr>
						            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
						            </tr>
						            </table>
					            </div><!--/eachSCartWrap-->
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
							            <div class="eachSCartWrap marginTop paddingtop">
								            <h3 class=" bold">Phone Plan</h3>
								            <table width="100%">
								            <tr>
								              <td class="sideCartL3">$CP_Plan:</td><td class="sideCartr2"><span class="mediumBold">$$CP_Total</span><span class="smallLine gray3"> /month</span></td>
								            </tr>
								            <tr>
								              <td class="sideCartL3">$taxes</td>
								            </tr>
								            </table>
								            <table width="100%">
								            <tr>
								            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
								            </tr>
								            </table>
							            </div><!--/eachSCartWrap-->
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
							            <div class="eachSCartWrap marginTop paddingtop">
								            <h3 class=" bold">Phone Plan</h3>
								            <table width="100%">
								            <tr>
								              <td class="sideCartL3">$CP_Plan:</td><td class="sideCartr2"><span class="mediumBold">$$CP_Total</span><span class="smallLine gray3"> /month</span></td>
								            </tr>
								            <tr>
								              <td class="sideCartL3">$taxes</td>
								            </tr>
								            </table>
								            <table width="100%">
								            <tr>
								            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
								            </tr>
								            </table>
							            </div><!--/eachSCartWrap-->
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
					            <div class="eachSCartWrap marginTop paddingtop">
						            <h3 class=" bold">Meeting Room</h3>
						            <h4 class="bold blue">ADDRESS</h4>
						            <p>$mr_center_building_name</span>
					                    $mr_center_address1 $mr_center_address2 $mr_center_city $mr_center_state $mr_center_zip<br><span class="smallLine mediumBold">$MRData[Meeting_Date]<br>$stime_in_12_hour_format - $etime_in_12_hour_format</span></p>
						            <table width="100%">
						            <tr>
						            <td class="sideCartL2">$MRData[Name]:</td><td class="sideCartr2"><span class="mediumBold">$$mr_total_disp</span></td>
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
						            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
						            </tr>
						            </table>
					            </div><!--/eachSCartWrap-->
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
            <table class="totalLine" width="100%">
	            <tr>
	            <td class="sideCartL3">ORDER TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$grand_total</span></td>
	            </tr>
            </table>

            <div class="clear"></div>
            <div class="bottomSideCart">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div><!--/bottomSideCart-->
            </div><!--/theSideCartWrap-->
        </div><!--/dsidecart-->
END;

	echo <<<END
        <div class="wrapMRdetails">
        <div class="StepsContentLeft">
        <div class="fL sone"><div class="stepOne">STEP 1 - Customize</div><div class="sfR Rd"></div></div>
        <div class="fL stwo"><div class="sfL Ld"></div><div class="stepTwo">STEP 2 - Checkout & Review</div><div class="sfR Rd"></div></div>
        <div class="fL sthree"><div class="sfL La"></div><div class="stepThree sactive">STEP 3 - Confirm</div></div>
        </div><!--/StepsContentLeft-->
        <div class="StepsContentLeft">
        <div class="wrapDescrip">
        <h1 class="gray2">ORDER CONFIRMATION</h1>
         
    
    <div class="reviewInfo">
		<h3><span class="newCust">CUSTOMER INFORMATION</span></h3>
END;

		$Company_Name = '';
		$Address_2 = '';
		$GetCustomerInfo=mysql_query("SELECT * from Customers where Customer_ID='$customerID'") or die(mysql_error());
		$CustomerData = mysql_fetch_array($GetCustomerInfo);
		if( $CustomerData['Address2'] != '' )
		{
			$Address_2 = $CustomerData['Address2'] . '<br />';
		}

		echo <<<END
		<br><p><span class="mediumBold">Name:</span> $CustomerData[First_Name] $CustomerData[Last_Name]<br />
                <span class="mediumBold">Company:</span> $CustomerData[Company_Name]<br />
                <span class="mediumBold">Address:</span> $CustomerData[Address1]<br /> $Address_2 $CustomerData[City], $CustomerData[State]  $CustomerData[Postal_Code]<br />
                <span class="mediumBold">Country:</span> $CustomerData[Country]<br>
                <span class="mediumBold">Phone:</span> $CustomerData[Phone1]<br />
                <span class="mediumBold">Email:</span> $CustomerData[Email]<br><br>
                <a href="checkout-review.php" class="aqua">Edit Your Information</a><br>
        </p>
		
		
        <div class="clear"></div>
        
        
        <div class="recurringCharge changeMtop2 ">
END;

				// make the agreement text
				if( $meeting_room_cart == 'yes' )
				{
					$bottom_review_text = 'You are about to request your meeting room. Alliance Virtual Offices will confirm your request within 48 hours (most likely a lot sooner); until then your meeting room is not scheduled. We will NOT charge your card until we have your meeting room completely confirmed.<br /><br />By clicking "Place Order" you authorize Alliance Virtual Offices to charge your credit card for the amount of <strong><span class="convert">' . "$$grand_total" . '</span></strong> upon confirmation of your meeting room. The remaining balance of <strong><span class="convert">' . "$$difference_total" . '</span></strong>, plus any additional charges incurred, will be charged at the time of your meeting. Please have your credit card available at the meeting room facility to finalize your charges.<br /><br />You will not have any recurring fees.<br /><br /><div id="Cancelation"> For any <strong>cancelation or rescheduling</strong> we will need a <strong>48 hours</strong> notification.<br />Any reschedule after this time we will not be able to ensure availability.</div>';
					$col_head_text = 'Meeting Room Charge Agreement';
				}
				else
				{
					$bottom_review_text = 'By clicking &quot;Place Order&quot;, you authorize Alliance Virtual Offices to charge your credit card for the amount of <strong><span class="convert">' . "$$grand_total" . '</span></strong>.<br /><br />You also warrant that you are authorized to use the credit card according to the information you have submitted, and you agree to let Alliance Virtual Offices charge you on a recurring basis for any monthly subscription products you may have selected.<br /><br />';
					$col_head_text = 'Recurring Charge Agreement';
				}

		echo <<<END
		<h3><span class="newCust">$col_head_text</span></h3>
        <p>$bottom_review_text</p>
	</div><!--/recurringCharge-->
					<form action="" method="post" style="margin: 0;" name="form1">
						<input type="hidden" name="step" value="next">
						<input type="hidden" name="multiple" value="$multiple">
						<input type="hidden" name="returning" value="$returning">
						<input type="submit" value="PLACE ORDER" class="aquaBtn changeMtop minW" name="submit" />
					</form>
					  
    </div><!--/reviewInfo-->


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

 
    
    
</body>
</html>
END;

?>