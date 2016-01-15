<table width="100%" cellpadding="5" cellspacing="2" border="0">
	<tr>
		<td valign="top" class="col_one">
			@foreach($countries as $counter => $country)
				<div class="city-header"><a href="{!! URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $country->slug])!!}" class="style5" title="Virtual offices">{!! $country->name !!}</a></div>
				@if($counter === 9)
					</td><td valign="top" class="col_two">
				@endif
				@if($counter === 19)
					</td><td valign="top" class="col_three">
				@endif
			@endforeach
		</td>
	</tr>
</table>