@if(isset($center))
	{!! Form::model($center, [ 'url' => url('centers/'.$center->id), 'method' => 'PUT' ]) !!}
		{!! Form::hidden('id', null) !!}
@else
	{!! Form::open([ 'url' => url('centers'), 'files' => true , 'method' => 'POST' ]) !!}
@endif
	@include('alerts.messages')

	<div class="panel panel-default">
		<div class="form-group">
			<div class="col-lg-12">
				<h2 class="text-uppercase">Center Photos</h2>
			</div>
		</div>
		<div class="col-lg-12">
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #1:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #2:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #3:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #4:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #5:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-1 text-right"><label>Photo #6:</label></div>
	    		<div class="col-md-3">{!! Form::file('photos[]', null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-1 text-right"><label>Category:</label></div>
	    		<div class="col-md-3">{!! Form::select('categories[]', ['' => '-Select-'] , null, [ 'class' => 'form-control' ]) !!}</div>
	    		<div class="col-md-2 text-right"><a href="#">(Optional Custom SEO)</a></div>
	    	</div>
		</div>
	    <div class="panel-body col-md-12">
		    <a href="#" class="pull-right"><i class="fa fa-plus"></i> Add New Photo</a>
	    </div>
		<div class="clearfix"></div>
	</div>

	<div class="panel panel-default">
		<div class="form-group">
			<div class="col-lg-12">
				<h2 class="text-uppercase">Center's Basic Information</h2>
			</div>
		</div>
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Billing Name:</label></div>
	    		<div class="col-md-8">{!! Form::text('building_name', null, [ 'class' => 'form-control', 'placeholder' => 'Billing Name' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X Address 1:</label></div>
	    		<div class="col-md-8">{!! Form::text('x_address_1', null, [ 'class' => 'form-control', 'placeholder' => 'X Address 1' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Floor / Suite #:</label></div>
	    		<div class="col-md-8">{!! Form::text('phone', null, [ 'class' => 'form-control', 'placeholder' => 'Floor / Suite #' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X Country:</label></div>
	    		<div class="col-md-8">{!! Form::select('x_country', ['' => '-Select-'], null, [ 'class' => 'form-control', 'placeholder' => 'X Country' ]) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>State</label></div>
	    		<div class="col-md-8">{!! Form::select('state', ['' => '-Select-'], null, [ 'class' => 'form-control', 'placeholder' => 'State' ]) !!}</div>
	    	</div>
	    </div>
	    <div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X City:</label></div>
	    		<div class="col-md-8">{!! Form::text('x_city', null, ['class' => 'form-control', 'placeholder' => 'X City']) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>County / Region:</label></div>
	    		<div class="col-md-8">{!! Form::select('county_region', [], null, ['class' => 'form-control', 'placeholder' => 'County / Region']) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X Postal Code:</label></div>
	    		<div class="col-md-8">{!! Form::text('x_postal_code', null, ['class' => 'form-control', 'placeholder' => 'X Postal Code']) !!}</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X Address Latitude:</label></div>
	    		<div class="col-md-8">
	    			<div class="input-group">
		    			{!! Form::text('x_address_latitute', null, ['class' => 'form-control', 'placeholder' => 'X Address Latitude']) !!}
			    		<span class="input-group-addon">GET</span>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>X Address Longitude:</label></div>
	    		<div class="col-md-8">
		    		<div class="input-group">
	    				{!! Form::text('x_address_longitute', null, ['class' => 'form-control', 'placeholder' => 'X Address Longitude']) !!}
		    			<span class="input-group-addon">GET</span>
	    			</div>
    			</div>
	    	</div>
	    </div>
	    <div class="clearfix"></div>
	</div>

	<div class="panel panel-default">
		<div class="form-group">
			<div class="col-lg-12">
				<h2 class="text-uppercase">Location & Amenities</h2>
			</div>
		</div>
		<div class="panel-body col-md-12">
	    	<div class="row form-group">
	    		<div class="col-md-2 text-right"><label>Location Description:</label></div>
	    		<div class="col-md-10">{!! Form::textarea('location_description', null, [ 'rows' => 5, 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}</div>
	    	</div>
	    </div>
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Amenities Description:<br><strong>ABCN</strong></label></div>
	    		<div class="col-md-8">{!! Form::textarea('amenities_description_abcn', null, [ 'rows' => 5, 'class' => 'form-control', 'placeholder' => 'Amenities Description' ]) !!}</div>
	    	</div>
		</div>
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Amenities Description:<br><strong>AVO</strong></label></div>
	    		<div class="col-md-8">{!! Form::textarea('amenities_description_avo', null, [ 'rows' => 5, 'class' => 'form-control', 'placeholder' => 'Amenities Description' ]) !!}</div>
	    	</div>
		</div>
	    <div class="clearfix"></div>
	</div>

	<div class="panel panel-default">
		<div class="form-group">
			<div class="col-lg-12">
				<h2 class="text-uppercase">Futures</h2>
			</div>
		</div>
		<div class="panel-body col-md-12">
	    	<div class="row form-group">
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    		<div class="col-md-4">
		    		{!! Form::text('futures[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    	</div>
	    </div>
	    <div class="panel-body col-md-12">
		    <a href="#" class="pull-right"><i class="fa fa-plus"></i> Add New Future</a>
	    </div>
	    <div class="clearfix"></div>
	</div>

	<div class="panel panel-default">
		<div class="form-group">
			<div class="col-lg-12">
				<h2 class="text-uppercase">Staff Member</h2>
			</div>
		</div>
		<div class="panel-body col-md-12">
	    	<div class="row form-group">
		    	<div class="col-md-1 text-right">
		    		<label>Name:</label>
		    	</div>
		    	<div class="col-md-4">
		    		{!! Form::text('staff_name', null, [ 'class' => 'form-control', 'placeholder' => 'Name' ]) !!}
	    		</div>
	    		<div class="col-md-1 text-right">
		    		<label>Phone:</label>
		    	</div>
	    		<div class="col-md-3">
		    		{!! Form::text('staff_phone[]', null, [ 'class' => 'form-control', 'placeholder' => 'Phone' ]) !!}
	    		</div>
	    		<div class="col-md-1 text-right">
		    		<label>Ext:</label>
		    	</div>
	    		<div class="col-md-2">
		    		{!! Form::text('staff_ext[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    	</div>
	    	<div class="row form-group">
		    	<div class="col-md-1 text-right">
		    		<label>Title:</label>
		    	</div>
		    	<div class="col-md-4">
		    		{!! Form::text('staff_title', null, [ 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
	    		</div>
	    		<div class="col-md-1 text-right">
		    		<label>Phone:</label>
		    	</div>
	    		<div class="col-md-3">
		    		{!! Form::text('staff_phone[]', null, [ 'class' => 'form-control', 'placeholder' => 'Phone' ]) !!}
	    		</div>
	    		<div class="col-md-1 text-right">
		    		<label>Ext:</label>
		    	</div>
	    		<div class="col-md-2">
		    		{!! Form::text('staff_ext[]', null, [ 'class' => 'form-control', 'placeholder' => 'Location Description' ]) !!}
	    		</div>
	    	</div>
	    	<div class="row form-group">
		    	<div class="col-md-1 text-right">
		    		<label>Email:</label>
		    	</div>
		    	<div class="col-md-4">
		    		{!! Form::email('email_name', null, [ 'class' => 'form-control', 'placeholder' => 'Email' ]) !!}
	    		</div>
	    	</div>	
	    </div>

	    <div class="panel-body col-md-12">
		    <a href="#" class="pull-right"><i class="fa fa-plus"></i> Add New Future</a>
	    </div>
	    <div class="clearfix"></div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			<button class='btn btn-block btn-lg btn-default'><i class="fa fa-plus"></i> Staff Member</button>
		</div>
		<div class="col-md-2">
			{!! Form::submit('Submit', [ 'class' => 'btn btn-block btn-lg btn-success' ]) !!}
		</div>
		<div class="clearfix"></div>
	</div>
{!! Form::close() !!}