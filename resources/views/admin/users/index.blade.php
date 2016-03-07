@extends('admin.layouts.layout')

@section('page-header')
	Owners & Centers
@stop
@section('content_top')    
    <div class="ct_icon_au"></div> 
    <div class="ct_wrapp">
	    <div class="ct_title"><h1>ACCOUNTS &amp; USERS</h1></div> 
	    <!-- <div class="ct_tools">
	    	<input class="ct_input" type="text"> <a href="#" class="search_btn"></a>	     
	    </div> --> 
	    {!! Form::open([ 'url' => url('users') , 'method' => 'GET' ]) !!}
	    	<div class="ct_tools">
	    		{!! Form::text('account_or_user', Request::get('account_or_user'), [ 'class' => 'ct_input','id' => 'company_or_owner_name' ]) !!}
	    	</div>
	    	<button type="submit" class="search_btn"></button>
	    {!! Form::close() !!}
    </div> 
    <div class="clear"></div>
@stop
@section('content')
	@include('alerts.messages')
	<div class="content">
		<div class="h2wrapp">
			<div class="h2Icon add_green"></div>
			<a href="javascript:void(0);" class="gLink addAccount">
				<div class="h2txt">
					<h2>NEW ACCOUNT</h2>
				</div>
			</a>
		</div>
		<div class="w_box newAccountToggle">
			<div class="form_left">
			{!! Form::open([ 'url' => url('users') , 'method' => 'post' ]) !!}
				Company Name: <input type="text" class="f1" name="company_name"><br>
				First Name: <input type="text" class="f1" name="first_name"><br>
				Last Name: <input type="text" class="f1" name="last_name"><br>
				Phone: <input type="text" class="f1" name="phone"><br>
				Fax: <input type="text" class="f1" name="fax"><br>
				Web Site: <input type="text" class="f1" name="website"><br>
				Email: <input type="text" class="f1" name="email"><br>
				Member Type:&nbsp;
				<div class="select_style change left">
					<span class="selectcon">&nbsp;</span>
					<div class="niceselect undefined" data-multi="false">
						<p class="top">Select</p>
						<div class="value_wrapper" style="display: none;">
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="Select" data-text="Select" id="0undefined0"> 
								<label class="nice_label">Select</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="prefered member" data-text="Preferred Member" id="1undefined1"> 
								<label class="nice_label">Preferred Member</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="performance member" data-text="Performance Member" id="2undefined2"> 
								<label class="nice_label">Performance Member</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="AVO participation only location" data-text="AVO Participation Only Location" id="3undefined3"> 
								<label class="nice_label">AVO Participation Only Location</label>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="form_right">
				Billing Address 1: <input type="text" class="f1" name="address1"><br>
				Billing Address 2: <input type="text" class="f1" name="address2"><br>
				City: <input type="text" class="f1" name="city"><br>
				County / Region: <input type="text" class="f1" name="region"><br>
				State: <input type="text" class="f1" name="state"><br>
				Country:&nbsp;
			<div class="select_style change left"><span class="selectcon">&nbsp;</span><div class="niceselect undefined" data-multi="false"><p class="top">Select Country</p><div class="value_wrapper" style="display: none;"><div class="values"><input type="radio" style=" pointer-events: none;" name="undefined" value="placeholder" data-text="Select Country" id="0undefined0"> <label class="nice_label">Select Country</label></div><div class="values"><input type="radio" style=" pointer-events: none;" name="undefined" value="Country" data-text="Country" id="1undefined1"> <label class="nice_label">Country</label></div><div class="values"><input type="radio" style=" pointer-events: none;" name="undefined" value="Country" data-text="Country" id="2undefined2"> <label class="nice_label">Country</label></div><div class="values"><input type="radio" style=" pointer-events: none;" name="undefined" value="Country" data-text="Country" id="3undefined3"> <label class="nice_label">Country</label></div></div></div></div><br>
			Notes: <textarea class="f1_t"></textarea><br>
			</div>
			<div class="submit_w ShowSubmit">
				<button class="btn submit_btn">SUBMIT</button>
			</div> 
			{!! Form::close() !!}
			<div class="clear"></div>
		</div>
		<div class="h2wrapp">
			<div class="h2Icon add_green"></div>
			<a href="javascript:void(0);" class="gLink addUser">
				<div class="h2txt">
					<h2>NEW USER</h2>
				</div>
			</a>
		</div>
		<div class="w_box newUserToggle">
			<div class="form_left">
			{!! Form::open([ 'url' => url('users') , 'method' => 'post' ]) !!}
			<!-- <div>
						{!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
						{!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required']) !!}
						@if($errors->has('name'))
							<small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
						@endif
					</div> -->
				<div>
					{!! Form::label('First Name:')!!}
					{!! Form::text('First Name:',null, ['class' => 'f1', 'name' => 'first_name'])!!}
				</div>
				<div>
					{!! Form::label('Last Name:')!!}
					{!! Form::text('Last Name:',null, ['class' => 'f1', 'name' => 'last_name'])!!}
				</div>
				<!-- First Name: <input type="text" class="f1" name="staffFirstname"><br>
				Last Name: <input type="text" class="f1" name="staffLastname"><br> -->
				Role:&nbsp;
				<div class="select_style change left"><span class="selectcon">&nbsp;</span>
					<div class="niceselect undefined" data-multi="false"><p class="top">Select</p>
						<div class="value_wrapper">
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="Select" data-text="Select" id="0undefined0"> 
								<label class="nice_label">Select</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="super admin" data-text="Super Admin" id="1undefined1"> 
								<label class="nice_label">Super Admin</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="admin" data-text="Admin" id="2undefined2"> 
								<label class="nice_label">Admin</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="client user" data-text="Client User" id="3undefined3"> 
								<label class="nice_label">Client User</label>
							</div>
							<div class="values">
								<input type="radio" style=" pointer-events: none;" name="undefined" value="client restricted user" data-text="Client Restricted User" id="4undefined4"> 
								<label class="nice_label">Client Restricted User</label>
							</div>
							<div class="values">
							<input type="radio" style=" pointer-events: none;" name="undefined" value="owner user" data-text="Owner User" id="5undefined5"> 
							<label class="nice_label">Owner User</label>
						</div>
						<div class="values">
							<input type="radio" style=" pointer-events: none;" name="undefined" value="owner restricted user" data-text="Owner Restricted User" id="6undefined6"> 
							<label class="nice_label">Owner Restricted User</label>
						</div>
						<div class="values">
							<input type="radio" style=" pointer-events: none;" name="undefined" value="user" data-text="User (ABCN Personnel)" id="7undefined7"> 
							<label class="nice_label">User (ABCN Personnel)</label>
						</div>
						<div class="values">
							<input type="radio" style=" pointer-events: none;" name="undefined" value="restricted user" data-text="Restricted User (ABCN Personnel)" id="8undefined8"> 
							<label class="nice_label">Restricted User (ABCN Personnel)</label>
						</div>
					</div>
				</div>
			</div>
		<div class="clear"></div>
		</div> 
		<div class="form_right">
		<!-- <div>
			{!! Form::label('User Name:')!!}
			{!! Form::text('User Name:',null, ['class' => 'f1', 'name' => 'username'])!!}
		</div>
		<div>
			{!! Form::label('email:')!!}
			{!! Form::email('email:',null, ['class' => 'f1', 'name' => 'email'])!!}
		</div>
		<div>
			{!! Form::label('password:')!!}
			{!! Form::password('password',null, ['class' => 'f1', 'name' => 'password'])!!}
		</div> -->
		User Name: <input type="text" class="f1" name="UserName"><br>
		Email: <input type="text" class="f1" name="email"><br>
		Password: <input type="password" class="f1" name="password">
		</div> 
		<div class="submit_w ShowSubmit">
			<button class="btn submit_btn">SUBMIT</button>
		</div>
		{!! Form::close() !!}
		<div class="clear"></div>
		</div>	
	</div>
@stop      

<!-- {!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
		<div>
						{!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
						{!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required']) !!}
						@if($errors->has('name'))
							<small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
						@endif
					</div>
					{!! Form::close() !!}
		 -->   
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$( window ).resize(function() {
			if ($(window).width() > 880) {
				$( ".menu" ).show()
			}
			else {
				$( ".menu" ).hide()
			}
			});
			$('.change').niceselect();

			$('.addAccount').click(function() {
				$( ".newAccountToggle" ).toggle();
				$( ".newUserToggle" ).hide();
				$( ".ShowSubmit" ).show();
			});
			$('.addUser').click(function() {
				$( ".newUserToggle" ).toggle();
				$( ".newAccountToggle" ).hide();
				$( ".ShowSubmit" ).show();
			});
		});
	</script>

@stop