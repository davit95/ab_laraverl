<div class="panel panel-default">
    <div class="panel-body col-md-6">
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Company Name:</label></div>
    		<div class="col-md-8">{{ $owner->company_name }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Owner's Name:</label></div>
    		<div class="col-md-8">{{ $owner->name }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Owner's Phone:</label></div>
    		<div class="col-md-8">{{ $owner->phone }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Fax:</label></div>
    		<div class="col-md-8">{{ $owner->fax }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Website:</label></div>
    		<div class="col-md-8"><a target="_blank" href="{{ $owner->url }}">{{ $owner->url }}</a></div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Owner's Email:</label></div>
    		<div class="col-md-8">{{ $owner->email }}</div>
    	</div>
    </div>
    <div class="panel-body col-md-6" style="border-left:1px solid #ccc;">
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Billing Address 1:</label></div>
    		<div class="col-md-8">{{ $owner->address1 }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Billing Address 2:</label></div>
    		<div class="col-md-8">{{ $owner->address2 }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>City:</label></div>
    		<div class="col-md-8">{{ $owner->city }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>County / Region:</label></div>
    		<div class="col-md-8">{{ $owner->region }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>State:</label></div>
    		<div class="col-md-8">{{ $owner->us_state }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 text-right"><label>Country:</label></div>
    		<div class="col-md-8">{{ $owner->country }}</div>
    	</div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-footer">
        <a href="{{ url('centers/create') }}" class="pull-right" style="margin-left:20px;"><i class="fa fa-plus"></i> Add Center</a>
        <a href="{{ url('owners/'.$owner->id.'/edit') }}" class="pull-right" style="margin-left:20px;"><i class="fa fa-edit"></i> Edit Owner</a>
        <div class="clearfix"></div>
    </div>
</div>