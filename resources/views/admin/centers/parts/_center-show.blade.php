<div class="w_box view_box">
    <div class="form_left">
        <div class="line">
            <span class="lh_fi mediumBold">Center Name:</span>&nbsp;
            <div class="formOinfo">{{ $center->name }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">City name:</span>&nbsp;
            <div class="formOinfo">{{ $center->city_name }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Country:</span>&nbsp;
            <div class="formOinfo">{{ $center->country }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">US state:</span>&nbsp;
            <div class="formOinfo">{{ $center->us_state }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Company name:</span>&nbsp;
            <div class="formOinfo">{{ $center->company_name }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Building Name:</span>&nbsp;
            <div class="formOinfo">{{ $center->building_name }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Postal Code:</span>&nbsp;
            <div class="formOinfo">{{ $center->postal_code }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Locations:</span>&nbsp;
            <div class="formOinfo">{{ $center->location }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Address 1:</span>&nbsp;
            <div class="formOinfo">{{ $center->address1 }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Address 2:</span>&nbsp;
            <div class="formOinfo">{{ $center->address2 }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Postal Code:</span>&nbsp;
            <div class="formOinfo">{{ $center->postal_code }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Summary:</span>&nbsp;
            <div class="formOinfo">{{ $center->summary }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Notes:</span>&nbsp;
            <div class="formOinfo">{{ $center->notes }}</div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Amenities:</span>&nbsp;
            <div class="formOinfo">{{ $center->amenities }}</div>
        </div>
    </div>
    <div class="form_right">
    	 <div class="line">
             <span class="lh_fi mediumBold">Center Owner:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->name) ? $center->owner->name : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Company Name:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->company_name) ? $center->owner->company_name : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Owners Phone:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->phone) ? $center->owner->phone : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Owners Fax:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->fax) ? $center->owner->fax : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Owners Email:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->email) ? $center->owner->email : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Website:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->url) ? $center->owner->url : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Billing Address 1:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->address1) ? $center->owner->address1 : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Billing Address 2:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->address2) ? $center->owner->address2 : '' }}
             </div>
         </div>
         <div class="line">
             <span class="lh_fi mediumBold">Region/County:</span>&nbsp;
             <div class="formOinfo">
                 {{ isset($center->owner->region) ? $center->owner->region : '' }}
             </div>
         </div>
         <div class="line">
            <span class="lh_fi mediumBold">Country:</span>&nbsp;
            <div class="formOinfo">
                {{ isset($center->owner->country) ? $center->owner->country : '' }}
            </div>
         </div>
         <div class="line">
            <span class="lh_fi mediumBold">Center Prices:</span>&nbsp;
            <div class="formOinfo">
                @if(isset($center))
                    @foreach($center->prices as $price)
                        @if( $price->package_id == 103 )
                            Platinium Package` <a href="{{url('centers/'.$center->id.'/edit')}}" class="gLink">{{$price->price}}$</a><br>
                        @elseif( $price->package_id == 105 )
                            Platinium Plus Package` <a href="{{url('centers/'.$center->id.'/edit')}}" class="gLink">{{$price->price}}$</a><br>
                        @endif
                    @endforeach
                @endif
            </div>
         </div>
         <div class="line">
            <span class="lh_fi mediumBold">Meeting Roooms:</span>&nbsp;
            <div class="formOinfo">
                @if(isset($center))
                    @foreach($center->meeting_rooms as $mr)
                        <a href="{{url('meeting-rooms/'.$mr->id.'/edit')}}" class="gLink">{{$mr->name}}</a> - {{$mr->hourly_rate}}$<br><br>
                    @endforeach
                @endif
            </div>
         </div>    
    </div> 
    
    <div class="bBox_btns">
        <div class="add_CBtn bordL"><a href="{{ url('center/'.$center->id.'/meeting-room/create') }}" class="gLink"><div class="sBox_icons add_green"></div>Add Meeting Room</a></div>
        <div class="add_CBtn bordL"><a href="{{ url('centers/'.$center->id.'/edit') }}" class="gLink"><div class="sBox_icons add_green"></div>Edit Center</a></div>
        @if(!$center->owner)
            <div class="edit_oBtn bordL"><a href="{{ url('center/'.$center->id.'/owner/create') }}" class="gLink"><div class="sBox_icons edit_green"></div>Add Owner</a></div>
        @else
           <div class="edit_oBtn bordL"><a href="{{ url('owners/'.$center->owner->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>Edit Owner</a></div>
        @endif
    </div> 
    <div class="clear"></div>
</div>
</div>
