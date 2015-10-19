<?php
include ("../siteFunctions.php");

$invoiceNumber = mysql_real_escape_string($_REQUEST['invoice']);

// reset Session ID
session_regenerate_id();
setcookie('CINFO', null, -1, '/');

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
<script>
        jQuery(document).ready(function($) {
			
			$( ".menuBtnLink" ).click(function() {
			  $( ".menu" ).slideToggle( "slow", function() {
				// Animation complete.
			  });
			});
        });
    </script>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-17741668-1');
ga('require', 'ec');

END;

// go through each product and create javascript
get_complete_info3($invoiceNumber);

// get VOs
$records = $record_number - 1;
for( $i=0; $i<=$records; $i++ )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '$cust_package_id[$i]',
  'name': '$cust_package_name[$i]',
  'variant': '$cust_center_id[$i]',
  'price': '$cust_package_price[$i]'
});


END;
}

// get phone plans
$phone_records = $phone_record_number - 1;
for( $i=0; $i<=$phone_records; $i++ )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '$cust_cp_code[$i]',
  'name': '$cust_cp_plan[$i]',
  'price': '$cust_cp_total[$i]'
});


END;
}

// get meeting rooms
if( $cust_mr_ID != '' )
{
	echo <<<END
ga('ec:addProduct', {
  'id': '601',
  'name': '$cust_mr_name',
  'variant': '$cust_mr_center_id',
  'price': '$cust_mr_percentage_total'
});


END;
}

// now the full invoice summary
echo <<<END
ga('ec:setAction', 'purchase', {
  'id': '$invoiceNumber',
  'revenue': '$cust_grand_total',
  'tax': '$cust_taxes_amount'
});
END;

echo <<<END

ga('send', 'pageview');     // Send transaction data with initial pageview.
</script>
<!-- End Google Analytics -->
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

<div class="ThankYouOrder">
	<div class="productContWrap">
        <div class="ThankYouTxtWrap">
        <h1>Thank you for your order!</h1>
        <p>We appreciate your business and look forward to fulfilling your officing needs!<br>
        Your order will be processed and a representative will contact you shortly.<br><br>
        Thank you for choosing <span class="mediumBold">ALLIANCE Virtual Offices!</span><br><br>
        <a href="invoice.php?invoice=$invoiceNumber" class="aqua mediumBold">Click here</a> for a printable version of your invoice.</p>
        </div><!--/ThankYouTxtWrap-->
       </div><!--/productContWrap-->
       <div class="productContWrap">
        <div class="productTxtWrap">
        <h1>What's next?</h1>
        <p><span class="mediumBold">An ALLIANCE representative will contact you</span> by phone immediately to confirm<br>
        your order and put your virtual office in place.<br><br>
        If you have questions in the meantime, please call us at <span class="mediumBold">(888) 869.9494.</span></p>
        </div><!--/productTxtWrap-->
       </div><!--/productContWrap-->
       
</div><!--/ThankYouOrder-->




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
/* <![CDATA[ */
var google_conversion_id = 989124044;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "666666";
var google_conversion_label = "s7edCMzkogIQzKvT1wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/989124044/?label=s7edCMzkogIQzKvT1wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>

END;

?>