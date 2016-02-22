<div class='TheResult'>
    <div class="wrapRboxes">
        <div class="PlanFt1">
            <div class="PlanFtsHeight">
                <div class="RPBtop2">BACK <span class="melon bold">⟨</span></div>
                <div class="PlanFtName">
                    <div class="RPBleft bold lh1">Platinum</div>
                    @if(isset($center->packages_arr['Platinum']))
                        <div class="RPBright lh1">
                            {!! session('currency.symbol') !!}
                            {{ round($center->packages_arr['Platinum']->price*session('rate'), 2)}}
                            <span class="smallText">/MONTH</span>
                        </div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
                <div class="planFts">
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Business Address</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Mail Receipt</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Mail Forwarding*</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Personal Mail Box</div></div><!--/planFtsLine-->
                    <div class="planFtsLine EFline">*Extra fees may apply</div>
                </div>
            </div>
            <div class="PlanFtsBtns">
                <a class="popup-with-form" href="/pricing-grids/{!! $center->id !!}">
                    <div class="PlanFtsbtnL">COMPARE</div>
                </a>
                <a href="{{ url('/customize-mail?p=103&cid='.$center->id) }}">
                    <div class="PlanFtsbtnR">SELECT</div>
                </a>
            </div>
        </div>
        <div class="PlanFt2">
            <div class="PlanFtsHeight">
                <div class="RPBtop2">BACK <span class="melon bold">⟨</span></div>
                <div class="PlanFtName">
                    <div class="RPBleft2 bold">Platinum<br>with Live Receptionist</div>
                    @if(isset($center->packages_arr['Platinum']))
                        <div class="RPBright2">
                            <span class="lineTrough smallText">
                                {!! session('currency.symbol') !!}
                                {{ round($center->packages_arr['Platinum']->with_live_receptionist_full_price*session('rate'), 2)}}
                                <span class="smallText">/MONTH</span>
                            </span>
                            <br>
                            <span class="melon bold">
                                <span class="bigPrice2">
                                    {!! session('currency.symbol') !!}
                                    {{ round($center->packages_arr['Platinum']->with_live_receptionist_pack_price*session('rate'), 2) }}
                                </span>
                                <span class="smallText">/MONTH</span>
                            </span>
                        </div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
                <div class="planFts">
                    <div class="planFtsLine">
                        <div class="planListR bold"><div class="includedIcon"></div>EVERYTHING IN PLATINUM</div>
                    </div>
                    <div class="planFtsLine"><div class="planListR"><div class="plusIcon"></div>PLUS</div></div>
                    @foreach($center->telephony_includes_arr as $include)
                        <div class="planFtsLine">
                            <div class="planListR"><div class="includedIcon"></div>{!! $include->include !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="PlanFtsBtns">
                <a class="popup-with-form" href="/pricing-grids/{!! $center->id !!}">
                    <div class="PlanFtsbtnL">COMPARE</div>
                </a>
                <a href="{{ url('/customize-mail?p=103&b=402&cid='.$center->id) }}">
                    <div class="PlanFtsbtnR">SELECT</div>
                </a>
            </div>
        </div>
        <div class="PlanFt3">
            <div class="PlanFtsHeight">
                <div class="RPBtop2">BACK <span class="melon bold">⟨</span></div>
                <div class="PlanFtName">
                    <div class="RPBleft bold lh1">Platinum Plus</div>
                    @if(isset($center->packages_arr['Platinum Plus']))
                        <div class="RPBright lh1">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum Plus']->price*session('rate'), 2) }} <span class="smallText">/MONTH</span></div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
                <div class="planFts">
                    <div class="planFtsLine"><div class="planListR bold"><div class="includedIcon"></div>EVERYTHING IN PLATINUM</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="plusIcon"></div>PLUS</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>16 Hours of Meeting Room or Private Office Time</div></div><!--/planFtsLine-->
                </div><!--/planFts-->
            </div><!--/PlanFtsHeight-->
            <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids/{!! $center->id !!}"><div class="PlanFtsbtnL">COMPARE</div></a><a href="{{ url('/customize-mail?p=105&cid='.$center->id) }}"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
        </div>
        <div class="PlanFt4">
            <div class="PlanFtsHeight">
                <div class="RPBtop2">BACK <span class="melon bold">⟨</span></div><!--/RPBtop-->
                <div class="PlanFtName">
                    <div class="RPBleft2 bold">Platinum Plus<br>with Live Receptionist</div>
                    @if(isset($center->packages_arr['Platinum Plus']))
                        <div class="RPBright2"><span class="lineTrough smallText">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum Plus']->with_live_receptionist_full_price*session('rate'), 2) }}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum Plus']->with_live_receptionist_pack_price*session('rate'), 2)}}</span><span class="smallText">/MONTH</span></span></div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
                <div class="planFts">
                    <div class="planFtsLine"><div class="planListR bold"><div class="includedIcon"></div>EVERYTHING IN PLATINUM WITH LIVE RECEPTIONIST</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="plusIcon"></div>PLUS</div></div><!--/planFtsLine-->
                    <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>16 Hours of Meeting Room or Private Office Time</div></div><!--/planFtsLine-->
                </div><!--/planFts-->
            </div><!--/PlanFtsHeight-->
            <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids/{!! $center->id !!}"><div class="PlanFtsbtnL">COMPARE</div></a><a href="{{ url('/customize-mail?p=105&b=402&cid='.$center->id) }}"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
        </div>

        <div class="RplansBox">
            <div class="RPBtop">CLOSE <span class="melon">X</span></div>
            <div class="RPBplan1"><div class="RPBplan1T"><div class="planNum">1</div></div>
                <div class="RPBinfoPlan"><div class="RPBleft lh1">Platinum</div>
                    @if(isset($center->packages_arr['Platinum']) && $center->packages_arr['Platinum']->price != 0)
                        <div class="RPBright lh1">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum']->price*session('rate'), 2)}}<span class="smallText">/MONTH</span>
                        </div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
            </div>
            <div class="RPBplan2"><div class="RPBplan2T"><div class="planNum">2</div><div class="tleft">BEST DEAL</div><div class="tright">You save $10 a month</div></div>
                <div class="RPBinfoPlan2"><div class="RPBleft2 bold">Platinum<br>with Live Receptionist</div>
                    @if(isset($center->packages_arr['Platinum']) && $center->packages_arr['Platinum']->price != 0)
                        <div class="RPBright2"><span class="lineTrough smallText">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum']->with_live_receptionist_full_price*session('rate'), 2)}}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum']->with_live_receptionist_pack_price*session('rate'), 2)}}</span><span class="smallText">/MONTH</span></span></div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
            </div>
            <div class="RPBplan3"><div class="RPBplan1T topShadow"><div class="planNum">3</div></div>
                <div class="RPBinfoPlan"><div class="RPBleft lh1">Platinum Plus</div>
                    @if(isset($center->packages_arr['Platinum Plus']))
                        <div class="RPBright lh1">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum Plus']->price*session('rate'), 2) }} <span class="smallText">/MONTH</span></div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
            </div>
            <div class="RPBplan4"><div class="RPBplan1T"><div class="planNum">4</div><div class="tleft">GREAT DEAL</div><div class="tright">You save $10 a month</div></div>
                <div class="RPBinfoPlan2"><div class="RPBleft2 bold">Platinum Plus<br>with Live Receptionist</div>
                    @if(isset($center->packages_arr['Platinum Plus']))
                        <div class="RPBright2"><span class="lineTrough smallText">{!! session('currency.symbol') !!} {{ round($center->packages_arr['Platinum Plus']->with_live_receptionist_full_price*session('rate'), 2) }}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">{!! session('currency.symbol') !!} {{ round( $center->packages_arr['Platinum Plus']->with_live_receptionist_pack_price*session('rate'), 2) }}</span><span class="smallText">/MONTH</span></span></div>
                    @else
                        <span>Not Available</span>
                    @endif
                </div>
            </div>

            <div class="setUpFee">One time only - {!! session('currency.symbol') !!}100 Set up fee for any plan.</div><!--/setUpFee-->
            <div class="featuresCompare"><a class="popup-with-form compareBtnLink" href="/pricing-grids/{!! $center->id !!}"><div class="compareBtn">SEE FEATURES AND COMPARE ALL</div></a></div><!--/featuresCompare-->
        </div>

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
            @forelse($center->vo_photos as $photo)
                <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/{!! $photo->path !!}' alt="{!! $photo->alt !!}" /></div></li>
            @empty
                <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/no_pic.gif' alt=''></div></li>
            @endforelse
            </ul>
        </div>
        <div class='ResultBtns'>
        	<a class='seePlansBtnR' href='#'>
        		<div class='btnPlans'>SEE PLANS</div>
        	</a>
            <a href="{!! URL::action('VirtualOfficesController@getVirtualOfficeShowPage', ['country_code' => $center->country, 'city_slug' => $center->city? $center->city->slug : '', 'center_slug' => $center->slug, 'center_id' => $center->id])!!}" class='moreInfoBtnR'>
                <div class='btnMoreInfo'>MORE INFORMATION</div>
            </a>
        </div>
        <div class='CenterPrice gray1'> 
            @if($center->virtual_office_lowest_price && $center->virtual_office_lowest_price->min_price)
                <span class="starting gray3">STARTING AT:</span> <span class="signo">{!! session('currency.symbol') !!}</span><span class="ammount">{!! round($center->virtual_office_lowest_price->min_price*session('rate'), 2) !!}</span>
                <span class="usd">{!! session('currency.name') !!}</span>
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
                <span class='rcAddress gray3'>{!! $center->address1 !!} {!! $center->address2 !!}, {!!$center->city_name!!}, {!!$center->us_state!!} {!! $center->postal_code !!}</span><br>
            	<a href="{!! URL::action('MeetingRoomsController@getMeetingRoomShowPage', ['country_code' => $center->country, 'city_slug' => $center->city? $center->city->slug : '', 'center_slug' => $center->slug, 'center_id' => $center->id])!!}" class="gray3 mediumBold">
                    Try a {!! $center->name !!} Meeting Room
                </a>
            </p>
        </div>
    </div>
</div>