@extends('admin.layouts.layout')

@section('page-header')
	MANAGE WHITE SITE
@stop

@section('content_top')	
    <div class="ct_wrapp">
        <div class="ct_title"><h1>MANAGE WHITE SITE</h1></div>        
    </div>
@stop
@section('content')
	<link rel="stylesheet" href="/admin_assets/admin/css/white-site.css">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<b>Select the Centers you would NOT like included on your site</b>
			</div>			
			<div class="col-md-12">
				<span>Select a Center (Hold Ctrl to select multiple centers)</span>
			</div>
		</div>
		<select name="" id="" multiple class="form-control included_centers" id="included_centers">
			@foreach($included_centers as $center_id => $center_name)
				<option value="{{ $center_id }}">{{ $center_name }}</option>
			@endforeach
		</select>
		<button class="remove_centers btn btn-default">Remove These Centers</button>
	</div>	
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<b>Select the Centers to be re-included on your site</b>
			</div>
			<div class="col-md-12">
				<span>Select a Center (Hold Ctrl to select multiple centers)</span>
			</div>			
		</div>
		<select name="" id="" multiple class="removed_centers form-control">
			@foreach($removed_centers as $center_id => $center_name)
				<option value="{{ $center_id }}">{{ $center_name }}</option>
			@endforeach
		</select>
		<button class="add_centers btn btn-default">Include These Centers</button>
	</div>
	<div class="col-md-8 product_offerings">
		<h3>Whitesite Product Offerings</h3>
		<span>Please select from the options below which product(s) you would like to offer on your white site.</span>
		{!! Form::model($offerings, ['url' => '/white-site/offerings/update', 'mathod' => 'POST']) !!}
			<div class="row">
				<div class="col-md-12">
					{!! Form::checkbox('virtual_offices_offers', '1',  false, ['id' => 'virtual_offices_offers']) !!}
					<label for="">Virtual office</label>
				</div>
				<div class="col-md-12">
					{!! Form::checkbox('meeting_rooms_offers', '1', false, ['id' => 'meeting_rooms_offers']) !!}					
					<label for="">Meeting room</label>
				</div>
				<div class="col-md-6">
					{!! Form::submit('submit', ['class' => 'btn btn-default']) !!}					
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-8 site_logo">		
		@if(isset($white_site) && isset($white_site['logo']) && $white_site['logo'] != "")
			<h3><b>Your logo is</b></h3>
			<div class="row">
				<div class="col-md-6">
					<img src="/whitesite_logos/{{ $white_site['logo'] }}" width="100%">
				</div>
			</div>
		@else
			<b><h3>Upload your logo</h3></b>
		@endif
		{!! Form::open(['url' => '/white-site/logo/update', 'mathod' => 'POST', 'files' => true]) !!}
			<div class="row">
				<div class="col-md-8">
					{!! Form::file('logo') !!}
				</div>
				<div class="col-md-6">
					{!! Form::submit('submit', ['class' => 'btn btn-default logo_submit']) !!}					
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-8 company_information">
		<b><h3>Company Information</h3></b>
		{!! Form::model($white_site, ['url' => '/white-site/company-information/update', 'mathod' => 'POST']) !!}
			<div class="row">
				<div class="col-md-8">
					{!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name']) !!}
				</div>
				<div class="col-md-8">
					{!! Form::text('company_phone', null, ['class' => 'form-control', 'placeholder' => 'Company Phone']) !!}
				</div>
				<div class="col-md-8">
					{!! Form::text('company_home_url', null, ['class' => 'form-control', 'placeholder' => 'Company Home Url']) !!}
				</div>
				<div class="col-md-6">
					{!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-8 url">
		<p>
			In order to set up your white site you must simply point to this URL. All transactions made via this unique URL will be credited to you.

			<a href="{{ env('APP_URL') }}/white-site/{{ Auth::id() }}">{{ env('APP_URL') }}/white-site/{{ $white_site->id }}</a>
		</p>
	</div>
@stop
@section('scripts')
	<script>		
		$('.remove_centers').on('click',function(){
			var center_ids = $('.included_centers').val();			
			if(center_ids){
				$.post('/white-site/remove-center-from-white-site', {
					ids : center_ids
				})
				.then(function(data){
					if(data.status == "success"){
						$('.included_centers option').each(function() {
						    if ( center_ids.indexOf($(this).val()) > -1 ) {
						    	var center_name = $(this).html();
						    	var center_id = $(this).val();
								$('.removed_centers')
								  .append($('<option>', { value : center_id })
								  .text(center_name));
						        $(this).remove();
						    }
						});
					}
				})
			}
		})
		$('.add_centers').on('click',function(){
			var center_ids = $('.removed_centers').val();
			if(center_ids){
				$.post('/white-site/add-center-to-white-site', {
					ids : center_ids
				})
				.then(function(data){
					if(data.status == "success"){
						$('.removed_centers option').each(function() {
						    if ( center_ids.indexOf($(this).val()) > -1 ) {
						        var center_name = $(this).html();
						    	var center_id = $(this).val();
								$('.included_centers')
								  .prepend($('<option>', { value : center_id })
								  .text(center_name));
						        $(this).remove();
						    }
						});
					}
				})
			}
		})		
	</script>
@stop