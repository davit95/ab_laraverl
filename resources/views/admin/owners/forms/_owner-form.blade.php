@if(isset($owner_client))
	{!! Form::model($owner_client, [ 'url' => url('owners/'.$owner_client->id), 'method' => 'PUT' ]) !!}
	{!! Form::hidden('id', null) !!}
@else
	{!! Form::open([ 'url' => url('owners') ]) !!}
@endif
	@include('alerts.messages')
	<div class="panel panel-default">
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Company Name</label></div>
	    		<div class="col-md-8">{!! Form::text('company_name', null, [ 'class' => 'form-control', 'placeholder' => 'Company Name' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Name</label></div>
	    		<div class="col-md-8">{!! Form::text('first_name', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Name' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Phone</label></div>
	    		<div class="col-md-8">{!! Form::text('phone', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Phone' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Fax</label></div>
	    		<div class="col-md-8">{!! Form::text('fax', null, [ 'class' => 'form-control', 'placeholder' => 'Fax' ]) !!}</div>
	    	</div>
	    	<!-- <div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Website</label></div>
	    		<div class="col-md-8">{!! Form::text('url', null, [ 'class' => 'form-control', 'placeholder' => 'Website' ]) !!}</div>
	    	</div> -->
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Email</label></div>
	    		<div class="col-md-8">{!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Email' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Postal Code</label></div>
	    		<div class="col-md-8">{!! Form::text('postal_code', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Postal code' ]) !!}</div>
	    	</div>
	    	@if(!isset($owner))
		    	<div class="row form-group">
		    		<div class="col-md-4 text-right"><label>Password</label></div>
		    		<div class="col-md-8">{!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Password' ]) !!}</div>
		    	</div>
	    	@endif
	    </div>
	    <div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Billing Address 1</label></div>
	    		<div class="col-md-8">{!! Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Billing Address 1']) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Billing Address 2</label></div>
	    		<div class="col-md-8">{!! Form::text('address2', null, ['class' => 'form-control', 'placeholder' => 'Billing Address 2']) !!}</div>
	    	</div>
	    	<!-- <div class="row form-group">
	    		<div class="col-md-4 text-right"><label>County / Region</label></div>
	    		<div class="col-md-8">
	    			<select name="region" class="form-control" id="region">
	    				@foreach($regions_list as $region)
	    					@if( isset($owner_client) && null != $owner_client->region && $region == $owner_client->region->name)
	    						<option value="{{$region}}"  selected = "{{$region}}">{{$region}}</option>
	    					@else 
	    						<option value="{{$region}}">{{$region}}</option>
	    					@endif
	    				@endforeach
	    			</select>
	    		</div>
	    	</div> -->
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Country</label></div>
	    		<div class="col-md-8">
	    			<select name="country" class="form-control" id="country">
	    				@foreach($countries_list as $country)
	    					@if(isset($owner_client) && null != $owner_client->country && $country == $owner_client->country->name)
	    						<option value="{{$country}}"  selected = "{{$country}}">{{$country}}</option>
	    					@else 
	    						<option value="{{$country}}">{{$country}}</option>
	    					@endif
	    				@endforeach
	    			</select>
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>State</label></div>
	    		<div class="col-md-8">
	    			<select name="us_state" class="form-control" id="us_state">
	    				@foreach($states_list as $state)
	    					@if(isset($owner_client) && null != $owner_client->us_state && $state == $owner_client->us_state->name)
	    						<option value="{{$state}}"  selected = "{{$state}}">{{$state}}</option>
	    					@else 
	    						<option value="{{$state}}">{{$state}}</option>
	    					@endif
	    				@endforeach
	    			</select>
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>City</label></div>
	    		<div class="col-md-8">
	    			{!! Form::text('city', isset($owner_client) && null != $owner_client->city ? $owner_client->city->name : null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City']) !!}
	    			<!-- {!! Form::hidden('city_id', null, ['id' => 'city_id']) !!} -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Notes</label></div>
	    		<div class="col-md-8">
	    			{!! Form::textarea('notes', null, ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'Notes...']) !!}
	    			<!-- {!! Form::hidden('country_id', null, ['id' => 'country_id']) !!} -->
	    		</div>
	    	</div>
	    </div>
	    <!-- new here -->
	    @for($i = 1; $i <= 4; $i++)
		    <div class="panel-body col-md-12">
			    <div class="panel-body col-md-6">
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Contact Name</label></div>
			    		<div class="col-md-8">{!! Form::text('contact_name_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->name :null, [ 'class' => 'form-control', 'placeholder' => 'Contact Name' ]) !!}</div>
			    	</div>
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Title</label></div>
			    		<div class="col-md-8">{!! Form::text('title_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->title : null, [ 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}</div>
			    	</div>
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Phone</label></div>
			    		<div class="col-md-8">{!! Form::text('phone_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->phone_1 : null, [ 'class' => 'form-control', 'placeholder' => 'Phone' ]) !!}</div>
			    	</div>
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Phone</label></div>
			    		<div class="col-md-8">{!! Form::text('phone_1_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->phone_2 : null, [ 'class' => 'form-control', 'placeholder' => 'Phone' ]) !!}</div>
			    	</div>
			    </div>
			    <div class="panel-body col-md-6">
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Ext</label></div>
			    		<div class="col-md-8">
			    			{!! Form::text('ext_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->ext_1 : null, [ 'class' => 'form-control', 'placeholder' => 'ext' ]) !!}
			    		</div>
			    	</div>
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Ext</label></div>
			    		<div class="col-md-8">
			    			{!! Form::text('ext_1_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->ext_2 : null, [ 'class' => 'form-control', 'placeholder' => 'ext' ]) !!}
			    		</div>
			    	</div>
			    	<div class="row form-group">
			    		<div class="col-md-4 text-right"><label>Email</label></div>
			    		<div class="col-md-8">
			    			{!! Form::text('contact_email_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->email : null, [ 'class' => 'form-control', 'placeholder' => 'ext' ]) !!}
			    			{!! Form::hidden('staff_id_'.$i, isset($owner_client->staffs[$i-1])  ? $owner_client->staffs[$i-1]->id : null, [ ]) !!}
			    		</div>
			    	</div>
			    </div>
			</div> 
		@endfor
		<!--  -->

	    <div class="clearfix"></div>

	</div>
	<div class="row">
		<div class="col-md-12">
			@if(isset($center_id))
				{!! Form::hidden('center_id', $center_id, ['id' => 'center_id']) !!}
			@endif
			{!! Form::submit('Submit', [ 'class' => 'btn btn-lg btn-success' ]) !!}
			<a type="button" href="javascript:history.go(-1)" class="class' => 'btn btn-lg btn btn-info">Cancel</a>
			<!-- {!! Form::submit('Submit', [ 'class' => 'btn btn-lg btn btn-info' ]) !!} -->
		</div>
	</div>
{!! Form::close() !!}
@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop

@section('scripts')
  	<script type='text/javascript' src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type='text/javascript' src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var cities 	  = {!! $cities !!};
			var regions   = {!! $regions !!};
			var us_states = {!! $us_states !!};
			var countries = {!! $countries !!};
			var mapped;
			var checkMatches = function(strs) {
				return function findMatches(request, response) {
				    var matches = [];
				    mapped = [];
		      		substrRegex = new RegExp(request.term, 'i');

		      		$.each(strs, function(id, name) {
				      	if (substrRegex.test(name)) {
				        	matches.push(name);
				        	mapped[name] = id;
				      	}
				    });
			        response(matches.slice(0, 10));
			    }
			}
			$('#city').autocomplete({
		      	source: checkMatches(cities),
		      	select: function (event, ui) {
			        $("#city_id").val(mapped[ui.item.label]);
			    }
		    });
			$('#region').autocomplete({
		      	source: checkMatches(regions),
		      	select: function (event, ui) {
			        $("#region_id").val(mapped[ui.item.label]);
			    }
		    });
			$('#us_state').autocomplete({
		      	source: checkMatches(us_states),
		      	select: function (event, ui) {
			        $("#us_state_id").val(mapped[ui.item.label]);
			    }
		    });
			$('#country').autocomplete({
		      	source: checkMatches(countries),
		      	select: function (event, ui) {
			        $("#country_id").val(mapped[ui.item.label]);
			    }
		    });
		});  
	</script>
@stop