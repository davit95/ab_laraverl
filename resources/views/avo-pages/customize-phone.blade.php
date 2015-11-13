@extends('layout.layout')
@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
<div class="intWrap">
    <div class="detailsTopWrap2 changeMtop3">
        <div class="wrapMRdetails">
            <div class="StepsContentLeft">
                <div class="fL sone">
                    <div class="stepOne sactive">STEP 1 - Customize</div>
                    <div class="sfR Ra"></div>
                </div>
                <div class="fL stwo">
                    <div class="sfL Ld"></div>
                    <div class="stepTwo">STEP 2 - Checkout & Review</div>
                    <div class="sfR Rd"></div>
                </div>
                <div class="fL sthree">
                    <div class="sfL Ld"></div>
                    <div class="stepThree">STEP 3 - Confirm</div>
        	   </div>
            </div>
            <div class="StepsContentLeft">
                <div class="wrapDescrip">
                    <form action="/save-phone-settings" method="post" name="form1" id="form1" >
                        <h1 class="gray2">CUSTOMIZE AND CHOOSE OPTIONS</h1>
                        <div class="customPhoneTop">
                            <p>
                                <span class="mediumBold">Select whether you would like a local or toll free number.</span>
                            </p>
                            <br>
			                
			                
                            <input type="radio" id="localNumber" name="package_option" value="local" onclick="toggleTel('CountrySelect', 'TollFree');"/>
                            <label> local number</label> &nbsp; &nbsp; 
                            <input type="radio" id="" name="package_option" value="toll_free" onclick="toggleTel('TollFree','CountrySelect');"/>
                            <label> toll free number</label>
                            <br><br>
                        </div>
                        <div id="CountrySelect" style="display:none">
                            <p>
                                <span class="mediumBold">Please select the country you'd like your number to be in:</span>
                            </p>
                            {!! Form::select('country_code', ['' => 'Please Select'] + $country_codes, null, ['class' => 'countryPhone changeMtop']) !!}
                        </div>
                        <div id="TollFree" style="display:none">
                            <p>
                                <span class="mediumBold">Select a toll-free prefix below to see available numbers.</span>
                            </p>
                            {!! Form::select('phone_number_selected', [
                                ''    => 'Please Select',
                                '800' => '800',
                                '888' => '888',
                                '866' => '866',
                                '877' => '877',
                            ], null, ['class' => 'TollFPhone changeMtop'])!!}
                        </div>
                        <br>
                        <div id="Prefix" style="display:none">
                            <div class="areaCode">
                                <p>
                                    <span class="mediumBold">Please select the area code you'd like:</span>
                                </p>
                                <select class="TollFPhone changeMtop"></select>
                            </div>
                        </div>
                        <br>
                        <div id="numbers" style="display:none">
                            <div id="numSelect">
                                <p>
                                    <span class="mediumBold">Please select a number:</span>
                                </p>
                                <select name="phone_number_selected" class="TollFPhone changeMtop"></select>
                            </div>
                        </div>
                        <br>
	                   <input value=" CONTINUE " class="aquaBtn changeMtop continueBTN" type="submit" ><br> 
                    </form>
                </div>
            </div>
        </div>
        <div class="dsidecart radiusTop hide">
        	<div class="contactPhonesCart">
            <div class="centerForm">
            NORTH AMERICA: +1 888.869.9494<br>
	    INTERNATIONAL: +1 949.777.6340
            </div><!--/centerForm-->
            </div><!--/contactPhonesCart-->
            <div class="dimgSideCart"><div class="img-wrapper2"><img src="http://www.abcn.com/images/photos/3056_Los-Angeles-office-space.jpg" /></div></div><!--/dimg-->
            <div class="clear"></div>
            <div class="theSideCartWrap">
            <div class="eachSCartWrap">
            <h3 class=" bold">S. Grand Ave. in Los Angeles, CA</h3>
            <h4 class="bold blue">ADDRESS</h4>
            <p><span class="mediumBold">KPMG Building</span><br>
            355 S. Grand Ave. Los Angeles, CA 90071</p>
            <div class="sideCartLine"><div class="sideCartL">PLATINUM PLAN:</div><div class="sideCartr"><span class="mediumBold">$80</span>/month</div></div><!--/sideCartLine--><div class="clear"></div>
            <div class="sideCartLine"><div class="sideCartL">MAIL FORWARDING:</div><div class="sideCartr"><span class="mediumBold">$0</span>/month</div></div><!--/sideCartLine--><div class="clear"></div>
            <div class="sideCartLine"><div class="sideCartL">SET UP FEE:</div><div class="sideCartr"><span class="mediumBold">$100</span><br>(one time only)</div></div><!--/sideCartLine--><div class="clear"></div>
            </div><!--/eachSCartWrap-->
            <div class="sideCartLine"><div class="sideCartL">TOTAL:</div><div class="sideCartr aqua mediumBold">$180</div></div><!--/sideCartLine-->
            <div class="clear"></div>
            <div class="bottomSideCart"><!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim. --></div><!--/bottomSideCart-->
            </div><!--/theSideCartWrap-->
        </div><!--/dsidecart-->
        
        <div class="clear"></div>
        </div><!--/detailsTopWrap2-->
       
        <div class="nearWrap">
        
        </div><!--/nearWrap-->
	</div><!--/intWrap-->
@stop

@section('scripts')
<script src="/js/icheck.js"></script>
<script>
        jQuery(document).ready(function($) {
      
          $( ".menuBtnLink" ).click(function() {
            $( ".menu" ).slideToggle( "slow", function() {
            // Animation complete.
            });
          });
      
      
      
      
     
      
      $( window ).resize(function() {
        if ($(window).width() < 850) {
         $(".dformright2").trigger("sticky_kit:detach");
      }
      else {
         $(".dformright2").stick_in_parent()
      };;
      });
      
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-grey',
          radioClass: 'iradio_flat-grey'
        });

        $('.iCheck-helper').on('click', function() {
          $(this).siblings('input').click();
        });
      });

        function toggleTel (el1, el2) {
          console.log(el1, el2);
          var myElement = document.getElementById(el1);
          var myElement2 = document.getElementById(el2);

          if (!myElement.style.display || myElement.style.display == "none") {
            myElement.style.display = "block";
            myElement2.style.display = "none";
            
          }
            $("#Prefix").hide();
            $("#numbers").hide();
        }

        $("select[name='country_code']").on('change', function()
        {
            var country_code = $(this).val()
          $.ajax({
            url : '/get-area-codes',
            method : 'get',
            data  : {country_code: country_code},
            beforeSend : function()
            {
                $('body').css('cursor', 'wait');
            },
            success : function(data)
            {
                $('body').css('cursor', 'default');
              if(country_code != 1)
              {
                  $("select[name='full_number']").html("<option>Please Select</option>" + data);
                  $("#numbers").show();
                  $("#Prefix").hide();
              }
              else
              {
                $("#Prefix").find('select').html("<option>Please Select</option>" + data);
                $("#Prefix").show();
                $("#numbers").hide();
              }
            }
          })
        });

        $("#Prefix select").on('change', function()
        {
            var prefix = $(this).val();
            var country_code = $("select[name='country_code']").val();
            $.ajax({
                url : '/get-area-numbers',
                data : {country_code: country_code, prefix: prefix},
                beforeSend : function()
                {
                    $('body').css('cursor', 'wait');
                },
                success : function(data)
                {
                    $('body').css('cursor', 'default');
                  
                      $("select[name='full_number']").html("<option>Please Select</option>" + data);
                      $("#numbers").show();
                }
            });
        })

        $("#TollFree select").on('change', function()
        {
            var prefix = $(this).val();
            $.ajax({
                url : '/get-toll-free-numbers',
                data : {prefix: prefix},
                beforeSend : function()
                {
                    $('body').css('cursor', 'wait');
                },
                success : function(data)
                {
                    $('body').css('cursor', 'default');
                  
                      $("select[name='full_number']").html("<option>Please Select</option>" + data);
                      $("#numbers").show();
                }
            });
        })
    </script>
@stop

@section('styles')
  <link href="css/flat/grey.css" rel="stylesheet">
@stop