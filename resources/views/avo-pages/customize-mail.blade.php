@extends('layout.layout')
@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
    <!--[if lt IE 9]>
        <script>document.createElement('section')</script>
        <style type="text/css">
            .holder {
                position: relative;
                z-index: 10000;
            }
            .datepicker {
                display: block;
            }
        </style>
    <![endif]-->

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
                <!--/StepsContentLeft-->
                <div class="StepsContentLeft">
                    <div class="wrapDescrip">
                        <h1 class="gray2">CUSTOMIZE AND CHOOSE OPTIONS</h1>
                        <p>Please customize your mail options first</p>
                        <h3>Virtual Office Term Length:</h3>
                        <form action="" method="post" name="form1" id="form1" >
                            <input type="hidden" name="step" value="2" />
                            <input type="hidden" name="Center_ID" value="$LNavCenterData[Center_ID]" />

                            <select name="term" class="term-drop">
                                <option value="">Select Your Term Length</option>
                                <option value="6" selected="selected">6 Month Term</option>
                                <option value="12">12 Month Term</option>
                            </select>

                            <h3 class="changeMtop2">Please select your mail forwarding options:</h3>

                            <table width="100%" border="0" cellspacing="5" cellpadding="5" class="table_fonts">
                                <tr>
                                    <td>Forwarding Method:</td>
                                </tr>
                                <tr>
                                    <td width="150">
                                        <select name="product" id="forward" class="selcDrop" onChange="xajax_changePrice(this.value, document.getElementById('req').selectedIndex);">
                                            <option value="">Please Select </option>
                                            <option value="20">Local Pickup</option>
                                            <option value="21">Regular Mail </option>
                                            <option value="22">Priority/Express Mail </option>
                                            <option value="23">Next Day Courier </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="FreqHide">Forwarding Frequency:</td>
                                </tr>
                                <tr>
                                    <td class="FreqHide">
                                        <select name="freq" id="freq" class="selcDrop" onChange="xajax_changePrice(document.form1.product.value, this.value);">
                                            <option value="">Please Select </option>
                                            <option value="1">Monthly </option>
                                            <option value="2">Bi-Weekly </option>
                                            <option value="4">Weekly </option>
                                            <option value="30">Daily </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div id="price">$0.00</div><div id="price_text">&nbsp;</div></td>
                                </tr>
                            </table>
                            <div class="upgrade">
                                <p>Would you like to add <span class="bold">16 hours of conference room time</span> monhtly for only <span class="bold aqua">$$remainder</span> more per month?</p><br><br>
                            </div>

                            <p><input type="checkbox" name="upgrade" value="yes" style="width: 15px; height: auto;" /> <span class="bold">Yes!</span> I'd like to upgrade to the Platinum Plus package</p><br>
                            <input value=" CONTINUE " class="aquaBtn changeMtop continueBTN" type="submit" ><br>

                        </form>
                    </div><!--/wrapDescrip-->
                </div><!--/StepsContentLeft-->
            </div>
            <!--/wrapMRdetails-->

            <div class="dsidecart radiusTop hide">
                <div class="contactPhonesCart">
                    <div class="centerForm">
                        NORTH AMERICA: +1 888.869.9494<br>
                        INTERNATIONAL: +1 949.777.6340
                    </div><!--/centerForm-->
                </div><!--/contactPhonesCart-->
                <div class="dimgSideCart">
                    <div class="img-wrapper2">
                        <img src="http://www.abcn.com/images/photos/3056_Los-Angeles-office-space.jpg" />
                    </div>
                </div><!--/dimg-->
                <div class="clear"></div>
                <div class="theSideCartWrap">
                    <div class="eachSCartWrap">
                        <h3 class=" bold">S. Grand Ave. in Los Angeles, CA</h3>
                        <h4 class="bold blue">ADDRESS</h4>
                        <p><span class="mediumBold">KPMG Building</span><br>
                            355 S. Grand Ave. Los Angeles, CA 90071</p>
                        <div class="sideCartLine">
                            <div class="sideCartL">PLATINUM PLAN:</div>
                            <div class="sideCartr">
                                <span class="mediumBold">$80</span>/month
                            </div>
                        </div><!--/sideCartLine-->
                        <div class="clear"></div>
                        <div class="sideCartLine">
                            <div class="sideCartL">MAIL FORWARDING:</div>
                            <div class="sideCartr">
                                <span class="mediumBold">$0</span>/month
                            </div>
                        </div><!--/sideCartLine-->
                        <div class="clear"></div>
                        <div class="sideCartLine">
                            <div class="sideCartL">
                                SET UP FEE:
                            </div>
                            <div class="sideCartr">
                                <span class="mediumBold">$100</span><br>(one time only)
                            </div>
                        </div><!--/sideCartLine-->
                        <div class="clear"></div>
                    </div><!--/eachSCartWrap-->
                    <div class="sideCartLine">
                        <div class="sideCartL">TOTAL:</div>
                        <div class="sideCartr aqua mediumBold">$180</div>
                    </div><!--/sideCartLine-->
                    <div class="clear"></div>
                    <div class="bottomSideCart">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div>
                    <!--/bottomSideCart-->
                </div><!--/theSideCartWrap-->
            </div>
            <!--/dsidecart-->
            <div class="clear"></div>
        </div>
        <!--/detailsTopWrap2-->
        <div class="nearWrap"></div>
        <!--/nearWrap-->
    </div>
    <!--/intWrap-->
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

            /*if ($(window).width() > 850) {
               $(".dformright2").stick_in_parent()
            }
            else {
            };*/

            /*$( window ).resize(function() {
                if ($(window).width() < 850) {
                   $(".dformright2").trigger("sticky_kit:detach");
                }
                else {
                   $(".dformright2").stick_in_parent()
                };
            });*/

            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });

            $( "#forward" ).change(function() {
                $('select#freq>option:eq(0)').attr('selected', true);
            });

            $('#forward').change(function(){
                if($(this).val() == '20'){
                    $('.FreqHide>option:eq(2)').attr('selected', true);
                    $('.FreqHide').hide();
                }else if($(this).val() == ''){
                    $('.FreqHide>option:eq(2)').attr('selected', true);
                    $('.FreqHide').hide();
                }else{
                    $('.FreqHide').show();
                    $('.FreqHide>option:eq(0)').attr('selected', true);
                }
            });
        });
    </script>
@stop

@section('styles')
  <link href="css/flat/grey.css" rel="stylesheet">
@stop