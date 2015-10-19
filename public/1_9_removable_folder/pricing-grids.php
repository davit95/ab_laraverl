<?php
include '../siteFunctions.php';
$centerID = mysql_real_escape_string($_REQUEST['id']);

$platinum_buy_link = '';
$platinum_with_buy_link = '';
$platinum_plus_buy_link = '';
$platinum_plus_with_buy_link = '';
$center_platinum_price_disp = '<span class="smallLine orange mediumBold "><br>Not Available</span>';
$center_platinum_with_price_disp = '<span class="smallLine orange mediumBold "><br>Not Available</span>';
$center_platinum_plus_price_disp = '<span class="smallLine orange mediumBold "><br>Not Available</span>';
$center_platinum_plus_with_price_disp = '<span class="smallLine orange mediumBold "><br>Not Available</span>';

// get center owner info
$ownerQuery = mysql_query("SELECT * from Center where CenterID='$centerID'");
$ownerData = mysql_fetch_array($ownerQuery);
$ownerID = $ownerData['OwnerID'];

$center_address = <<<END
<p>
    <span class="rcName gray2">$ownerData[BuildingName]</span><br>
    <span class="rcAddress gray3">$ownerData[Address1], $ownerData[Address2]</span>
</p>
END;

// GET CENTER PRICING --#
$CenterPricing=mysql_query("SELECT * from Center_Package_Pricing where Center_ID='$centerID'");
while( $Pricing=mysql_fetch_array($CenterPricing) )
{
	if( $Pricing['Package_Place'] == 'Platinum' )
	{
		$center_platinum_price = $Pricing['Price'];
	}
	elseif( $Pricing['Package_Place'] == 'Platinum Plus' )
	{
		$center_platinum_plus_price = $Pricing['Price'];
	}
}

if( $center_platinum_price != '0' && $center_platinum_price != '' )
{
	$full_price = $center_platinum_price + 95;
	$pack_price = $center_platinum_price + 85;

	$platinum_buy_link = '<a href="details.php?n=1&p=103&cid=' . $centerID . '" class="link"><div class="btnSelectP2">SELECT PLAN</div></a>';
	$platinum_with_buy_link = '<a href="details.php?n=1&p=103&b=402&cid=' . $centerID . '" class="link"><div class="btnSelectP2 orb">SELECT PLAN</div></a>';

	$center_platinum_price_disp = '<span class="price">$' . $center_platinum_price . '</span><span class="pMonth"> /MONTH</span>';
	$center_platinum_with_price_disp = '<span class="nonPrice orange cf1 bold">&nbsp;$' . $full_price . '</span>&nbsp;&nbsp; <span class="price">$' . $pack_price . '</span><span class="pMonth"> /MONTH</span><br><span class="save">You save $10</span>';
}

if( $center_platinum_plus_price != '0' && $center_platinum_plus_price != '' )
{
	$full_price = $center_platinum_plus_price + 95;
	$pack_price = $center_platinum_plus_price + 85;

	$platinum_plus_buy_link = '<a href="details.php?n=1&p=105&cid=' . $centerID . '" class="link"><div class="btnSelectP2">SELECT PLAN</div></a>';
	$platinum_plus_with_buy_link = '<a href="details.php?n=1&p=105&b=402&cid=' . $centerID . '" class="link"><div class="btnSelectP2 orb">SELECT PLAN</div></a>';

	$center_platinum_plus_price_disp = '<span class="price">$' . $center_platinum_plus_price . '</span><span class="pMonth"> /MONTH</span>';
	$center_platinum_plus_with_price_disp = '<span class="nonPrice orange cf1 bold">&nbsp;$' . $full_price . '</span>&nbsp;&nbsp; <span class="price">$' . $pack_price . '</span><span class="pMonth"> /MONTH</span><br><span class="save">You save $10</span>';
}

$small_address = preg_replace('/^[^a-zA-Z]*/', '', $ownerData['Address1']);
$formatted_street = name_into_url($small_address);
$next_URL = $formatted_street . '-virtual-office-' . $centerID;

echo <<<END
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pricing Grid</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
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
<script>
        jQuery(document).ready(function($) {
		$('.link').click(function(e) {
		   var href = this.href;
		   e.preventDefault();
		   if (window.parent == window.top) {
		      window.top.location.href = href; 
		      window.parent.$.magnificPopup.close();
		   }
		});
        });			
</script>
</head>
<body>
       
        <div class="Plans"  style="margin-left:15px; margin-top:20px;">
        $center_address
        <a href="$next_URL" class="link"><div class="btnMoreInfoP">MORE INFORMATION</div></a>
        
        </div><!--/Plans-->
        
        
        <div class="dPlansWrap" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;">
        <div class="dPlansAllWrap">
        <div class="dPlansAll">

	    <!-- PLATINUM -->
            <div class="aPlan2">
                <div class="aPlanTop2 bordeRight">
                <div class="wrapPP">
                <div id="startPlan" class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM</h3></div>
                <div class="secondline gray3">$center_platinum_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH bordeBottom bordeRight">
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
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM<a href="#" title=""></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="secondline gray3">$center_platinum_with_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_with_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH bordeRight">
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
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM PLUS<a href="#" title=""></a></h3></div>
                <div class="secondline gray3">$center_platinum_plus_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_plus_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH2 bordeRight">
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
                <div class="firstline gray2"><h3 class="cf1">&nbsp; PLATINUM PLUS<a href="#" title=""></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="secondline gray3">$center_platinum_plus_with_price_disp</div>
                <div class="clear"></div>
                </div><!--/wrapPP-->
                $platinum_plus_with_buy_link
                </div><!--/aPlanTop2-->
                <div class="aPlanBottom2 changeH2">
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
         <div class="extras2 gray3" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;"><p><span class="bold">ALL PLANS MAY OFFER WITH ADDITIONAL CHARGES:</span> Main Building Directory Listing (where available) *   -  Professional Admin Services *   -  Professional Business Support Center *</p></div>
        <div class="expl2 gray3" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;">* Extra fees may apply</div>
       
</body>
</html>
END;
?>