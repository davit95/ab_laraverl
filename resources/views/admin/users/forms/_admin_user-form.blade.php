@if(isset($user))
	{!! Form::model($user, [ 'url' => url('users/'.$user->id), 'method' => 'PUT' ]) !!}
@else
	{!! Form::open([ 'url' => url('users') ]) !!}
@endif
	@include('alerts.messages')

	<div class="panel panel-default">
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		{!! Form::hidden('id', null) !!}
	    		{!!Form::hidden('user_type', $user_type)!!}
	    	</div> 
	    	<!-- <div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Create A User Name</label></div>
	    		<div class="col-md-8">{!! Form::text('username', null, [ 'class' => 'form-control', 'placeholder' => 'user name' ]) !!}</div>
	    	</div> -->
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Users Email Address:</label></div>
	    		<div class="col-md-8">{!! Form::text('email', null, [ 'class' => 'form-control', 'placeholder' => 'Csr\'s Email' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Create A First Name</label></div>
	    		<div class="col-md-8">{!! Form::text('first_name', null, [ 'class' => 'form-control', 'placeholder' => 'first name' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Create A Last Name</label></div>
	    		<div class="col-md-8">{!! Form::text('last_name', null, [ 'class' => 'form-control', 'placeholder' => 'last name' ]) !!}</div>
	    	</div>
	    	@if(!isset($user))
		    	<div class="row form-group">
		    		<div class="col-md-4 text-right"><label>Create A Password</label></div>
		    		<div class="col-md-8">{!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'password' ]) !!}</div>
		    	</div>
		    @endif
	    </div>
	    <div class="panel-body col-md-6">
	    	
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Phone Number:</label></div>
	    		<div class="col-md-8">{!! Form::text('phone', null, [ 'class' => 'form-control', 'placeholder' => 'phone' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Address1:</label></div>
	    		<div class="col-md-8">{!! Form::text('address1', null, [ 'class' => 'form-control', 'placeholder' => 'address1' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Address2:</label></div>
	    		<div class="col-md-8">{!! Form::text('address2', null, [ 'class' => 'form-control', 'placeholder' => 'address2' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Postal Code:</label></div>
	    		<div class="col-md-8">{!! Form::text('postal_code', null, [ 'class' => 'form-control', 'placeholder' => 'postal code' ]) !!}</div>
	    	</div>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(isset($center_id))
				{!! Form::hidden('center_id', $center_id, ['id' => 'center_id']) !!}
			@endif
			{!! Form::submit('Submit', [ 'class' => 'btn btn-lg btn-success' ]) !!}
		</div>
	</div>
{!! Form::close() !!}
@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop

