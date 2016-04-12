@extends('layout.layout')

@section('title')
	Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
	<div class="intWrap">
		<div class="detailsTopWrap2 changeMtop3">
			<div class="wrapMRdetails">
				<div class="StepsContentLeft">
					<div class="wrapDescrip">
						<h1 class="gray2">Customer Log In</h1>
						<br><p><span class="mediumBold">Enter your email address and password to log into your account.</span></p>
						<div class="signin-info changeMtop2 ">
							{!! Form::open(['method' => 'POST' , 'url' => url('login')]) !!}
								<input type="hidden" name="step" value="2">
								<p><span class="mediumBold"> {!! Form::label('Please enter your email and password below.') !!}</span></p><br>
								<div class="existingL">{!! Form::label('Email Address') !!}</div>
								<div class="existingR">{!! Form::email('email', null ,[]) !!}</div>
								<div class="clear"></div>
								<div class="existingL">{!! Form::label('Password') !!}</div>
								<div class="existingR">{!! Form::password('password', []) !!}</div>
								<div class="clear"></div>
								<div class="existingL"></div>
								{!! Form::submit('SUBMIT',['class' => 'aquaBtn changeMtop minW' ]) !!}
								<!-- <input value="SUBMIT" class="aquaBtn changeMtop minW" type="submit"> --><br>
								<div class="existingL"></div>
								<div class="help">
									<img src="/images/info.png" class="tooltip tooltipstered"> Having problems signing in?<br>
									<a href="https://www.alliancevirtualoffices.com/password-reset.php" class="aqua">Password Recovery</a>
								</div>
							{!! Form::close() !!}
						</div>
						<span style="color: red; font-weight: bold; margin: 0 0 0 5px;"></span>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/tooltipster.css"/>
    <link rel="stylesheet" type="text/css" href="/css/themes/tooltipster-light.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery.tosrus.all.css"/>
@stop

@section('scripts')
    <script type="text/javascript" src="/js/jquery.tooltipster.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tosrus.min.all.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.tooltip').tooltipster({
				animation: 'fade',
				theme: 'tooltipster-light',
				trigger: 'hover',
				contentAsHTML: true,
				interactive: true,
                content: $('<span><span class="mediumBold">If you have forgotten your password please use our <br><a href="https://www.alliancevirtualoffices.com/password-recover.php" class="blue mediumBold">password recovery page</a></span> </span>')
            });
        });
    </script>
@stop