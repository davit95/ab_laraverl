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
                <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/no_pic.gif' alt=''></div></li>
            @endforelse
        </ul>
    </div>
    <div class='ResultBtns'><a href="{!! URL::action('MeetingRoomsController@getMeetingRoomShowPage', ['contry_code' => $center->city->country_code, 'city_slug' => $center->city->slug, 'center_slug' => $center->slug])!!}"><div class='btnMoreInfo' style='width: 100%;'>MORE INFORMATION</div></a></div>
    <div class='CenterPrice gray1'>
        @if($center->meeting_room_lowest_price && $center->meeting_room_lowest_price->min_price )
            <span class="starting gray3">STARTING AT:</span> <span class="signo">$</span><span class="ammount">{!! $center->meeting_room_lowest_price->min_price !!}</span>
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
        	<span class='rcName gray2'>{!! $center->bulding_name !!}</span><br>
            <span class='rcAddress gray3'>{!! $center->address1 !!} {!! $center->address2 !!}, {!! $center->postal_code !!}</span>
        </p>
    </div>
</div>
