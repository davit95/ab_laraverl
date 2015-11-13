@extends('layout.layout')
@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop
@section('content')
    <div class="intWrap">
        <div class="detailsTopWrap2 changeMtop3">
            <div class="dsidecart radiusTop">
                <div class="contactPhonesCart">
                    <div class="centerForm">
                        NORTH AMERICA:    +1 888.869.9494<br>
                        INTERNATIONAL:    +1 949.777.6340
                    </div><!--/centerForm-->
                </div><!--/contactPhonesCart-->

                <div class="clear"></div>
                <div class="theSideCartWrap changeMtop">
                    <div class="MyCart">
                        <div class="mcartTxt">MY CART</div>
                        <img src="images/myCart.png" class="myCartImg"/>
                    </div><!--/MyCart-->

                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">Virtual Office</h3>
                        <h4 class="bold blue">ADDRESS</h4>
                        <p>
                            <span class="mediumBold">$center_building_name</span><br>
                            $center_address_1 $center_address_2 $center_city, $center_state_abbrv $center_postal_code<br>
                            <span class="smallLine mediumBold">$Package_Terms month term</span>
                        </p>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">$Package_Name:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$$Disp_Package_Price</span>
                                    <span class="smallLine gray3"> /month</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="sideCartL3">MAIL FORWARDING:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$$MF_Total</span>
                                    <span class="smallLine gray3"> /month</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="sideCartL3">SET UP FEE:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$$Disp_Setup_Price</span>
                                    <span class="smallLine gray3">(one time only)</span>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">TOTAL:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold aqua mediumBold">$$line_total</span>
                                </td>
                            </tr>
                        </table>
                    </div><!--/eachSCartWrap-->

                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">Phone Plan</h3>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">$CP_Plan:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$$CP_Total</span>
                                    <span class="smallLine gray3"> /month</span>
                                </td>
                            </tr>
                            <tr>
                              <td class="sideCartL3">$taxes</td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">TOTAL:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold aqua mediumBold">$$line_total</span>
                                </td>
                            </tr>
                        </table>
                    </div><!--/eachSCartWrap-->

                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">Phone Plan</h3>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">$CP_Plan:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$$CP_Total</span>
                                    <span class="smallLine gray3"> /month</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="sideCartL3">$taxes</td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">TOTAL:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold aqua mediumBold">$$line_total</span>
                                </td>
                            </tr>
                        </table>
                    </div><!--/eachSCartWrap-->


                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">Meeting Room</h3>
                        <h4 class="bold blue">ADDRESS</h4>
                        <p>
                            <span>$mr_center_building_name</span>
                            $mr_center_address1 $mr_center_address2 $mr_center_city $mr_center_state $mr_center_zip<br><span class="smallLine mediumBold">$MRData[Meeting_Date]<br>$stime_in_12_hour_format - $etime_in_12_hour_format</span>
                        </p>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL2">$MRData[Name]:</td>
                                <td class="sideCartr2"><span class="mediumBold">$$mr_total_disp</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">TOTAL AMOUNT:</td>
                                <td class="sideCartr2"><span class="mediumBold">$$full_line_total</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">$mr_center_percentage% DUE NOW:</td>
                                <td class="sideCartr2"><span class="mediumBold">$$line_total</span></td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">TOTAL:</td>
                                <td class="sideCartr2"><span class="mediumBold aqua mediumBold">$$line_total</span></td>
                            </tr>
                        </table>
                    </div><!--/eachSCartWrap-->

                    <table class="totalLine" width="100%">
                        <tr>
                            <td class="sideCartL3">ORDER TOTAL:</td>
                            <td class="sideCartr2">
                                <span class="mediumBold aqua mediumBold">$$grand_total</span>
                            </td>
                        </tr>
                    </table>

                    <div class="clear"></div>
                    <div class="bottomSideCart">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.
                    </div><!--/bottomSideCart-->
                </div><!--/theSideCartWrap-->
            </div><!--/dsidecart-->

            <div class="wrapMRdetails">
                <div class="StepsContentLeft">
                    <div class="fL sone">
                        <div class="stepOne">STEP 1 - Customize</div>
                        <div class="sfR Rd"></div>
                    </div>
                    <div class="fL stwo">
                        <div class="sfL Ld"></div>
                        <div class="stepTwo">STEP 2 - Checkout & Review</div>
                        <div class="sfR Rd"></div>
                    </div>
                    <div class="fL sthree">
                        <div class="sfL La"></div>
                        <div class="stepThree sactive">STEP 3 - Confirm</div>
                    </div>
                </div><!--/StepsContentLeft-->
                <div class="StepsContentLeft">
                    <div class="wrapDescrip">
                        <h1 class="gray2">ORDER CONFIRMATION</h1>
                        <div class="reviewInfo">
                            <h3><span class="newCust">CUSTOMER INFORMATION</span></h3>
                            <br>
                            <p>
                                <span class="mediumBold">Name:</span> $CustomerData[First_Name] $CustomerData[Last_Name]<br />
                                <span class="mediumBold">Company:</span> $CustomerData[Company_Name]<br />
                                <span class="mediumBold">Address:</span> $CustomerData[Address1]<br /> $Address_2 $CustomerData[City], $CustomerData[State]  $CustomerData[Postal_Code]<br />
                                <span class="mediumBold">Country:</span> $CustomerData[Country]<br>
                                <span class="mediumBold">Phone:</span> $CustomerData[Phone1]<br />
                                <span class="mediumBold">Email:</span> $CustomerData[Email]<br><br>
                                <a href="checkout-review.php" class="aqua">Edit Your Information</a><br>
                            </p>

                            <div class="clear"></div>

                            <div class="recurringCharge changeMtop2 ">
                                <h3><span class="newCust">$col_head_text</span></h3>
                                <p>$bottom_review_text</p>
                            </div><!--/recurringCharge-->
                            <form action="" method="post" style="margin: 0;" name="form1">
                                <input type="hidden" name="step" value="next">
                                <input type="hidden" name="multiple" value="$multiple">
                                <input type="hidden" name="returning" value="$returning">
                                <input type="submit" value="PLACE ORDER" class="aquaBtn changeMtop minW" name="submit" />
                            </form>
                        </div><!--/reviewInfo-->
                    </div><!--/wrapDescrip-->
                </div><!--/StepsContentLeft-->
            </div><!--/wrapMRdetails-->
            <div class="clear"></div>
        </div><!--/detailsTopWrap2-->

        <div class="nearWrap">
        </div><!--/nearWrap-->
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

            $('.tooltip').tooltipster({
                animation: 'fade',
                theme: 'tooltipster-light',
                trigger: 'hover',
                contentAsHTML: true,
                interactive: true,
                content: $('<span>About this charge</span>')
            });

            if ($(window).width() > 850) {
                $(".dformright2").stick_in_parent()
            } else {

            };

            $( window ).resize(function() {
                if ($(window).width() < 850) {
                    $(".dformright2").trigger("sticky_kit:detach");
                } else {
                    $(".dformright2").stick_in_parent()
                };
            });

            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
        });
    </script>
@stop

@section('styles')
  <link href="css/flat/grey.css" rel="stylesheet">
@stop