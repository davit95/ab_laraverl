@extends('layout.layout')
@section('title')
Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
<div class="intWrap">
		
        
        <div class="resutsTop">
        <div class="detailsTopWrap2">
        <div class="dformright radiusTop">
        <div class="contactPhones2">
            <div class="centerForm">
            NORTH AMERICA:    +1 888.869.9494<br>
			INTERNATIONAL:     +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhones2-->
            <div class="cForm2">
            <div class="centerForm2">
            <h3>INQUIRE ABOUT 
            <span class="bold">VIRTUAL OFFICES</span></h3>
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
					<button type="submit" id="submit2">SEND</button> <br/><br/><br/>		
				<script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
                //You should create the validator only after the definition of the HTML form
                  var frmvalidator  = new Validator("signup");
                  frmvalidator.addValidation("name","req","Please enter your Full Name");
                  frmvalidator.addValidation("email","maxlen=50");
                  frmvalidator.addValidation("email","req", "Please enter your Email Address");
                  frmvalidator.addValidation("email","email");
                
                //]]></script>
                
                </form></fieldset>
                </div><!--/centerForm-->
            </div><!--/cForm2-->
            
        </div><!--/dformright-->
        
        <div class="descTopLeft">
        <div class="wrapDescrip">
        <div class="contactInformation">
        <h3 class="gray3">CONTACT INFORMATION</h3><br>
        
        		<div class="contact1">
                <span class="mediumBold gray1">North America</span>
              				<p class="side_bio">International Corporate Headquarters<br />
					23 Corporate Plaza, Suite 150<br />
					Newport Beach, CA 92660, 
					USA</p>
              				<p><span class="side_bio">
                <!--// check which number to display
                        if( $affiliate_display_tf_phone == '' )
                        {
                            echo <<<END
                            Toll Free: +1 (888) 869 9494<br />
                                    Phone: +1 (949) 777 6340<br />
                END;
                        }
                        else
                        {
                            echo <<<END
                            Toll Free: $affiliate_display_tf_phone<br />
                            Phone: $affiliate_display_local_phone<br />
                END;
                        }
                
                echo <<<END-->

                			<span class="mediumBold smallLine">Email:</span> <a href="mailto:services@alliancevirtualoffices.com" class="aqua smallLine">services@alliancevirtualoffices.com</a></span><br />            
                			</p> <br />
                    <p class="light">Contact Center Headquarters<br />
					2831 St. Rose Parkway, Ste. 200<br />
					Henderson, NV 89052, 
					USA</p>
                 </div><!--/contact1-->
                 
                  <div class="contact2">  
                    <span class="mediumBold gray1">In Latin America</span>
                
              <p class="light">International Corporate Headquarters<br />
					23 Corporate Plaza, Suite 150<br />
					Newport Beach, CA 92660,  
					USA</p>
              <p><span class="side_bio"><span class="mediumBold">Phone:</span> +1 (949) 313 3409<br />
              
               <span class="mediumBold smallLine"> Email:</span> <a href="mailto:tmaeda@alliancevirtualoffices.com" class="aqua smallLine">tmaeda@alliancevirtualoffices.com</a></span><br />
                </p>
                </div><!--/contact2-->
                
                <div class="contact3">
                <span class="mediumBold gray1">In Russia, Middle East and Africa</span>
              <p class="side_bio">4th Floor Block B, Entrance 2, Business Village <br />
				Dubai United Arab Emirates</p>
              <p class="side_bio"><span class="mediumBold">Phone:</span> +971 4 2535000<br />
                <span class="mediumBold smallLine">Email:</span> <a href="mailto:sherif@alliancevirtualoffices.com" class="aqua smallLine">sherif@alliancevirtualoffices.com </a></p>
              <p><br />
                </p>                         
				</div><!--/contact3-->
            
            <div class="contact4">
            <span class="mediumBold gray1">In Europe and the UK </span>
              	<p>Catalina Basaguren / Regional Sales<br />
		De Bouw 115<br />
		3991 SZ Houten, The Netherlands</p>
              <p><span class="mediumBold">Phone:</span> +31 (0) 30 208 07 67 (Europe)<br />
				<span class="mediumBold">Phone:</span> +44 203 514 1808 (UK)<br />
                <span class="mediumBold smallLine">Email:</span> <a href="mailto:catalina@alliancevirtualoffices.com" class="aqua smallLine">catalina@alliancevirtualoffices.com</a><br />
              </p>
              
              </div><!--/contact4-->
              
              <div class="contact5">
              <span class="mediumBold gray1">In Asia</span>            
              <p>10/2 Hungerford Street Calcutta 700 017, India
              
              <p><span class="mediumBold">Phone:</span> + 91 (33) 4050 9200<br />
              <span class="mediumBold smallLine">Email:</span> <a href="mailto:svatcha@alliancevirtualoffices.com" class="aqua smallLine">svatcha@alliancevirtualoffices.com</a></p>
              </div><!--/contact5-->
              
              <div class="contact6">
              <span class="mediumBold gray1">In Australia</span>
              <p class="side_bio">International Corporate Headquarters<br />
					23 Corporate Plaza, Suite 150<br />
					Newport Beach, CA 92660, 
					USA</p>
              <p><span class="mediumBold">Toll Free:</span> +1 (800) 869 9595<br />
			  <span class="mediumBold">Phone:</span> +1 (949) 313 3400<br/>
              <span class="mediumBold smallLine">Email:</span><a href="mailto:catalina@alliancevirtualoffices.com" class="aqua smallLine"> catalina@alliancevirtualoffices.com</a></p>
              </div><!--/contact5-->
              
              <div class="ServiceHrs">
              <span class="mediumBold gray1">Customer Service Center:</span><br><br>
			  <p>Monday-Friday from 8 a.m. - 8 p.m Eastern Time (US). You may also email us anytime at <a href="mailto:services@alliancevirtualoffices.com" class="aqua smallLine">services@alliancevirtualoffices.com</a>. <br/>Also check out our <a href="http://alliancevirtualoffices.com/service-holidays.php" class="melon">Holiday schedule</a> for our Live Receptionists and Customer Service Representatives.</p>
			  <br><br></div><!--/ServiceHrs-->
        </div><!--/contactInformation-->      
        </div><!--/wrapDescrip-->
        </div><!--/descTopLeft-->
        
        
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
        
     
        
        
        </div><!--/resutsTop-->
        
       
       
</div><!--/intWrap-->
@stop