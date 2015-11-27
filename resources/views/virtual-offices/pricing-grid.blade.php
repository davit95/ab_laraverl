<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pricing Grid</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='//fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="/css/styles.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />
<!-- Lightbox Javascript file -->
<script src="/js/jquery.magnific-popup.min.js"></script>
<!-- Lightbox CSS file -->
<link href="/css/magnific-popup.css" rel="stylesheet" />
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



        <div class="dPlansWrap2" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;">
        <div class="dPlansAllWrap2">
        <div class="dPlansAll">

        <div class="Plans">
        <div class="topPlanGridL"><a href="#" class="melon"><span class="melon bold">{!! $center->bulding_name !!}</span></a><br>
        {!! $center->address1!!} {!! $center->address2!!}</div><!--/topPlanGridL-->
        <div class="topPlanGridR"><a href="$next_URL" class="link MoreInfoBtnMP"><div class="btnMoreInfoP MoreInfoBtnMP">About This Center</div></a></div><!--/topPlanGridR-->
        </div><!--/Plans-->

	    <!-- PLATINUM -->
            <div class="aPlan2a pmr">
            	<div class="aPlanTop2a">
                <div class="wrapPPa">
                <div id="startPlan" class="PNLeft lh2 gray2"><h3 class="cf1">PLATINUM</h3></div>
                <div class="PNRight lh2 gray3">
                    @if(isset($packages_arr['Platinum']))
                        <span class="melon bold">${!! $packages_arr['Platinum']->price !!}</span><span class="smallText medium"> /MONTH</span>
                    @else
                        <span class="smallLine orange mediumBold ">Not Available</span>
                    @endif
                </div>
                <div class="clear"></div>
                </div><!--/wrapPPa-->
                <div class="setUpFee2">$100/Set Up Fee</div>
                </div><!--/aPlanTop2a-->
                <div class="aPlanBottom2a changeHa">
                <ul class="check gray3">
                <li>Business Address</li>
                <li>Mail Receipt</li>
                <li>Mail Forwarding *</li>
                <li>Personal Mail Box</li>
                </ul>
                </div><!--/aPlanBottom2a-->
                <a href="{{ url('/customize-mail?p=103&cid='.$center->id) }}" class="link planVo1" onclick="addToCart(103);"><div class="btnSelectP2a planVo1">SELECT PLAN</div></a>
            </div><!--/aPlan2a-->

	    <!-- PLATINUM WITH LR -->

        <div class="aPlan2a pmr goright mobilePlan2 bestPlan">
            <div class="BestPlanTop"><div class="GreatPlanTL">BEST DEAL</div><div class="GreatPlanTR">You save $10 a month</div></div>
                <div class="aPlanTop2a">
                <div class="wrapPPa">
                <div class="PNLeft2 gray2"><h3 class="cf1">PLATINUM<a href="#" title=""></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="PNRight2 gray3">
                    @if(isset($packages_arr['Platinum']))
                        <span class="lineTrough smallText">${!! $packages_arr['Platinum']->with_live_receptionist_full_price!!}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">$ {!! $packages_arr['Platinum']->with_live_receptionist_pack_price!!}</span><span class="smallText medium"> /MONTH</span></span>
                    @else
                        <span class="smallLine orange mediumBold ">Not Available</span>
                    @endif
                </div>
                <div class="clear"></div>
                </div><!--/wrapPPa-->
                <div class="setUpFee2">$100/Set Up Fee</div>
                </div><!--/aPlanTop2a-->
                <div class="aPlanBottom2a changeHa">
                <ul class="check gray2 bold">
                <li><span class="cf1">EVERYTHING IN PLATINUM</span></li>
                </ul>
                <ul class="plus">
                <li>PLUS</li>
                </ul>
                <ul class="check gray3">
                    @foreach($center->telephony_includes_arr as $include)
                      <li>{!! $include->include !!}</li>
                    @endforeach
                </ul>
                </div><!--/aPlanBottom2a-->
                <a href="{{ url('/customize-mail?p=103&b=402&cid='.$center->id) }}" class="link planVo1" onclick="addToCart(103);"><div class="btnSelectP2a planVo1">SELECT PLAN</div></a>
            </div><!--/aPlan2a-->



	    <!-- PLATINUM PLUS -->
            <div class="aPlan2a pmr mobilePlan">
                <div class="aPlanTop2a">
                <div class="wrapPPa">
                <div id="startPlan" class="PNLeft lh2 gray2"><h3 class="cf1">PLATINUM PLUS</h3></div>
                <div class="PNRight lh2 gray3">
                    @if(isset($packages_arr['Platinum Plus']))
                        <span class="melon bold">${!! $packages_arr['Platinum Plus']->price !!}</span><span class="smallText medium"> /MONTH</span>
                    @else
                        <span class="smallLine orange mediumBold ">Not Available</span>
                    @endif
                </div>
                <div class="clear"></div>
                </div><!--/wrapPPa-->
                <div class="setUpFee2">$100/Set Up Fee</div>
                </div><!--/aPlanTop2a-->
                <div class="aPlanBottom2a changeHa">
                <ul class="check gray3">
                <li><span class="cf1">EVERYTHING IN PLATINUM</span></li>
                </ul>
                <ul class="plus">
                <li>PLUS</li>
                </ul>
                <ul class="check gray3">
                <li>16 Hours of Meeting Room or Private Office Time</li>
                </ul>
                </div><!--/aPlanBottom2a-->
                <a href="{{ url('/customize-mail?p=105&cid='.$center->id) }}" class="link planVo1" onclick="addToCart(103);"><div class="btnSelectP2a planVo1">SELECT PLAN</div></a>
            </div><!--/aPlan2a-->


	    <!-- PLATINUM PLUS WITH LR -->
            <div class="aPlan2a pmr goright mobilePlan greatPlan">
            <div class="GreatPlanTop"><div class="GreatPlanTL">GREAT DEAL</div><div class="GreatPlanTR">You save $10 a month</div></div><!--/GreatPlanTop-->
                <div class="aPlanTop2a">
                <div class="wrapPPa">
                <div class="PNLeft2 gray2"><h3 class="cf1">PLATINUM PLUS<a href="#" title=""></a><br><span class="smallLine">WITH LIVE RECEPTIONIST</span></h3></div>
                <div class="PNRight2 gray3">
                    @if(isset($packages_arr['Platinum Plus']))
                        <span class="lineTrough smallText">${!! $packages_arr['Platinum Plus']->with_live_receptionist_full_price!!}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">$ {!! $packages_arr['Platinum Plus']->with_live_receptionist_pack_price!!}</span><span class="smallText medium"> /MONTH</span></span>
                    @else
                        <span class="smallLine orange mediumBold ">Not Available</span>
                    @endif
                </div>
                <div class="clear"></div>
                </div><!--/wrapPPa-->
                <div class="setUpFee2">$100/Set Up Fee</div>
                </div><!--/aPlanTop2a-->
                <div class="aPlanBottom2a changeHa">
                <ul class="check gray2 bold">
                <li><span class="fitS">EVERYTHING IN PLATINUM WITH LIVE RECEPTIONIST</span></li>
                </ul>
                <ul class="plus">
                <li>PLUS</li>
                </ul>
                <ul class="check gray3">
                <li>16 Hours of Meeting Room or Private Office Time</li>
                </ul>
                </div><!--/aPlanBottom2a-->
                <a href="{{ url('/customize-mail?p=105&b=402&cid='.$center->id) }}" class="link planVo1" onclick="addToCart(103);"><div class="btnSelectP2a planVo1">SELECT PLAN</div></a>
            </div><!--/aPlan2a-->


        </div><!--/dPlansAll-->
        </div><!--/dPlansAllWrap-->
        </div><!--/dPlansWrap-->
         <div class="extras2 gray3" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;"><p><span class="bold">ALL PLANS MAY OFFER WITH ADDITIONAL CHARGES:</span> Main Building Directory Listing (where available) *   -  Professional Admin Services *   -  Professional Business Support Center *</p>
         <p><span class="bold">PLANS WITH MEETING ROOMS AND PRIVATE OFFICE TIME:</span> Board rooms, seminar rooms and training rooms are not included.</p>
         </div>
        <div class="expl2 gray3" style="padding-left:1%; padding-right:1%; box-sizing:border-box;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;">* Extra fees may apply</div>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-17741668-1');
ga('require', 'ec');

function addToCart(product) {

  if( product == '103' ) {
    ga('ec:addProduct', {
      'id': '103',
      'name': 'Platinum Package',
      'variant': '$centerID',
      'price': '$center_platinum_price',
      'quantity': '1'
    });
  }

  if( product == '105' ) {
    ga('ec:addProduct', {
      'id': '105',
      'name': 'Platinum Plus Package',
      'variant': '$centerID',
      'price': '$center_platinum_plus_price',
      'quantity': '1'
    });
  }

  if( product == '108' ) {
    ga('ec:addProduct', {
      'id': 103,
      'name': 'Platinum Package',
      'variant': '$centerID',
      'price': '$center_platinum_price',
      'quantity': '1'
    });
    ga('ec:addProduct', {
      'id': '402',
      'name': 'Virtual Office Live Receptionist 50',
      'price': '95',
      'quantity': '1'
    });
  }

  if( product == '109' ) {
    ga('ec:addProduct', {
      'id': '105',
      'name': 'Platinum Plus Package',
      'variant': '$centerID',
      'price': '$center_platinum_plus_price',
      'quantity': '1'
    });
    ga('ec:addProduct', {
      'id': '402',
      'name': 'Virtual Office Live Receptionist 50',
      'price': '95',
      'quantity': '1'
    });
  }

  // now send it
  ga('ec:setAction', 'add');
  ga('send', 'event', 'UX', 'click', 'add to cart');     // Send data using an event.
}

</script>
<script type="text/javascript">
        jQuery(document).ready(function($) {
			$('.planVo1').on('click', function() {
			  ga('send', 'event', 'Grid Plans', 'Click', 'PLATINUM');
			});
			$('.planVo2').on('click', function() {
			  ga('send', 'event', 'Grid Plans', 'Click', 'PLATINUM LR');
			});
			$('.planVo3').on('click', function() {
			  ga('send', 'event', 'Grid Plans', 'Click', 'PLATINUM PLUS');
			});
			$('.planVo4').on('click', function() {
			  ga('send', 'event', 'Grid Plans', 'Click', 'PLATINUM PLUS LR');
			});
		});

</script>
<!-- End Google Analytics -->
<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0018/3635.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>
</body>
</html>
