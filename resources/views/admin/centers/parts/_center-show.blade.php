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
    </div>
    <div class="form_right">
    	 
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
    
    <div class="bBox_btns">
        <div class="add_CBtn bordL"><a href="{{ url('center/'.$center->id.'/meeting-room/create') }}" class="gLink"><div class="sBox_icons add_green"></div>Add Meeting Room</a></div>
        <div class="edit_oBtn bordL"><a href="{{ url('centers/'.$center->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>Center</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>