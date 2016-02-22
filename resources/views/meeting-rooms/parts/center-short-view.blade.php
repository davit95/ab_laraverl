<div class='TheResult'>
	<div class='ImageInfo'>
    	<div class='moreInfoBtn'><img src='/images/moreInfo.png' border='0' /></div>
        <div class='ImageInfo2'>
            @if($center->virtual_office_seo)
            	<p>{!! $center->virtual_office_seo->sentence1!!} {!! $center->virtual_office_seo->sentence2!!} {!! $center->virtual_office_seo->sentence3!!}</p>
            @endif
        </div>
    </div>
    <div class='imageSlider'>
    	<ul class='bxslider'>
            @forelse($center->mr_photos as $photo)
                <li><div class='img-wrapper'><img src='/mr-photos/all/{!! $photo->path !!}' alt="{!! $photo->alt !!}" /></div></li>
            @empty
                @if(is_null($photo = $center->vo_photos()->first()))
                    <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/no_pic.gif' alt=''></div></li>
                @else
                    <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/{!! $photo->path !!}' alt='{!! $photo->alt !!}'></div></li>
                @endif
            @endforelse
        </ul>
    </div>
    <div class='ResultBtns'><a href="{!! URL::action('MeetingRoomsController@getMeetingRoomShowPage', ['contry_code' => $center->city->country_code, 'city_slug' => $center->city->slug, 'center_slug' => $center->slug, 'center_id' => $center->id])!!}"><div class='btnMoreInfo' style='width: 100%;'>MORE INFORMATION</div></a></div>
    <div class='CenterPrice gray1'>
        @if($center->meeting_room_lowest_price && $center->meeting_room_lowest_price->min_price )
            <span class="starting gray3">STARTING AT:</span> <span class="signo">{!! session('currency.symbol') !!}</span><span class="ammount">{!! round($center->meeting_room_lowest_price->min_price*session('rate'), 2) !!}</span>
            <span class="usd">per hour</span>
        @else
            <span class="starting gray3">CALL FOR PRICING</span>
        @endif
    </div>
    <div class='CenterImpInf'>
    	@if($center->virtual_office_seo)
    		<h2>{!! $center->virtual_office_seo->h3 !!}</h2>
    	@endif
        <p>
        	<span class='rcName gray2'>{!! $center->building_name !!}</span><br>
            <span class='rcAddress gray3'>{!! $center->address1 !!} {!! $center->address2 !!}, {!! $center->city_name !!}, {!!$center->us_state!!} {!! $center->postal_code !!}</span>
        </p>
        <a href="{!! URL::action('VirtualOfficesController@getVirtualOfficeShowPage', ['country_code' => $center->country, 'city_slug' => $center->city? $center->city->slug : '', 'center_slug' => $center->slug, 'center_id' => $center->id])!!}" class="gray3 mediumBold">
            Try a {!! $center->name !!} Virtual Office
        </a>
    </div>
</div>
