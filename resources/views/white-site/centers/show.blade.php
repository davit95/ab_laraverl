@extends('white-site.layouts.layout')
@section('content')
	<div class="col-md-8 col-md-offset-2 center-show">
		<div class="col-md-7 address-image">
			<div class="col-md-5">
				<div class="row">
					@if(isset($center['vo_photos']) && !empty($center['vo_photos']))
						<img src="http://www.abcn.com/images/photos/{{ $center['vo_photos'][0]['path'] }}" alt="" width="100%">
					@endif
					<div class="address">
						<div class="title">
							Address
						</div>
						<div class="location">
							{{ $center['address1'] }}<br>
							{{ $center['address2'] }}<br>
							{{ $center['city_name'] }} {{ $center['us_state'] }} {{ $center['postal_code'] }} {{ $center['country'] }}
						</div>
					</div>					
				</div>
			</div>
		</div>
		<div class="col-md-5 packages">
			
		</div>
	</div>
@stop