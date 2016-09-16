@extends('white-site.layouts.layout')
@section('content')
	<div class="col-md-12 virtual-offices">
		<input type="hidden" id="white_site_id" value="{{ $white_site->id }}">
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
							<option value="">Please Select a Country</option>
							@foreach($countries as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
						<select name="state" id="states" style="display:none">
							<option value="">Please Select a State</option>
							@foreach($states as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
						<select name="cities" id="cities" style="display:none">
							<option value="">Please Select a City</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="centers row"></div>
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
				}else if($(this).val() == ""){
					$('#cities').hide();
					$('#states').hide();
				}
				else{
					$.get('/white-site/' + $('#white_site_id').val() + '/get-cities-by-country-state?country=' + $('#countries').val())
					.then(function(data){
						$('#cities').find('option').remove();
						$('#cities').append('<option value="">Please Select City</option>');
						var cities = data.cities;
						for(var city in cities){
							$('#cities').append(
								'<option value="' + city + '">' + cities[city] + '</option>'
							);
						}
						$('#cities').show();
					})					
					$('#states').hide();
				}
			})
			$('#states').on('change', function(){
				$.get('/white-site/' + $('#white_site_id').val() + '/get-cities-by-country-state?country=' + $('#countries').val() + '&state=' + $('#states').val())
				.then(function(data){
					$('#cities').find('option').remove();
					$('#cities').append('<option value="">Please Select City</option>');
					var cities = data.cities;
					for(var city in cities){
						$('#cities').append(
							'<option value="' + city + '">' + cities[city] + '</option>'
						);
					}
					$('#cities').show();
				})
			})
			$('#cities').on('change', function(){
				$.get('/white-site/'  + $('#white_site_id').val() +  '/get-centers-list?country=' + $('#countries').val() + '&state=' + $('#states').val() + '&city_id=' + $(this).val())
				.then(function(data){
					var centers = data.centers;
					for( var center in centers ){
						var path = "";
						if(centers[center].vo_photos[0]){
							path = 'http://www.abcn.com/images/photos/' + centers[center].vo_photos[0].path;
						}
						$('.centers').append(
							'<div class="col-md-3">' +
								'<div class="col-md-12 center">' +
									'<div class="row">' +
										'<div class="col-md-4 image">' +
											'<div class="row">' +
												'<img src="' + path + '" width="100%">' +
											'</div>' +
										'</div>' +
										'<div class="col-md-8 info">' +
											'<div class="row">' +
												'<div class="address">' +
													'<b>' + centers[center].address1 + '</b>' +
													'<br>' +											
													centers[center].name +
													'<br>' +
													centers[center].address2 +
													'<br>' +
													centers[center].city_name + ', ' + centers[center].us_state + ' ' + 
													centers[center].postal_code + ' ' + centers[center].country +
													'<br><br>' +
												'</div>' +
												'<a class="center-show-link" href="/white-site/' + $('#white_site_id').val() + '/virtual-offices/' + centers[center].id + '"' +'">' + 
													'SELECT THIS CENTER' +
												'</a>' +
											'</div>' +
										'</div>' +
									'</div>' +
								'</div>' +								
							'</div>'
						);
					}
				})
			})
		})
	</script>
@stop