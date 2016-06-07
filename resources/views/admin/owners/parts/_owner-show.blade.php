<div class="w_box view_box">
    <div class="form_left">
        <div class="line">
            <span class="lh_fi mediumBold">Company Name:</span>&nbsp;
            <div class="formOinfo">{{ $owner->company_name }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Name:</span>&nbsp;
            <div class="formOinfo">{{ $owner->name }}</div>
        </div> 
        {{-- <div class="line">
            <span class="lh_fi mediumBold">Last Name:</span>&nbsp;
            <div class="formOinfo">Dugan</div>
        </div>  --}}
        <div class="line">
            <span class="lh_fi mediumBold">Phone:</span>&nbsp;
            <div class="formOinfo">{{ $owner->phone }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Fax:</span>&nbsp;
            <div class="formOinfo">{{ $owner->fax }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Web Site:</span>&nbsp;
            <div class="formOinfo"><a href="{{ $owner->url }}">{{ $owner->url }}</a></div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Email:</span>&nbsp;
            <div class="formOinfo">{{ $owner->email }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Member Type:</span>&nbsp;
            <div class="formOinfo">Preferred Member</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Active Sites:</span>&nbsp;
            <div class="formOinfo">ABCN, AVO, OT, FLEXADO</div>
        </div> 
    </div> 
    <div class="form_right">
        <div class="line">
            <span class="lh_fi mediumBold">Billing Address 1:</span>&nbsp;
            <div class="formOinfo">{{ $owner->address1 }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Billing Address 2:</span>&nbsp;
            <div class="formOinfo">{{ $owner->address2 }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">City:</span>&nbsp;
            <div class="formOinfo">{{ isset($owner->city) ? $owner->city->name : null }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">County / Region:</span>&nbsp;
            <div class="formOinfo">{{ $owner->region }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">State:</span>&nbsp;
            <div class="formOinfo">{{ isset($owner->us_state) ? $owner->us_state->name : null }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Country:</span>&nbsp;
            <div class="formOinfo">{{ isset($owner->country) ? $owner->country->name : null }}</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Active Rules:</span>&nbsp;
            <div class="formOinfo">Yes</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Notes:</span>&nbsp;
            <div class="formOinfo">Here the notes...</div>
        </div> 
    </div> 
    <div class="bBox_btns">
        <div class="add_CBtn bordL"><a href="{{ url('centers/create') }}" class="gLink"><div class="sBox_icons add_green"></div>Add Center</a></div>
        <div class="edit_oBtn bordL"><a href="{{ url('owners/'.$owner->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>Edit Owner</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>