<div class='TheResult'>
    <div class="wrapRboxes">
    <!-- Detail click state -->
            <!-- Platinum plan -->
                <div class="PlanFt1">
                <div class="PlanFtsHeight">
                    <div class="RPBtop2">BACK <span class="melon bold">⟨</span> &nbsp; &nbsp;</div><!--/RPBtop2-->
                    <div class="PlanFtName">
                        <div class="RPBleft bold lh1">Platinum</div>
                        @if(isset($center->packages_arr['Platinum']))
                            <div class="RPBright lh1">$ {{$center->packages_arr['Platinum']->price}}<span class="smallText">/MONTH</span>
                            </div>
                        @else
                        <span>Not Available</span>
                        @endif
                    </div><!--/PlanFtName-->
                    <div class="planFts">
                        <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Business Address</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Mail Receipt</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Mail Forwarding*</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>Personal Mail Box</div></div><!--/planFtsLine-->
                        <div class="planFtsLine EFline">*Extra fees may apply</div>
                    </div><!--/planFts-->
                </div><!--/PlanFtsHeight-->
                    <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids.php?id=$center_ID"><div class="PlanFtsbtnL">COMPARE</div></a><a href="' . $next_URL . '?n=1&p=103&cid=' . $center_ID . '"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
                </div><!--/PlanFt1-->
        
            <!-- Platinum with LR plan -->
                <div class="PlanFt2">
                <div class="PlanFtsHeight">
                    <div class="RPBtop2">BACK <span class="melon bold">⟨</span> &nbsp; &nbsp;</div><!--/RPBtop-->
                    <div class="PlanFtName">
                        <div class="RPBleft2 bold">Platinum<br>with Live Receptionist</div>
                        @if(isset($center->packages_arr['Platinum']))
                            <div class="RPBright2"><span class="lineTrough smallText">$ {{$center->packages_arr['Platinum']->with_live_receptionist_full_price}}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">$ {{$center->packages_arr['Platinum']->with_live_receptionist_pack_price}}</span><span class="smallText">/MONTH</span></span></div>
                        @else
                            <span>Not Available</span>
                        @endif
                        </div>
                    <div class="planFts">
                        <div class="planFtsLine"><div class="planListR bold"><div class="includedIcon"></div>EVERYTHING IN PLATINUM</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="plusIcon"></div>PLUS</div></div><!--/planFtsLine-->
                $platinum_with_included
                    </div><!--/planFts-->
                </div><!--/PlanFtsHeight-->
                    <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids.php?id=$center_ID"><div class="PlanFtsbtnL">COMPARE</div></a><a href="' . $next_URL . '?n=1&p=103&cid=' . $center_ID . '"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
                </div><!--/PlanFt2-->
        
            <!-- Platinum Plus plan -->
                <div class="PlanFt3">
                <div class="PlanFtsHeight">
                    <div class="RPBtop2">BACK <span class="melon bold">⟨</span> &nbsp; &nbsp;</div><!--/RPBtop-->
                    <div class="PlanFtName">
                        <div class="RPBleft bold lh1">Platinum Plus</div>
                        @if(isset($center->packages_arr['Platinum Plus']))
                            <div class="RPBright lh1">$ {{$center->packages_arr['Platinum Plus']->price}} <span class="smallText">/MONTH</span></div>
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
                    <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids.php?id=$center_ID"><div class="PlanFtsbtnL">COMPARE</div></a><a href="' . $next_URL . '?n=1&p=103&cid=' . $center_ID . '"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
                </div><!--/PlanFt3-->
        
            <!-- Platinum Plus with LR plan -->
                <div class="PlanFt4">
                <div class="PlanFtsHeight">
                    <div class="RPBtop2">BACK <span class="melon bold">⟨</span> &nbsp; &nbsp;</div><!--/RPBtop-->
                    <div class="PlanFtName"><div class="RPBleft2 bold">Platinum Plus<br>with Live Receptionist</div>$center_platinum_plus_with_price_disp</div>
                    <div class="planFts">
                        <div class="planFtsLine"><div class="planListR bold"><div class="includedIcon"></div>EVERYTHING IN PLATINUM WITH LIVE RECEPTIONIST</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="plusIcon"></div>PLUS</div></div><!--/planFtsLine-->
                        <div class="planFtsLine"><div class="planListR"><div class="includedIcon"></div>16 Hours of Meeting Room or Private Office Time</div></div><!--/planFtsLine-->
                    </div><!--/planFts-->
                 </div><!--/PlanFtsHeight-->
                    <div class="PlanFtsBtns"><a class="popup-with-form" href="/pricing-grids.php?id=$center_ID"><div class="PlanFtsbtnL">COMPARE</div></a><a href="' . $next_URL . '?n=1&p=103&cid=' . $center_ID . '"><div class="PlanFtsbtnR">SELECT</div></a></div><!--/PlanFtsBtns-->
                </div><!--/PlanFt4-->
    <!-- Platinum plan -->
        <div class="RplansBox">
        <div class="RPBtop">CLOSE <span class="melon">X</span> &nbsp; &nbsp;</div><!--/RPBtop-->
        <div class="RPBplan1"><div class="RPBplan1T"><div class="planNum">1</div></div>
        <div class="RPBinfoPlan"><div class="RPBleft lh1">Platinum</div>
        @if(isset($center->packages_arr['Platinum']))
            <div class="RPBright lh1">$ {{$center->packages_arr['Platinum']->price}}<span class="smallText">/MONTH</span>
            </div>
        @else
        <span>Not Available</span>
        @endif
        </div><!--/RPBinfoPlan-->
        </div><!--/RPBplan1-->
    
    <!-- Platinum with LR plan -->
        <div class="RPBplan2"><div class="RPBplan2T"><div class="planNum">2</div><div class="tleft">BEST DEAL</div><div class="tright">You save $10 a month</div></div>
        <div class="RPBinfoPlan2"><div class="RPBleft2 bold">Platinum<br>with Live Receptionist</div>
        @if(isset($center->packages_arr['Platinum']))
            <div class="RPBright2"><span class="lineTrough smallText">$ {{$center->packages_arr['Platinum']->with_live_receptionist_full_price}}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">$ {{$center->packages_arr['Platinum']->with_live_receptionist_pack_price}}</span><span class="smallText">/MONTH</span></span></div>
        @else
            <span>Not Available</span>
        @endif
        </div><!--/RPBinfoPlan2-->
        </div><!--/RPBplan2-->
    
    <!-- Platinum Plus plan -->
        <div class="RPBplan3"><div class="RPBplan1T topShadow"><div class="planNum">3</div></div>
        <div class="RPBinfoPlan"><div class="RPBleft lh1">Platinum Plus</div>
        @if(isset($center->packages_arr['Platinum Plus']))
            <div class="RPBright lh1">$ {{$center->packages_arr['Platinum Plus']->price}} <span class="smallText">/MONTH</span></div>
        @else
            <span>Not Available</span>
        @endif
        </div><!--/RPBinfoPlan-->
        </div><!--/RPBplan3-->
    
    <!-- Platinum plus with LR plan -->
        <div class="RPBplan4"><div class="RPBplan1T"><div class="planNum">4</div><div class="tleft">GREAT DEAL</div><div class="tright">You save $10 a month</div></div>
        <div class="RPBinfoPlan2"><div class="RPBleft2 bold">Platinum Plus<br>with Live Receptionist</div>
            @if(isset($center->packages_arr['Platinum Plus']))
                <div class="RPBright2"><span class="lineTrough smallText">$ {{$center->packages_arr['Platinum Plus']->with_live_receptionist_full_price}}<span class="smallText">/MONTH</span></span><br><span class="melon bold"><span class="bigPrice2">$ {{$center->packages_arr['Platinum Plus']->with_live_receptionist_pack_price}}</span><span class="smallText">/MONTH</span></span></div>
            @else
                <span>Not Available</span>
            @endif
        </div><!--/RPBinfoPlan-->
        </div><!--/RPBplan4-->
        
        <div class="setUpFee">One time only - $100 Set up fee for any plan.</div><!--/setUpFee-->
        <div class="featuresCompare"><a class="popup-with-form compareBtnLink" href="/pricing-grids.php?id=$center_ID"><div class="compareBtn">SEE FEATURES AND COMPARE ALL</div></a></div><!--/featuresCompare-->
        </div><!--/RplansBox-->

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
            @forelse($center->photos as $photo)
                <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/{!! $photo->path !!}' alt="{!! $photo->alt !!}" /></div></li>
            @empty
                <li><div class='img-wrapper'><img src='http://www.abcn.com/images/photos/no_pic.gif' alt=''></div></li>
            @endforelse
            </ul>
        </div>
        <div class='ResultBtns'>
        	<a class='popup-with-form seePlansBtnR' href='#'>
        		<div class='btnPlans'>SEE PLANS</div>
        	</a>
        	<a href="{!! URL::action('VirtualOfficesController@getVirtualOfficeShowPage', ['country_code' => $center->country, 'city_slug' => $center->city? $center->city->slug : '', 'center_slug' => $center->slug])!!}" class='moreInfoBtnR'>
        		<div class='btnMoreInfo'>MORE INFORMATION</div>
        	</a>
        </div>
        <div class='CenterPrice gray1'>
            @if($center->virtual_office_lowest_price && $center->virtual_office_lowest_price->min_price)
                <span class="starting gray3">STARTING AT:</span> <span class="signo">$</span><span class="ammount">{!! $center->virtual_office_lowest_price->min_price !!}</span>
                <span class="usd">USD</span>
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
</div>