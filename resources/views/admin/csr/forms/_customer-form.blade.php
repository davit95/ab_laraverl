@include('alerts.messages')


@if(isset($customer))
    {!! Form::model($customer,array('url' => '/customers/'.$customer->id, 'method' => 'PUT', 'role' => 'form','files' => true)) !!}
@else
{!! Form::open(['method' => 'post' , 'url' => '/customers','files' => true]) !!}
@endif
  
<div class="h2wrapp mtop1">
    <div class="h2Icon add"></div>
    <div class="h2txt">
        <h2>Update Customer's Information</h2>
    </div>
</div>
<div class="w_box centerPics">
    <div class="form_left centers_basic">
        {!! Form::label('First Name: ') !!}
        {!! Form::text('first_name', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('Last Name: ') !!}
        {!! Form::text('last_name', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('Address1: ') !!}
        {!! Form::text('address1', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('Address2: ') !!}
        {!! Form::text('address2', null,['class' => 'f1'])!!}
        <br>
        {!! Form::label('Company Name: ') !!}
        {!! Form::text('company_name',null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('City: ') !!}
        {!! Form::text('city',null,['class' => 'f1']) !!}
        <br> 
        {!! Form::label('State: ') !!}
        {!! Form::text('state',null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('Postal Code: ') !!}
        {!! Form::text('postal_code',null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('Phone Number: ') !!}
        {!! Form::text('phone',null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('Email: ') !!}
        {!! Form::text('email',null,['class' => 'f1']) !!}
        <br>    
    </div>          
    <div class="clear"></div>
</div>
<div class="h2wrapp mtop1">
	<div class="h2Icon add"></div>
	<div class="h2txt">
    	<h2>Update Credit Card Information</h2>
	</div>
</div>
<div class="w_box centerPics">
    <div class="form_left centers_basic">
        {!! Form::label('CC Name: ') !!}
        {!! Form::text('card_name',null,['class' => 'f1']) !!}
        <br>
        {!! Form::label('CC Number: ') !!}
        {!! Form::text('card_number', null ,['class' => 'f1']) !!}
        <br>
        {!! Form::label('Expiration Date: ') !!}
        {!! Form::text('card_number', null ,['class' => 'f1']) !!}
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

</script>
