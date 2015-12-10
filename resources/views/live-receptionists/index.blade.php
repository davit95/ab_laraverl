@extends('layout.layout')
@section('title')
Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
<div class="LR_VoIP">
    <div class="contactTop">Call: +1 888.869.9494</div><!--/contactTop-->

      <div class="productContWrap">
        <div class="productTxtWrap">
        <h1 class="mediumBold">The Best VoIP Tech on the Market</h1>
        <p class="light">Technology moves fast. Keep ahead of the curve with Alliance Virtual Offices. <br>
        We bring you a market-leading VoIP system with easy-to-use features and live call-answering services. <span class="mediumBold">Our people are the best in the business too.</span> <br>
        We have Live Receptionists to answer your business calls, and a Customer Service Team to keep things humming along smoothly. Whatever you need, we're right here at the end of the line.</p>
        <a class="popup-with-form popupForm" href="#test-form"><div class="inquiryBtn">INQUIRE ABOUT LIVE RECEPTIONISTS</div></a>
        </div><!--/productTxtWrap-->
       </div><!--/productContWrap-->
    <div id="test-form"  class="mfp-hide">
        <div class="centerForm2 popUpF">
            <h3>INQUIRE ABOUT
            <span class="bold">LIVE RECEPTIONISTS</span></h3>
            <form name="signup" action="/sendcontact.php" method="post" onSubmit="return validate_contact_form ( );">

					<label for="name"><div class="label">Name:</div></label>
					<input name="name" id="name" type="text"><br/>

					<label for="email"><div class="label">Email:</div></label>
					<input name="email" id="email" type="text"><br/>

					<label for="company"><div class="label">Company:</div></label>
			  		<input name="company" id="company" type="text"><br/>

			  		<label for="label"><div class="label">Phone:</div></label>
			  		<input name="phone" id="label" type="text"><br/>

                    <label for="label"><div class="label">Comments:</div></label>
			  		<textarea class="inpInq" name="comments" id="comments" cols="20" rows="5"></textarea><br/>

					<label for="label"><div class="label"><a href="https://www.alliancevirtualoffices.com/privacy_policy.php" class="privateP">Privacy Policy</a></div></label>
					<label for="submit"></label>
					<button type="submit" id="submit2">FIND OUT MORE</button> <br/><br/><br/>
				<script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                //You should create the validator only after the definition of the HTML form
                  //var frmvalidator  = new Validator("signup");
                  //frmvalidator.addValidation("name","req","Please enter your Full Name");
                  //frmvalidator.addValidation("email","maxlen=50");
                  //frmvalidator.addValidation("email","req", "Please enter your Email Address");
                  //frmvalidator.addValidation("email","email");

                //]]></script>

                </form></fieldset>
                </div><!--/centerForm-->
       </div><!--/test-form-->
</div><!--/LR_VoIP-->
<div class="contactMobile2">Call: +1 888.869.9494</div>


<div class="LRandVPP">
	<div class="productContWrap">
        <div class="productTxtWrap xs">
        <h1>Live Receptionists<br>and Virtual Phone Plans</h1>
        <p>All business calls are personally answered by live receptionists in your company name, during business hours.
        Choose whether to take the call, re-route it to another extension, send it to voicemail,
        or have a message emailed to you. A phone system is included with a local or toll-free number, custom greetings, voicemail, and more.</p>
        </div><!--/productTxtWrap-->

      <div class="LRtableWrap2">
      <div class="LRtableWrap">
      <table class="newLRGrid">

      <tr>
        <th class="bgDGray tleftG">&nbsp;</th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 50</span></span></span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 100</span></span></span></th>
        <th class="bgDGray"><span class="mediumBold smallLine">VIRTUAL OFFICE<span class="tOrange"><br /><span class="smallLine">LIVE RECEPTIONIST 200</span></span></span></th>
        <th class="bgDGray noborder"><span class="mediumBold smallLine">VIRTUAL OFFICE<br><span class="smallLine">PHONE UNLIMITED</span></span></th>
     </tr>

      <tr>
        <td class="firstFT">Live Answering Minutes</td>
        <td class="bold">50</td>
        <td class="bold">100</td>
        <td class="bold">200</td>
        <td class="bold">0</td>
      </tr>

      <tr>
        <td class="firstFT tleftG">Local and Long Distance Minutes <img src="/images/info.png" class="tooltip2"/></td>
        <td class="bgGray">Unlimited</td>
        <td class="bgGray">Unlimited</td>
        <td class="bgGray">Unlimited</td>
        <td class="bgGray">Unlimited</td>
      </tr>

      <tr>
        <td class="firstFT">Included Phone Numbers <img src="/images/info.png" class="tooltip"/></td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
        <td> 1 </td>
      </tr>

      <tr>
        <td class="bgGray firstFT">Personalized, Live Answering 9am-8pm EST</td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
       <td class="bgGray"></td>
      </tr>

      <tr>
        <td class="firstFT">Call Screening / Attended Transfer</td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td></td>
      </tr>

      <tr>
        <td class="bgGray firstFT">Voicemail, Email Delivery of   Voicemail</td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /> </td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
      </tr>

      <tr>
        <td class="firstFT">Custom Recordings,   Messages</td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
      </tr>

      <tr>
        <td class="bgGray firstFT">Full Online Control   Panel</td>
		<td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td class="bgGray"><img src="/images/check2.png" width="15" height="15" border="0" /></td>
      </tr>

      <tr>

        <td class="firstFT">Call Forwarding</td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
        <td><img src="/images/check2.png" width="15" height="15" border="0" /></td>
      </tr>

      <tr>

        <td class="bgGray firstFT"><b>Monthly Cost</b></td>
        <td class="bgGray borderBottom"><span class="melon bold bigPrice">{!! session('currency.symbol') !!}{{ 95*session('rate') }}</span></td>
        <td class="bgGray borderBottom"><span class="melon bold bigPrice">{!! session('currency.symbol') !!}{{ 145*session('rate') }}</span></td>
        <td class="bgGray borderBottom"><span class="melon bold bigPrice">{!! session('currency.symbol') !!}{{ 225*session('rate') }}</span></td>
        <td class="bgGray borderBottom"><span class="melon bold bigPrice">{!! session('currency.symbol') !!}{{ 40*session('rate') }}</span></td>
      </tr>

      <tr>
        <td class="firstFT noBorder"><a href="all-features" class="aqua mediumBold">View All Features &amp; Options</a></td>
        <td class="noBorder">
          {!! Form::open(['url' => url('live-receptionist-add-to-cart')]) !!}
            <a href="#" class="noStyle select_lr_plan">
                {!! Form::hidden('lr_id', 402) !!}
                {!! Form::hidden('lr_name', 'Virtual Office Live Receptionist 50') !!}
                {!! Form::hidden('price', 95) !!}
                <div class="aquaBtn">SELECT</div>
            </a>
          {!! Form::close() !!}
        </td>
        <td class="noBorder">
          {!! Form::open(['url' => url('live-receptionist-add-to-cart')]) !!}
            <a href="#" class="noStyle select_lr_plan">
                {!! Form::hidden('lr_id', 403) !!}
                {!! Form::hidden('lr_name', 'Virtual Office Live Receptionist 100') !!}
                {!! Form::hidden('price', 145) !!}
                <div class="aquaBtn">SELECT</div>
            </a>
          {!! Form::close() !!}
        </td>
        <td class="noBorder">
          {!! Form::open(['url' => url('live-receptionist-add-to-cart')]) !!}
            <a href="#" class="noStyle select_lr_plan">
                {!! Form::hidden('lr_id', 404) !!}
                {!! Form::hidden('lr_name', 'Virtual Office Live Receptionist 200') !!}
                {!! Form::hidden('price', 225) !!}
                <div class="aquaBtn">SELECT</div>
            </a>
          {!! Form::close() !!}
        </td>
        <td class="noBorder">
          {!! Form::open(['url' => url('live-receptionist-add-to-cart')]) !!}
            <a href="#" class="noStyle select_lr_plan">
                {!! Form::hidden('lr_id', 401) !!}
                {!! Form::hidden('lr_name', 'Virtual Office Live Receptionist 0') !!}
                {!! Form::hidden('price', 40) !!}
                <div class="aquaBtn">SELECT</div>
            </a>
          {!! Form::close() !!}
        </td>
      </tr>

    </table>
    </div><!--/LRtableWrap-->
    </div><!--/LRtableWrap2-->

       </div><!--/productContWrap-->
</div><!--/LRandVPP-->

<div class="CallAnswering">
	<div class="productContWrap">
        <div class="productTxtWrap">
        <h1>Call Answering</h1>
        <p>Our live receptionist service provides <span class="mediumBold">personalized call answering</span> during business hours (8am-8pm EST)
        by a team of trained customer service professionals. Incoming calls are received by a receptionist
        and answered in your company name. <br>You have full control over the screening process, how callers are greeted, and which calls are forwarded.</p>
        </div><!--/productTxtWrap-->
       </div><!--/productContWrap-->
</div><!--/CallAnswering-->

<div class="PhoneOnly">
	<div class="productContWrap">
        <div class="productTxtWrap">
        <h1>Phone Only</h1>
        <p>Choose a <span class="mediumBold">low-cost virtual phone plan</span> with a local or toll-free number, inclusive local and long distance minutes,
        and additional features such as custom greetings, extension numbers, menus, voicemail, and more.
        Control it all online with your own secure control panel. Phone-only plans do not include call answering from a live receptionist.</p>
        </div><!--/productTxtWrap-->
       </div><!--/productContWrap-->
</div><!--/PhoneOnly-->
@stop
@section('styles')
    <link href="/css/magnific-popup.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/tooltipster.css"/>
    <link rel="stylesheet" type="text/css" href="/css/themes/tooltipster-light.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery.tosrus.all.css"/>
@stop

@section('scripts')
    <script type="text/javascript" src="/js/jquery.tooltipster.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tosrus.min.all.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select_lr_plan').click(function(){
                $(this).parents('form').submit();
                return false;
            });
        });
    </script>
    <script type="text/javascript">
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
@stop