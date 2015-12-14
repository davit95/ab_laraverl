@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
	<div class="PowerUp">
		<div class="contactTop">Call: +1 888.869.9494</div>
    	<div class="productContWrap">
        	<div class="productTxtWrap">
        		<h1>Power Up Your Small Business</h1>
        		<p><span class="mediumBold">Alliance Virtual Offices</span> is a business power tool for startups and SMBs. <br>Our technology interface and
        			service delivery focus are designed to help bootstrapping businesses grow fast on a budget. <br>
        			We've always championed small businesses, and we get straight to the core of what you need
        			to succeed with people, place, and technology - the complete virtual office. It's your springboard to the bigtime.</p>
        		<a class="popup-with-form popupForm" href="#test-form"><div class="inquiryBtn">INQUIRE ABOUT VIRTUAL OFFICES</div></a>
        	</div>
        	<div id="sticky-anchor"></div>
        	<div class="searchHome" id="sticky">
    			<form action="search2.php" autocomplete="off" id="avoS" method="get">
					<input type="hidden" name="step" value="search" />
      				<input type="text" class="SearchInput" id="suggest1" name="inputy" placeholder="Find Your Location Here" />
	            	<select id="Services" name="avo1" class="avo1" >
	                	<option value="VO">Virtual Offices</option>
	                	<option value="MR">Meeting Rooms</option>
	              	</select>
      				<input type="hidden" name="source" value="bb">
      				<button type="submit" class="searchBtn search-button form-inline btn btn-primary btn-large aquaB" id="searchBtn" >
        				<span class="mobileS">Search</span>
      				</button>
    			</form>
        	</div>
        	<div class="ViewAllLocations"><a href="#NAsection" class="white">View All Locations Here!</a></div>
       	</div>
    	<div id="test-form"  class="mfp-hide">
        	<div class="centerForm2 popUpF">
            	<h3>INQUIRE ABOUT
           			<span class="bold">VIRTUAL OFFICES</span>
           		</h3>
            	@if(session('success'))
					<div class="alert-success-custom">
						{{ session('success') }}
					</div>
				@endif
				{!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
					<div>
						{!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
						{!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required']) !!}
						@if($errors->has('name'))
							<small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
						@endif
					</div>
					<div>
						{!! Form::label('email','Email', [ 'class' => $errors->has('email')?'label label-error':"label" ]) !!}
						{!! Form::email('email', null,[ 'class' => $errors->has('email')?'input-error':'' , 'required']) !!}
						@if($errors->has('email'))
							<small class="text-error-custom">{{ $errors->get('email')[0] }}</small>
						@endif
					</div>
					<div>
						{!! Form::label('company','Company', [ "class" => $errors->has('company')?'label label-error':"label" ]) !!}
						{!! Form::text('company', null,[ 'class' => $errors->has('company')?'input-error':'' , 'required']) !!}
						@if($errors->has('company'))
							<small class="text-error-custom">{{ $errors->get('company')[0] }}</small>
						@endif
					</div>
					<div>
						{!! Form::label('phone','Phone', [ "class" => $errors->has('phone')?'label label-error':"label" ]) !!}
		  				{!! Form::text('phone', null,[ 'class' => $errors->has('phone')?'input-error':'' , 'required']) !!}
						@if($errors->has('phone'))
							<small class="text-error-custom">{{ $errors->get('phone')[0] }}</small>
						@endif
					</div>
	                <div>
	                    {!! Form::label('comments','Comments', [ "class" => $errors->has('comments')?'label label-error':"label" ]) !!}
	                    {!! Form::textarea('comments', null,[ 'class' => $errors->has('comments')?'input-error':'' , 'required']) !!}
	                    @if($errors->has('comments'))
	                        <small class="text-error-custom">{{ $errors->get('comments')[0] }}</small>
	                    @endif
	                </div>

					<label for="label"><div class="label"><a href="{{ url('privacy-policy') }}" target="_blank" class="privateP">Privacy Policy</a></div></label>
					<label for="submit"></label>
					<button type="submit" id="submit2">FIND OUT MORE</button>

    			{!! Form::close() !!}
            </div><!--/centerForm-->
        </div>
	</div>
	<div class="contactMobile2">Call: +1 888.869.9494</div>


	<div class="VirtualOffice">
		<div class="productContWrap">
	        <div class="productTxtWrap">
	        <h1>Virtual Office</h1>
	        <p>A virtual office is an <span class="mediumBold">office mailing address</span> that you can use for business correspondence.
	        Business mail is received and forwarded to the location of your choice, as often as you like.
	        Or come and pick it up yourself. <br><br>Choose one or more virtual offices <span class="mediumBold">from hundreds of locations</span> across North America and internationally.</p>
	        </div><!--/productTxtWrap-->
	       </div><!--/productContWrap-->
	</div><!--/VirtualOffice-->

	<div class="VirtualLocations">
		<div class="productContWrap">
	        <div class="productTxtWrap">
		        <h1>Virtual Office Locations</h1>
		        <p>
		        	<span class="mediumBold">Create an instant presence in a new city.</span>
		        	<br>
		        	Choose from hundreds of virtual office locations across the world, from local business centers to iconic city skyscrapers. Use the address as a mail handling facility, as your official business address, or rent meeting rooms and office space by the hour.
		        </p>
	        </div>
	    </div>
	</div>

	<div class="MailForwarding">
		<div class="productContWrap">
	        <div class="productTxtWrap">
		        <h1>Mail Forwarding</h1>
		        <p>
		        	Have
		        	<span class="mediumBold">business mail received and forwarded</span>
		        	to the location of your choice, as often as you like. Secure and affordable, your business is only charged the postal rate plus a small handling fee based on forwarding frequency.
		        	<br>
		        	Or come and collect it yourself for free.
		        </p>
	        </div>
	    </div>
	</div>

	<div class="productsDividedWrap">
		<div class="PrLeft">
			<table class="productsTxtTable" width="100%" height="100%">
				<tr>
					<td>
						<div class="PrdTxtWrap">
							<h1 class="medium">SETTING UP A VIRTUAL OFFICE LOCATION</h1>
					        <p class="light">
					        	To use a virtual office address in the United States, you'll need to complete a
					        	<a href="http://www.alliancevirtualoffices.com/CMRA_form.pdf" target="_blank" class="gray2 mediumBold">CMRA form</a>
					        	(Commercial Mail Receiving Agency). This is a consumer protection to safeguard against fraudulent businesses. <br>Our inclusive online notary service makes the process quick and easy.
					        	<span class="mediumBold">Job done.</span>
					        </p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="PrRight">
			<table class="productsTxtTable" width="100%" height="100%">
				<tr>
					<td>
						<div class="PrdTxtWrap">
							<h1 class="medium">NOTARY SERVICE</h1>
					        <p class="light">
					        	Use your own notary service when completing your CMRA form, or use our
					        	<a href="https://www.notarycam.com/alliancevirtualoffices/" target="_blank" class="gray2 mediumBold">online notary service</a>
					        	at no extra cost.
					        	<br>
					        	To use our online service, simply upload your document, connect to a live Notary face-to-face on a webcam, and electronically sign your document. The notary will verify and confirm your identity and apply their eNotary seal.
					        	<span class="mediumBold">That's it.</span>
					        </p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
	</div>

	<div id="NAsection" class="NAsection">
		<div class="Wrapper">
			<h2 class="smallh2">LOCATIONS IN NORTH AMERICA</h2>
			@include('virtual-offices.parts.na-list')
			<br>
			<br>
			<h2 class="smallh2">INTERNATIONAL LOCATIONS</h2>
			@include('virtual-offices.parts.int-list')
		</div>
	</div>

	<div class="TopCities">
		<div class="Wrapper">
			<h2 class="smallh2">TOP CITIES</h2>
			<ul>
				<a href="http://www.alliancevirtualoffices.com/US/los-angeles-virtual-office"><li>Los Angeles</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/new-york-virtual-office"><li>New York</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/chicago-virtual-office"><li>Chicago</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/dallas-virtual-office"><li>Dallas</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/atlanta-virtual-office"><li>Atlanta</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/houston-virtual-office"><li>Houston</li></a>
				<a href="http://www.alliancevirtualoffices.com/GB/london-virtual-office"><li>London</li></a>
				<a href="http://www.alliancevirtualoffices.com/CN/beijing-virtual-office"><li>Beijing</li></a>
				<a href="http://www.alliancevirtualoffices.com/JP/tokyo-virtual-office"><li>Tokyo</li></a>
				<a href="http://www.alliancevirtualoffices.com/AE/dubai-virtual-office"><li>Dubai</li></a>
				<a href="http://www.alliancevirtualoffices.com/DE/berlin-virtual-office"><li>Berlin</li></a>
				<a href="http://www.alliancevirtualoffices.com/NL/amsterdam-virtual-office"><li>Amsterdam</li></a>
				<a href="http://www.alliancevirtualoffices.com/FR/paris-virtual-office"><li>Paris</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/las-vegas-virtual-office"><li>Las Vegas</li></a>
				<a href="http://www.alliancevirtualoffices.com/US/washington-virtual-office"><li>Washington</li></a>
			</ul>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript" src="/js/fixed-search-box.js"></script>
@stop