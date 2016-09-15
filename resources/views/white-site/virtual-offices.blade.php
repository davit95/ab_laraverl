@extends('white-site.layouts.layout')
@section('content')
	<div class="col-md-12 virtual-offices">
		<div class="row">
			<div class="col-md-12 title">
				The 5 Minute Office		
			</div>
			<div class="subtitle col-md-6">
				With <b>more than 650 locations in 40 countries</b>, we have the perfect option for every need and every budget.
			</div>
			<div class="col-md-12 list">
				<p>To select the options that perfectly suit your need, you may want to consider the following factors:</p>
				<ul>
					<li>PRESTIGE OF ADDRESS</li>
					<li>TELECOMMUNICATION NEEDS</li>
					<li>OFFICE AMENITIES</li>
					<li>CONFERENCE ROOMS</li>
				</ul>
			</div>
			<div class="col-md-6 description">
				You can open <b>multiple offices</b> with us. 
				For five offices or more, ask us about our special multi-office and customized packages.
			</div>
			<div class="col-md-12 find-location">
				<div class="title">
					1. SELECT A LOCATION
				</div>
				<div class="subtitle">
					To find the right location for you, please start by selecting a region:
				</div>
				<div class="search col-md-6">
					<div class="row">
						<select name="country" id="countries">
							<option value="">Please Select</option>
							@foreach($countries as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
						<select name="state" id="states" style="display:none">
							<option value="">Please Select</option>
							@foreach($states as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	<script>
		$(document).on('ready', function(){
			$('#countries').on('change', function(){
				if($(this).val() == "US"){
					$('#states').show();
				}else{
					$('#states').hide();
				}
			})			
		})
	</script>
@stop