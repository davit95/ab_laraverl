<?php $counter = 0;?>
<table width="100%" cellpadding="5" cellspacing="2" border="0">
	<tr>
		<td valign="top" class="col_one">
			@foreach($countries as $country)
				@if ($counter++)
					<div class="city-header"><a href="{!! URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $country->slug])!!}" class="style5" title="irtual offices">{!! $country->name !!}</a></div>
					@if($counter === 10)
						</td><td valign="top" class="col_two">
					@endif
					@if($counter === 20)
						</td><td valign="top" class="col_three">
					@endif
				@endif
			@endforeach
		</td>
	</tr>
</table>