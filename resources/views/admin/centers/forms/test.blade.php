<div class="content_wrapper">
            <div class="content_top">
                            </div>
            <div class="content_wrapp2">
                	<div class="row form-group">
		<form method="GET" action="http://admin.abcn.dev/owners" accept-charset="UTF-8">
	<div class="col-md-3">
		<input class="form-control" placeholder="Company or Owner's Name" id="company_or_owner_name" name="company_or_owner_name" type="text">
	</div>
	<button type="submit" class="pull-left btn btn-success"><i class="fa fa-search"></i></button>
</form>	</div>
    <form method="POST" action="http://admin.abcn.dev/owners/605" accept-charset="UTF-8"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="ODTXjZvBmxuyWwsrZT2j4tGOLWTxtftI3F3jyKN1">
	<input name="id" type="hidden" value="605">
	
	<div class="panel panel-default">
		<div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Company Name</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Company Name" name="company_name" type="text" value="hh"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Name</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Owner's Name" name="name" type="text" value="h"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Phone</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Owner's Phone" name="phone" type="text" value="555555"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Fax</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Fax" name="fax" type="text" value="5"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Website</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Website" name="url" type="text" value="hhh.hhh"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Owner's Email</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="email" type="email" value="hhh@hhh.hhh"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Postal Code</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="postal_code" type="text" value="555555"></div>
	    	</div>
	    </div>
	    <div class="panel-body col-md-6">
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Billing Address 1</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Billing Address 1" name="address1" type="text" value="5"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Billing Address 2</label></div>
	    		<div class="col-md-8"><input class="form-control" placeholder="Billing Address 2" name="address2" type="text" value="5"></div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>City</label></div>
	    		<div class="col-md-8">
	    			<input class="form-control ui-autocomplete-input" id="city" placeholder="City" name="city" type="text" value="Mobile" autocomplete="off">
	    			<!-- <input id="city_id" name="city_id" type="hidden" value="302"> -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>County / Region</label></div>
	    		<div class="col-md-8">
	    			<select class="form-control ui-autocomplete-input" id="region" placeholder="County / Region" name="region" autocomplete="off"><option value="">no region</option><option value="Australia">Australia</option><option value="USA" selected="selected">USA</option><option value="Europe">Europe</option><option value="Asia">Asia</option><option value="UK">UK</option><option value="Africa">Africa</option><option value="Middle East">Middle East</option><option value="South America">South America</option></select>
	    			<!-- <input id="region_id" name="region_id" type="hidden" value="2"> -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>State</label></div>
	    		<div class="col-md-8">
	    			<select class="form-control ui-autocomplete-input" id="us_state" placeholder="State" name="state" autocomplete="off"><option value="" selected="selected">no state</option></select>
	    			<!-- <input id="us_state_id" name="us_state_id" type="hidden" value="1"> -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Country</label></div>
	    		<div class="col-md-8">
	    			<select class="form-control ui-autocomplete-input" id="country" placeholder="Country" name="country" autocomplete="off"><option value="">no country</option></select>
	    			<!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
	    		</div>
	    	</div>
	    	<div class="row form-group">
	    		<div class="col-md-4 text-right"><label>Notes</label></div>
	    		<div class="col-md-8">
	    			<textarea class="form-control" id="country" placeholder="Notes..." name="notes" cols="50" rows="10">h</textarea>
	    			<!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
	    		</div>
	    	</div>
	    </div>
	    <div class="clearfix"></div>
	</div>
	<div class="row">
		<div class="col-md-12">
						<input class="btn btn-lg btn-success" type="submit" value="Submit">
			<a type="button" href="javascript:history.go(-1)" class="class' => 'btn btn-lg btn btn-info">Cancel</a>
			<!-- <input class="btn btn-lg btn btn-info" type="submit" value="Submit"> -->
		</div>
	</div>
</form>

            </div>
        </div>



        <!--  -->
        @include('alerts.messages')
<div class="w_box">
    <div class="ga_right">
        <span class="lh_f">Sites:</span>&nbsp;
        <select class="change" multiple>             
            <option value="1">AVO</option>
            <option value="2">ABCN</option>
            <option value="3">ALL WORK</option>
            <option value="3">YOUR CITY OFFICE</option>
            <option value="3">SAME DAY VIRTUAL</option>
            <option value="4">FLEXADO</option>
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
@if(isset($center))
    {!! Form::model($center,array('url' => '/centers/'.$center->id, 'method' => 'PUT', 'role' => 'form','files' => true)) !!}
@else
{!! Form::open(['method' => 'post' , 'url' => '/centers','files' => true]) !!}
@endif
    <!-- @foreach($photos as $photo_id => $photo)
        
    @endforeach -->

<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S BASIC INFORMATION</h2>
    </div>
</div>
<!-- <div class="w_box" style="width:100%">
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
        {!! Form::label('subhead','Subhead') !!}
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
        <br>
        @if(isset($center))
        {!! Form::label('Make this center active or inactive') !!}
        {!! Form::checkbox('active',null,['class' => 'f2']) !!}
        @endif
    </div>              
    <div class="form_right centers_basic">
        <br>
        {!! Form::label('avo_description','Avo Description') !!}
        {!! Form::text('avo_description',isset($center->virtual_office_seo->avo_description) ? $center->virtual_office_seo->avo_description : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('floor','*Floor / Suite #:') !!}
        {!! Form::text('floor', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('abcn_title','Abcn Title') !!}
        {!! Form::text('abcn_title',isset($center->virtual_office_seo->abcn_title) ? $center->virtual_office_seo->abcn_title : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('abcn_description','Abcn Description') !!}
        {!! Form::text('abcn_description',isset($center->virtual_office_seo->abcn_description) ? $center->virtual_office_seo->abcn_description : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('price','price') !!} 
        {!! Form::text('price',isset($prices->price) ? $prices->price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('with_live_receptionist_full_price','Live Receptionist Full Price') !!}
        {!! Form::text('with_live_receptionist_full_price',isset($prices->with_live_receptionist_full_price) ? $prices->with_live_receptionist_full_price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('with_live_receptionist_pak_price','Live Receptionist  Price') !!}
        {!! Form::text('with_live_receptionist_pak_price',isset($prices->with_live_receptionist_pack_price) ? $prices->with_live_receptionist_pack_price : null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('city_name','*City:') !!}
        {!! Form::text('city_name', isset($center->city_name) ? $center->city_name : null,['class' => 'f1', 'id' => 'city'])!!}
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
        {!! Form::text('package',null,['class' => 'f1']) !!}
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>
</div> -->
<!-- here -->
<div class="panel panel-default">
        <div class="panel-body col-md-6">
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Company Name</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Company Name" name="company_name" type="text" value="hh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Name</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Name" name="name" type="text" value="h"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Phone</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Phone" name="phone" type="text" value="555555"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Fax</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Fax" name="fax" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Website</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Website" name="url" type="text" value="hhh.hhh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Email</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="email" type="email" value="hhh@hhh.hhh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Postal Code</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="postal_code" type="text" value="555555"></div>
            </div>
        </div>
        <div class="panel-body col-md-6">
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Billing Address 1</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Billing Address 1" name="address1" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Billing Address 2</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Billing Address 2" name="address2" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>City</label></div>
                <div class="col-md-8">
                    <input class="form-control ui-autocomplete-input" id="city" placeholder="City" name="city" type="text" value="Mobile" autocomplete="off">
                    <!-- <input id="city_id" name="city_id" type="hidden" value="302"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>County / Region</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="region" placeholder="County / Region" name="region" autocomplete="off"><option value="">no region</option><option value="Australia">Australia</option><option value="USA" selected="selected">USA</option><option value="Europe">Europe</option><option value="Asia">Asia</option><option value="UK">UK</option><option value="Africa">Africa</option><option value="Middle East">Middle East</option><option value="South America">South America</option></select>
                    <!-- <input id="region_id" name="region_id" type="hidden" value="2"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>State</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="us_state" placeholder="State" name="state" autocomplete="off"><option value="" selected="selected">no state</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option></select>
                    <!-- <input id="us_state_id" name="us_state_id" type="hidden" value="1"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Country</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="country" placeholder="Country" name="country" autocomplete="off"><option value="">no country</option><option value="United States" selected="selected">United States</option><option value="Canada">Canada</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and/or Barbuda">Antigua and/or Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British lndian Ocean Territory">British lndian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecudaor">Ecudaor</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Ivory Coast">Ivory Coast</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfork Island">Norfork Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia South Sandwich Islands">South Georgia South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbarn and Jan Mayen Islands">Svalbarn and Jan Mayen Islands</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Republic Of China">Taiwan, Republic Of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States minor outlying islands">United States minor outlying islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City State">Vatican City State</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Virigan Islands (British)">Virigan Islands (British)</option><option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
                    <!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Notes</label></div>
                <div class="col-md-8">
                    <textarea class="form-control" id="country" placeholder="Notes..." name="notes" cols="50" rows="10">h</textarea>
                    <!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<!-- here -->

<div class="h2wrapp mtop1 hide center_photos">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>CENTER'S PHOTOS</h2>
    </div>
</div>
<div class="w_box centerPics hide center_photos">
    @for($i = 1; $i <= 6; $i++)
        <div class="photoLine">
            <div class="photoLineD">
                {!! Form::label('Photo','Photo '.$i.':',['class' => 'plb lh_f']) !!}
                <div class="plb2 lh_f">
                    {!! Form::file('image'.$i.'', null, []) !!}
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
            {!! Form::text('photo_2_alt'.$i, isset($photos[$i]['alt']) ? $photos[$i]['alt'] : null,['class' => 'f1', 'id' => 'photo_2_avo_alt'.$i])!!}
            <br>
            <br>
            {!! Form::label('Photo 2 AVO Caption: ') !!}
            {!! Form::text('photo_2_caption'.$i,  isset($photos[$i]['alt']) ? $photos[$i]['caption'] : null,['class' => 'f1', 'id' => 'photo_2_avo_caption'.$i])!!}
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
<div class="w_box centerPics">
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
        {!! Form::label('mr_subhead','Subhead') !!}
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
<div class="w_box centerPics pl_plus_form hide">
    <div class="centers_basic">
       {!! Form::label('plus_package','Package') !!}
       {!! Form::text('plus_package',null,['class' => 'f1']) !!}
       <br>
       {!! Form::label('plus_price','Price') !!} 
       {!! Form::text('plus_price',isset($prices->price) ? $prices->price : null,['class' => 'f1']) !!}
       <br>
       {!! Form::label('plus_with_live_receptionist_full_price','Live Receptionist Full Price') !!}
       {!! Form::text('plus_with_live_receptionist_full_price',isset($prices->with_live_receptionist_full_price) ? $prices->with_live_receptionist_full_price : null,['class' => 'f1']) !!}
       <br>
       {!! Form::label('plus_with_live_receptionist_pak_price','Live Receptionist Price') !!}
       {!! Form::text('plus_with_live_receptionist_pak_price',isset($prices->with_live_receptionist_pack_price) ? $prices->with_live_receptionist_pack_price : null,['class' => 'f1']) !!}
       <br>
    </div>          
    
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

    $('.show_plp_package').on('click', function(){
        if($(this).prop('checked')) {
            $('.pl_plus').removeClass('hide');
            $('.pl_plus_form').removeClass('hide');
        } else {
            $('.pl_plus').addClass('hide');
            $('.pl_plus_form').addClass('hide');
        }
    })

    $.each([1,2,3,4,5,6],function(i, val){
        $('.txtLink2' + val).css('cursor', 'pointer');
        $('.txtLink2' + val).on('click', function(){
            if($('#hide' + val).hasClass('hide')) {
                $('#hide' + val).removeClass('hide');
            } else {
                $('#hide' + val).addClass('hide');
            }
        })
    })
    $.each([1,2,3,4,5,6],function(i, val){
        $('.rule_d' + val).change(function(){
            $.post('/alts-and-captions', {category:$(this).val(), center_city: $('#city').val()}, function(data){
                var rand_int = Math.floor(3*Math.random());
                console.log($('.rule_d' + val).attr('name'));
                var alt = data.alts[0][rand_int];
                var caption = data.caps[0][rand_int];
                $('#photo_2_avo_alt' + $('.rule_d' + val).attr('name').substr($('.rule_d' + val).attr('name').length - 1)).val(alt);
                $('#photo_2_avo_caption' + $('.rule_d' + val).attr('name').substr($('.rule_d' + val).attr('name').length - 1)).val(caption);
            })
        })
    })
    if($('#city').val() !== '') {
        $('.center_photos').removeClass('hide');
        $('.center_photos').addClass('show');
    }

    $('#city').on('change', function(){
        var city = $('#city').val();
        if(city !== '') {
            $('.center_photos').removeClass('hide');
            $('.center_photos').addClass('show');
        } else {
            $('.center_photos').removeClass('show');
            $('.center_photos').addClass('hide');
        }
    })

    $('.country').css('width', 321)
    $('.state').css('width', 321)
    
    

</script>


<!-- here -->

<form method="POST" action="http://admin.abcn.dev/owners/605" accept-charset="UTF-8"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="ODTXjZvBmxuyWwsrZT2j4tGOLWTxtftI3F3jyKN1">
    <input name="id" type="hidden" value="605">
    
    <div class="panel panel-default">
        <div class="panel-body col-md-6">
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Company Name</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Company Name" name="company_name" type="text" value="hh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Name</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Name" name="name" type="text" value="h"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Phone</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Phone" name="phone" type="text" value="555555"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Fax</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Fax" name="fax" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Website</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Website" name="url" type="text" value="hhh.hhh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Owner's Email</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="email" type="email" value="hhh@hhh.hhh"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Postal Code</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Owner's Email" name="postal_code" type="text" value="555555"></div>
            </div>
        </div>
        <div class="panel-body col-md-6">
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Billing Address 1</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Billing Address 1" name="address1" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Billing Address 2</label></div>
                <div class="col-md-8"><input class="form-control" placeholder="Billing Address 2" name="address2" type="text" value="5"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>City</label></div>
                <div class="col-md-8">
                    <input class="form-control ui-autocomplete-input" id="city" placeholder="City" name="city" type="text" value="Mobile" autocomplete="off">
                    <!-- <input id="city_id" name="city_id" type="hidden" value="302"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>County / Region</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="region" placeholder="County / Region" name="region" autocomplete="off"><option value="">no region</option><option value="Australia">Australia</option><option value="USA" selected="selected">USA</option><option value="Europe">Europe</option><option value="Asia">Asia</option><option value="UK">UK</option><option value="Africa">Africa</option><option value="Middle East">Middle East</option><option value="South America">South America</option></select>
                    <!-- <input id="region_id" name="region_id" type="hidden" value="2"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>State</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="us_state" placeholder="State" name="state" autocomplete="off"><option value="" selected="selected">no state</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option></select>
                    <!-- <input id="us_state_id" name="us_state_id" type="hidden" value="1"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Country</label></div>
                <div class="col-md-8">
                    <select class="form-control ui-autocomplete-input" id="country" placeholder="Country" name="country" autocomplete="off"><option value="">no country</option><option value="United States" selected="selected">United States</option><option value="Canada">Canada</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and/or Barbuda">Antigua and/or Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British lndian Ocean Territory">British lndian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecudaor">Ecudaor</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Ivory Coast">Ivory Coast</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfork Island">Norfork Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia South Sandwich Islands">South Georgia South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbarn and Jan Mayen Islands">Svalbarn and Jan Mayen Islands</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Republic Of China">Taiwan, Republic Of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States minor outlying islands">United States minor outlying islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City State">Vatican City State</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Virigan Islands (British)">Virigan Islands (British)</option><option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
                    <!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 text-right"><label>Notes</label></div>
                <div class="col-md-8">
                    <textarea class="form-control" id="country" placeholder="Notes..." name="notes" cols="50" rows="10">h</textarea>
                    <!-- <input id="country_id" name="country_id" type="hidden" value="1"> -->
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
                        <input class="btn btn-lg btn-success" type="submit" value="Submit">
            <a type="button" href="javascript:history.go(-1)" class="class' => 'btn btn-lg btn btn-info">Cancel</a>
            <!-- <input class="btn btn-lg btn btn-info" type="submit" value="Submit"> -->
        </div>
    </div>
</form>

    

