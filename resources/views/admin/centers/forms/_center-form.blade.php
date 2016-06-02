@if(isset($center))
    {!! Form::model($center,array('url' => '/centers/'.$center->id, 'method' => 'PUT', 'role' => 'form','files' => true)) !!}
@else
{!! Form::open(['method' => 'post' , 'url' => '/centers','files' => true]) !!}
@endif
<div class="w_box" style="width:100%">
    <div class="ga_right">
        <span class="lh_f">Sites:</span>&nbsp;
        {!! Form::select('sites',$sites, null, [ 'class' => 'change', 'multiple' => true]) !!}
        <!-- <select class="change" multiple>             
            <option value="1">AVO</option>
            <option value="2">ABCN</option>
            <option value="3">ALL WORK</option>
            <option value="3">YOUR CITY OFFICE</option>
            <option value="3">SAME DAY VIRTUAL</option>
            <option value="4">FLEXADO</option>
        </select> -->
    </div>
    <div class="ga_right lh_f">
    Services:
        <div class="services_wrapp">
            <input type="checkbox" name="services" value="VO" id="1" checked="">
            <label for="1">         
            </label> 
            VO &nbsp; &nbsp;
                <input type="checkbox" name="services" value="MR" id="2" checked="">
                <label for="2">
                    
                </label> 
            MR &nbsp; &nbsp;
                <input type="checkbox" name="services" value="LR" id="3" checked="">
                <label for="3"></label> 
            LR
        </div>
    </div> 
    <div class="clear"></div>
</div>

    <!-- @foreach($photos as $photo_id => $photo)
        
    @endforeach -->

<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S BASIC INFORMATION</h2>
    </div>
</div>
<div class="w_box" style="width:100%">
    <div class="form_left centers_basic">
        {!! Form::label('building_name','Building Name:') !!}
        {!! Form::text('building_name', isset($center->building_name) ? $center->building_name : null,['class' => 'f1'])!!}       
        <br>
        {!! Form::label('name','Name:') !!}
        {!! Form::text('name', isset($center->name) ? $center->name : null,['class' => 'f1'])!!}       
        <br>
        {!! Form::label('address1','*Address 1:') !!}
        {!! Form::text('address1', isset($center->address1) ? $center->address : null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('subhead','Subheader') !!}
        {!! Form::text('subhead',isset($center->virtual_office_seo->subhead) ? $center->virtual_office_seo->subhead : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('sentence1','sentence1') !!}
        {!! Form::text('sentence1',isset($center->virtual_office_seo->sentence1) ? $center->virtual_office_seo->sentence1 : null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('sentence2','sentence2  ' ) !!}
        {!! Form::text('sentence2',isset($center->virtual_office_seo->sentence2) ? $center->virtual_office_seo->sentence2 : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('sentence3','sentence3') !!}
        {!! Form::text('sentence3',isset($center->virtual_office_seo->sentence3) ? $center->virtual_office_seo->sentence3 : null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('meta_title','Meta Title') !!}
        {!! Form::text('meta_title',isset($center->virtual_office_seo->meta_title) ? $center->virtual_office_seo->meta_title : null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('meta_keywords','Meta Keywords') !!}
        {!! Form::text('meta_keywords',isset($center->virtual_office_seo->meta_keywords) ? $center->virtual_office_seo->meta_keywords : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('h1','Headline') !!}
        {!! Form::text('h1', isset($center->virtual_office_seo->h1) ? $center->virtual_office_seo->h1 : null ,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('h2','Sub Headline') !!}
        {!! Form::text('h2',isset($center->virtual_office_seo->h2) ? $center->virtual_office_seo->h2 : null,['class' => 'f1']) !!} 
        <br>
        {!! Form::label('h3','Headline 2') !!} 
        {!! Form::text('h3',isset($center->virtual_office_seo->h3) ? $center->virtual_office_seo->h3 : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('seo_footer','Seo Footer') !!}
        {!! Form::text('seo_footer',isset($center->virtual_office_seo->seo_footer) ? $center->virtual_office_seo->seo_footer : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('meta_description','Meta Description') !!}
        {!! Form::text('meta_description',isset($center->virtual_office_seo->meta_description) ? $center->virtual_office_seo->meta_description : null,['class' => 'f1']) !!}
    </div>              
    <div class="form_right centers_basic">
        <br>
        {!! Form::label('avo_description','Avo Description') !!}
        {!! Form::text('avo_description',isset($center->virtual_office_seo->avo_description) ? $center->virtual_office_seo->avo_description : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('abcn_title','Abcn Title') !!}
        {!! Form::text('abcn_title',isset($center->virtual_office_seo->abcn_title) ? $center->virtual_office_seo->abcn_title : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('abcn_description','Abcn Description') !!}
        {!! Form::text('abcn_description',isset($center->virtual_office_seo->abcn_description) ? $center->virtual_office_seo->abcn_description : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('price','price') !!} 
        {!! Form::text('price', isset($center_package['platinum']) ? $center_package['platinum']->price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('with_live_receptionist_full_price','Live Receptionist Full Price') !!}
        {!! Form::text('with_live_receptionist_full_price', isset($center_package['platinum']) ? $center_package['platinum']->with_live_receptionist_full_price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('with_live_receptionist_pak_price','Live Receptionist  Price') !!}
        {!! Form::text('with_live_receptionist_pak_price',  isset($center_package['platinum']) ? $center_package['platinum']->with_live_receptionist_pack_price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('city_name','*City:') !!}
        {!! Form::text('city_name', null,['class' => 'f1', 'id' => 'city'])!!}
        <br>
        {!! Form::label('countries','*Country:&nbsp;') !!}
        {!! Form::select('countries',$countries, null, [ 'class' => 'country']) !!}
        <br>
        {!! Form::label('states','State:&nbsp;') !!}
        {!! Form::select('states',$states,null,['class' => 'state']) !!}
        <br>
        {!! Form::label('lat','*Address Latitude: ') !!}
        {!! Form::text('lat', isset($center_coordinates->lat) ? $center_coordinates->lat : null,['class' => 'f1b'])!!}
        <a  class="getBtn" onclick="getLatAndLng()">GET</a>
        <div class="clear"></div>
        {!! Form::label('lng','*Address Longitude: ') !!}
        {!! Form::text('lng', isset($center_coordinates->lng) ? $center_coordinates->lng : null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('package','Package') !!}
        {!! Form::select('package',$packages ,null,['class' => 'platinum_package']) !!}
        <br>
        @if(isset($center))
        {!! Form::label('Make this center active or inactive') !!}
        {!! Form::checkbox('active',$center->center_filter->virtual_office,$center->center_filter->virtual_office ==1 ? true : null,['id' => 'center_active_checkbox']) !!}
        @endif
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>
</div>

<div class="h2wrapp mtop1 hide center_photos">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S PHOTOS</h2>
    </div>
</div>
<div class="w_box centerPics hide center_photos" style="width:100%">
    @for($i = 1; $i <= 6; $i++)
        <div class="photoLine">
            <div class="photoLineD">
                {!! Form::label('Photo','Photo '.$i.':',['class' => 'plb lh_f']) !!}
                <div class="plb2 lh_f">
                    {!! Form::file(isset($photos[$i]->id) ? 'image'.$i.'_'.$photos[$i]->id :'image'.$i, []) !!}
                    @if(isset($photos[$i]) && $photos[$i] != '')
                        {!! Form::hidden('photo_number'.$i.'', $photos[$i]->id, []) !!}
                        <img src="/mr-photos/{!! $photos[$i]->path !!}" width="70px">
                    @endif
                </div>
            </div>
            <div class="photoLineD">
                <div class="plb lh_f">Category:&nbsp;</div> 
                <div class="plb2">
                    <div class="g_select2">
                        {!! Form::select('category'.$i.'',$selectArray,null,['class' => 'rule_d'.$i. ' f1_s']) !!}
                    </div> 
                </div> 
                <div class="plb3 lh_f">&nbsp; 
                    <a class="txtLink2{{$i}} customSEO">(Custom SEO)</a>

                </div> 
            </div>
        </div>
        <div class = "show_custom_seo hide" id = "hide{{$i}}">
            {!! Form::label('Photo 2 AVO Alt: ') !!}
            {!! Form::text(isset($photos[$i]->id) ? 'photo_2_alt_'.$i.'_'.$photos[$i]->id :'photo_2_alt_'.$i, isset($photos[$i]['alt']) ? $photos[$i]['alt'] : null,['class' => 'f1', 'id' => 'photo_2_avo_alt'.$i])!!}
            <br>
            <br>
            {!! Form::label('Photo 2 AVO Caption: ') !!}
            {!! Form::text( isset($photos[$i]->id) ? 'photo_2_caption_'.$i.'_'.$photos[$i]->id :'photo_2_caption_'.$i,  isset($photos[$i]['alt']) ? $photos[$i]['caption'] : null,['class' => 'f1', 'id' => 'photo_2_avo_caption'.$i])!!}
            <br>
            <br>
            {!! Form::label('Photo 2 ABCN Alt: ') !!}
            {!! Form::text('photo_2_abcn_alt'.$i, null,['class' => 'f1'])!!}
            <br>
            <br>
            {!! Form::label('Photo 2 ABCN Caption: ') !!}
            {!! Form::text('photo_2_abcn_caption'.$i, null,['class' => 'f1'])!!}
        </div>
        <hr>
    @endfor
    
    
    <!--   -->
    <div class="clear"></div>
</div>
<!-- <div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>LOCATION AND AMENITIES</h2>
    </div>
</div>  
<div class="w_box centers_basic">
    <div class="adjustTxta">Location&nbsp; Description:&nbsp;</div>
    <textarea class="f1_ta"></textarea><br>
    <div class="form_left">
        <div class="adjustTxt">Amenities&nbsp; Description: <br>
            <span class="mediumBold">ABCN</span>:&nbsp;
        </div>
        <textarea class="f1_t"></textarea>
    </div> 
    <div class="form_right">
        <div class="adjustTxt">Amenities&nbsp; Description <br>
            <span class="mediumBold">AVO</span>:&nbsp;
        </div> 
        <textarea class="f1_t"></textarea>
    </div> 
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>FEATURES</h2>
    </div>
</div> -->
<!-- <div class="w_box oneMoreF">
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>

    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>
    <div class="featuresBox">
        <input type="text" class="f1c">
    </div>

    <div class="clear"></div>
</div>
<div class="add_box">
    <a id="oneMoreFeature" class="gLink">
        <div class="txtLink">ADD ANOTHER FEATURE</div>
        <div class="gIcon gAdd"></div>
    </a>
    <div class="clear"></div>
</div> -->
<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S MEETING ROOM'S INFORMATION</h2>
    </div>
</div>
<div class="w_box centerPics" style="width:100%">
    <div class="form_left centers_basic">
        {!! Form::label('mr_sentence1','sentence1') !!}
        {!! Form::text('mr_sentence1', isset($center->meeting_room_seo->sentence1) ? $center->meeting_room_seo->sentence1 : null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('mr_sentence2','sentence2') !!}
        {!! Form::text('mr_sentence2', isset($center->meeting_room_seo->sentence2) ? $center->meeting_room_seo->sentence2 : null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('mr_sentence3','sentence3') !!}
        {!! Form::text('mr_sentence3', isset($center->meeting_room_seo->sentence3) ? $center->meeting_room_seo->sentence3 : null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('mr_avo_description','Avo Description') !!}
        {!! Form::text('mr_avo_description',isset($center->meeting_room_seo->avo_description) ? $center->meeting_room_seo->avo_description : null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('mr_meta_title','Meta Title') !!}
        {!! Form::text('mr_meta_title',isset($center->meeting_room_seo->meta_title) ? $center->meeting_room_seo->meta_title : null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('mr_meta_keywords','Meta Keywords') !!}
        {!! Form::text('mr_meta_keywords',isset($center->meeting_room_seo->meta_keywords) ? $center->meeting_room_seo->meta_keywords : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('mr_meta_description','Meta Description') !!}
        {!! Form::text('mr_meta_description',isset($center->meeting_room_seo->meta_description) ? $center->meeting_room_seo->meta_description : null,['class' => 'f1']) !!}
       <!--  <br>
        {!! Form::label('floor','*Floor / Suite #:') !!}
        {!! Form::text('floor', null,['class' => 'f1'])!!}    -->
    </div>          
    <div class="form_right centers_basic">
        {!! Form::label('mr_h1','Headline') !!}
        {!! Form::text('mr_h1', isset($center->meeting_room_seo->h1) ? $center->meeting_room_seo->h1 : null ,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('mr_h2','Sub Headline') !!}
        {!! Form::text('mr_h2',isset($center->meeting_room_seo->h2) ? $center->meeting_room_seo->h2 : null,['class' => 'f1']) !!} 
        <br>
        {!! Form::label('mr_h3','Headline 2') !!} 
        {!! Form::text('mr_h3',isset($center->meeting_room_seo->h3) ? $center->meeting_room_seo->h3 : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('mr_seo_footer','Seo Footer') !!}
        {!! Form::text('mr_seo_footer',isset($center->meeting_room_seo->seo_footer) ? $center->meeting_room_seo->seo_footer : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('mr_abcn_title','Abcn Title') !!}
        {!! Form::text('mr_abcn_title',isset($center->meeting_room_seo->abcn_title) ? $center->meeting_room_seo->abcn_title : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('mr_abcn_description','Abcn Description') !!}
        {!! Form::text('mr_abcn_description',isset($center->meeting_room_seo->abcn_description) ? $center->meeting_room_seo->abcn_description : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('mr_subhead','Subheader') !!}
        {!! Form::text('mr_subhead',isset($center->meeting_room_seo->subhead) ? $center->meeting_room_seo->subhead : null,['class' => 'f1']) !!}
        <br>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1">
    <div class="h2txt">
        <input type="checkbox" class="show_plp_package"> PLATINUM PLUS PACKAGE
    </div>
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1 pl_plus hide">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>PLATINUM PLUS PACKAGE INFORMATION</h2>
    </div>
</div>
<div class="w_box centerPics pl_plus_form hide" style="">
    <div class="centers_basic">
       {!! Form::label('Package') !!}
       {!! Form::select('plus_package',$plus_packages, 'null',['class' => 'plus_packages']) !!}
       <br>
       {!! Form::label('plus_price','Price') !!} 
       {!! Form::text('plus_price',isset($center_package['platinum_plus']) ? $center_package['platinum_plus']->price : null,['class' => 'f1']) !!}
       <br>
       {!! Form::label('plus_with_live_receptionist_full_price','Live Receptionist Full Price') !!}
       {!! Form::text('plus_with_live_receptionist_full_price',isset($center_package['platinum_plus'] )  ? $center_package['platinum_plus']->with_live_receptionist_full_price : null,['class' => 'f1']) !!}
       <br>
       {!! Form::label('plus_with_live_receptionist_pak_price','Live Receptionist Price') !!}
       {!! Form::text('plus_with_live_receptionist_pak_price',isset($center_package['platinum_plus']) ? $center_package['platinum_plus']->with_live_receptionist_pack_price : null,['class' => 'f1']) !!}
       <br>
    </div>          
    
    <div class="clear"></div>
</div>


   
<div class="submit_w">
    {!! Form::submit('Submit', array('class'=>'submit_btn')) !!}
</div>

 {!! Form::close() !!}

