<div class="w_box view_box">
    <div class="form_left">
        <div class="line">
            <span class="lh_fi mediumBold">Center Name:</span>&nbsp;
            <div class="formOinfo">{{ $center->name }}</div>
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
            <span class="lh_fi mediumBold">Active Rules:</span>&nbsp;
            <div class="formOinfo">Yes</div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">Notes:</span>&nbsp;
            <div class="formOinfo">Here the notes...</div>
        </div> 
    </div> 
    
    <div class="bBox_btns">
        <div class="add_CBtn bordL"><a href="{{ url('center/'.$center->id.'/meeting-room/create') }}" class="gLink"><div class="sBox_icons add_green"></div>Add Meeting Room</a></div>
        <div class="edit_oBtn bordL"><a href="{{ url('centers/'.$center->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>Center</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>