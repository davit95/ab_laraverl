@include('alerts.messages')
<div class="w_box">
    <div class="ga_right">
        <span class="lh_f">Sites:</span>&nbsp;
        <select class="change" multiple>                
            <option value="1">AVO</option>
            <option value="2">ABCN</option>
            <option value="3">OT</option>
            <option value="4">Flexado</option>
        </select>
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
<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S PHOTOS</h2>
    </div>
</div>
<div class="w_box centerPics">
    {!! Form::open(['method' => 'post' , 'url' => '/centers']) !!}
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 1','Photo 1:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image1', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                <div class="g_select2">
                    {!! Form::select('select1',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 2','Photo 2:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image2', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                <div class="g_select2">
                    {!! Form::select('select2',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 3','Photo 3:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image3', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                <div class="g_select2">
                    {!! Form::select('select3',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 4','Photo 4:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image4', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                <div class="g_select2">
                    {!! Form::select('select4',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 5','Photo 5:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image5', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                <div class="g_select2">
                    {!! Form::select('select5',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    <div class="photoLine">
        <div class="photoLineD">
            {!! Form::label('Photo 6','Photo 6:',['class' => 'plb lh_f']) !!}
            <div class="plb2 lh_f">
                {!! Form::file('image6', null, []) !!}
            </div> 
        </div>
        <div class="photoLineD">
            <div class="plb lh_f">Category:&nbsp;</div> 
            <div class="plb2">
                    <div class="g_select2">
                    {!! Form::select('select6',$selectArray,null,['class' => 'rule_d f1_s']) !!}
                </div> 
            </div> 
            <div class="plb3 lh_f">&nbsp; 
                <a class="txtLink2 customSEO">(Custom SEO)</a>
            </div> 
        </div>
    </div>
    
    <!--   -->
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S BASIC INFORMATION</h2>
    </div>
</div>
<div class="w_box">
    <div class="form_left centers_basic">
        {!! Form::label('building_name','Building Name:') !!}
        {!! Form::text('building_name', null,['class' => 'f1'])!!}       
        <br>
        {!! Form::label('address1','*Address 1:') !!}
        {!! Form::text('address1', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('floor','*Floor / Suite #:') !!}
        {!! Form::text('floor', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('countries','*Country:&nbsp;') !!}
        {!! Form::select('countries',$countries,['class' => 'change']) !!}
        <br> 
        {!! Form::label('states','State:&nbsp;') !!}
        {!! Form::select('states',$states,['class' => 'change']) !!}   
    </div>              
    <div class="form_right centers_basic">
        {!! Form::label('city_name','*City:') !!}
        {!! Form::text('city_name', null,['class' => 'f1', 'id' => 'city'])!!}
        <br>
        {!! Form::label('country','County / Region:') !!}
        {!! Form::text('country', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('states','*Postal Code:') !!}
        {!! Form::text('postal_code', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('lat','*Address Latitude: ') !!}
        {!! Form::text('lat', null,['class' => 'f1b'])!!}
        <a  class="getBtn" onclick="getLatAndLng()">GET</a>
        <div class="clear"></div>
        {!! Form::label('lng','*Address Longitude: ') !!}
        {!! Form::text('lng', null,['class' => 'f1b'])!!}
        
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1">
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
</div>
<div class="w_box oneMoreF">
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
</div>

   
<div class="submit_w">
    {!! Form::submit('Submit', array('class'=>'submit_btn')) !!}
</div>
 {!! Form::close() !!}
<script type="text/javascript">
    $(document).on('ready', function(){
        $('.change').niceselect();
    })
</script>


<script type="text/javascript">
function getLatAndLng(){
    var state = $( "#states option:selected" ).text();
    var country = $( "#countries option:selected" ).text();
    var city = $('#city').val();
    var address = city + ' ' + state + ' ' + country;
    $.ajax({
      url: "http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
      type: "POST",
      success: function(res){
         $('#lat').val(res.results[0].geometry.location.lat);
         $('#lng').val(res.results[0].geometry.location.lng);
      }
    });
} 
    
</script>
