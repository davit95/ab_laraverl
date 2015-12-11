@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
<div class="ThankYouOrder">
	<div class="productContWrap">
		<div class="ThankYouTxtWrap">
			<h1>Thank you!</h1>
			<p>
			<span class="mediumBold">Congratulations!</span> You have successfully submitted your contact information. <br><br>
			<span class="mediumBold">Alliance Virtual Offices</span> will soon be in contact with you to help you
			find a virtual office or meeting room to meet your needs. Should you need to
			reach us for any reason at all, please don't hesitate to <a href="{{ url('contact') }}" class="aqua mediumBold">call us</a> or via email
			at <a href="mailto:services@alliancevirtualoffices.com" class="aqua mediumBold">services@alliancevirtualoffices.com</a>.<br><br>
			</p>
		</div>
	</div>
</div>
@stop