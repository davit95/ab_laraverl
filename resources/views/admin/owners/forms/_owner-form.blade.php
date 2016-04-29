@if(isset($owner))
	{!! Form::model($owner, [ 'url' => url('owners/'.$owner->id), 'method' => 'PUT' ]) !!}
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
	    		<div class="col-md-8">{!! Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Name' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Phone</label></div>
	    		<div class="col-md-8">{!! Form::text('phone', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Phone' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Fax</label></div>
	    		<div class="col-md-8">{!! Form::text('fax', null, [ 'class' => 'form-control', 'placeholder' => 'Fax' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Website</label></div>
	    		<div class="col-md-8">{!! Form::text('url', null, [ 'class' => 'form-control', 'placeholder' => 'Website' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Email</label></div>
	    		<div class="col-md-8">{!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Email' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Postal Code</label></div>
	    		<div class="col-md-8">{!! Form::text('postal_code', null, [ 'class' => 'form-control', 'placeholder' => 'Owner\'s Email' ]) !!}</div>
	    	</div>
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
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>City</label></div>
	    		<div class="col-md-8">
	    			{!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City']) !!}
	    			<!-- {!! Form::hidden('city_id', null, ['id' => 'city_id']) !!} -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>County / Region</label></div>
	    		<div class="col-md-8">
	    			{!! Form::select('region', $regions_list, null, ['class' => 'form-control', 'id' => 'region', 'placeholder' => 'County / Region']) !!}
	    			<!-- {!! Form::hidden('region_id', null, ['id' => 'region_id']) !!} -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>State</label></div>
	    		<div class="col-md-8">
	    			{!! Form::select('state', $states_list, null, ['class' => 'form-control', 'id' => 'us_state', 'placeholder' => 'State']) !!}
	    			<!-- {!! Form::hidden('us_state_id', null, ['id' => 'us_state_id']) !!} -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Country</label></div>
	    		<div class="col-md-8">
	    			{!! Form::select('country', $countries_list, null, ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'Country']) !!}
	    			<!-- {!! Form::hidden('country_id', null, ['id' => 'country_id']) !!} -->
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