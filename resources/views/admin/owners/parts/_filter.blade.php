{!! Form::open([ 'url' => url('owners') , 'method' => 'GET' ]) !!}
	<div class="col-md-3">
		{!! Form::text('company_or_owner_name', Request::get('company_or_owner_name'), [ 'class' => 'form-control' , 'placeholder' => 'Company or Owner\'s Name', 'id' => 'company_or_owner_name' ]) !!}
	</div>
	<button type="submit" class="pull-left btn btn-success"><i class="fa fa-search"></i></button>
{!! Form::close() !!}