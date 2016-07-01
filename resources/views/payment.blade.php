@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
    <div class="intWrap">
        <div class="resutsTop">
        	<div id="main-container-gen" class="container_12-gen">
        		<table width="887" border="0" align="center" cellpadding="0" cellspacing="0">
	        		<tr>
	        		    <td width="658" valign="top">
	        				<div style="font-size: 14px; font-weight: bold; margin: 0 0 10px 0;">Please click the <a href="javascript: history.go(-1)">back</a> button and fix the following errors:</div>
	        				<ul>
	        					<li style="color: red;">Please enter a valid Credit Card Number. Number isn't a string</li>
	        				</ul>
	        		    </td>
	        		</tr>
        		</table>
        		
        		  <form id="checkout" action="/checkout" method="post">
        		  		<label>Cardholder's Name<span class="orange">*</span></label><br>
					  <input data-braintree-name="cardholder_name" value=""><br>
					  <label>Card Number<span class="orange">*</span></label><br>
					  <input data-braintree-name="number" value="4111111111111111"><br>
					  <label>CVV2 Number<span class="orange">*</span></label><br>
					  <input data-braintree-name="cvv" value=""><br>
					  <label>Expiration Date: <span class="orange">*</span></label><br>
					  <select data-braintree-name="expiration_month" value="">
					  	<option value="01">January (01)</option>
					  	<option value="02">February (02)</option>
					  	<option value="03">March (03)</option>
					  	<option value="04">April (04)</option>
					  	<option value="05">May (05)</option>
					  	<option value="06">June (06)</option>
					  	<option value="07">July (07)</option>
					  	<option value="08">August (08)</option>
					  	<option value="09">September (09)</option>
					  	<option value="10">October (10)</option>
					  	<option value="11">November (11)</option>
					  	<option value="12">December (12)</option>
					  </select><br>
					  <label>Expiration Date: <span class="orange">*</span></label><br>
					  <select data-braintree-name="expiration_year" value="">
					  	<option value="14">14</option>
					  	<option value="15">15</option>
					  	<option value="16">16</option>
					  	<option value="17">17</option>
					  	<option value="18">18</option>
					  	<option value="19">19</option>
					  	<option value="20">20</option>
					  	<option value="21">21</option>
					  	<option value="22">22</option>
					  	<option value="23">23</option>
					  	<option value="24">24</option>
					  </select><br>

					  <!-- you can also split expiration date into two fields -->

					  <input type="submit" id="submit" value="Pay">
				</form>

					<script src="https://js.braintreegateway.com/js/braintree-2.26.0.min.js"></script>
				    <script>
				    	$.ajax({
				    		dataType:'json',
				    		type:'post',
				    		url: '/braintree/token',
				    		success:function(data){
				    			console.log(data);
				    			var clientToken = data.token;
				    			braintree.setup(clientToken, 'custom', {id: 'checkout'});
				    		}
				    	})
					
					</script>

        	</div>
        </div>
    </div>
@stop




