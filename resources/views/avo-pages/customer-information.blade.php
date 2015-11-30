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

            <div class="dsidecart radiusTop">
                <div class="contactPhonesCart">
                    <div class="centerForm">
                        NORTH AMERICA:    +1 888.869.9494<br>
                        INTERNATIONAL:     +1 949.777.6340
                    </div><!--/centerForm-->
                </div><!--/contactPhonesCart-->

                <div class="clear"></div>

                <!-- sidebar cart show -->
                <div class="theSideCartWrap changeMtop hide">
                    <div class="MyCart"><div class="mcartTxt">MY CART</div> <img src="images/myCart.png" class="myCartImg"/></div><!--/MyCart-->
                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">S. Grand Ave. in Los Angeles, CA</h3>
                        <h4 class="bold blue">ADDRESS</h4>
                        <p><span class="mediumBold">KPMG Building</span><br>
                        355 S. Grand Ave. Los Angeles, CA 90071<br><span class="smallLine mediumBold">12 month term</span></p>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">PLATINUM PLAN:</td><td class="sideCartr2"><span class="mediumBold">$80</span><span class="smallLine gray3"> /month</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL3">MAIL FORWARDING:</td><td class="sideCartr2"><span class="mediumBold">$0</span><span class="smallLine gray3"> /month</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL3">SET UP FEE:</td><td class="sideCartr2"><span class="mediumBold">$100</span><br><span class="smallLine gray3">(one time only)</span></td>
                            </tr>
                        </table>
                        <table width="100%">
                        <tr>
                            <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$180</span></td>
                        </tr>
                        </table>
                    </div><!--/eachSCartWrap-->

                    <div class="eachSCartWrap marginTop paddingtop">
                        <h3 class=" bold">High Bluff Drive</h3>
                        <h4 class="bold blue">ADDRESS</h4>
                        <p><span class="mediumBold">Plaza Del Mar</span><br>
                        12526 High Bluff Drive San Diego CA 92130<br><span class="smallLine mediumBold">04/29/2015<br>11:30 am - 1:30 pm</span></p>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL2">MEETING ROOM:</td><td class="sideCartr2"><span class="mediumBold">$45</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">TOTAL AMOUNT:</td><td class="sideCartr2"><span class="mediumBold">$90</span></td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">30% DUE NOW:</td><td class="sideCartr2"><span class="mediumBold">$27</span></td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL3">TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$14</span></td>
                            </tr>
                        </table>
                    </div><!--/eachSCartWrap-->

                    <table class="totalLine" width="100%">
                        <tr>
                            <td class="sideCartL3">ORDER TOTAL:</td><td class="sideCartr2"><span class="mediumBold aqua mediumBold">$194</span></td>
                        </tr>
                    </table>
                    <div class="clear"></div>
                    <div class="bottomSideCart">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.</div><!--/bottomSideCart-->
                </div><!--/theSideCartWrap-->
            </div><!--/dsidecart-->

            <div class="wrapMRdetails">
                <div class="StepsContentLeft">
                    <div class="fL sone"><div class="stepOne">STEP 1 - Customize</div><div class="sfR Rd"></div></div>
                    <div class="fL stwo"><div class="sfL La"></div><div class="stepTwo sactive">STEP 2 - Checkout & Review</div><div class="sfR Ra"></div></div>
                    <div class="fL sthree"><div class="sfL Ld"></div><div class="stepThree">STEP 3 - Confirm</div></div>
                </div><!--/StepsContentLeft-->

                <div class="StepsContentLeft">
                    <div class="wrapDescrip">
                        <h1 class="gray2">ACCOUNT INFORMATION & CHECKOUT</h1>
                        <div class="signin-info changeMtop2 ">
                            <form action="" method="post" name="signin" >
                                <input type="hidden" name="returning_customer_yes" value="1" />
                                <p><span class="mediumBold">Please enter your email and password below.</span></p><br>
                                <div class="existingL">
                                    <label>Email Address</label>
                                </div>
                                <div class="existingR">
                                    <input class="checkOutInput" type="text" name="Email" value=""/>
                                </div>
                                <div class="clear"></div>
                                <div class="existingL"><label>Password</label></div>
                                <div class="existingR">
                                    <input class="checkOutInput" type="password" name="LPassword" value=""/>
                                </div>
                                <div class="clear"></div>
                                <div class="existingL"></div>
                                <input value="SUBMIT" class="aquaBtn changeMtop minW" type="submit"><br>

                                <div class="existingL"></div>
                                <div class="help hide">
                                    <img src="images/info.png" class="tooltip"/> Having problems signing in?
                                </div>
                            </form>
                        </div><!--/signin-info-->

                        {!! Form::model(session('customer_information'), ['class' => 'custInfoForm', 'name' => 'form1']) !!}
                            @if($errors->has())
                                <div class="alert-error-custom">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="new_customer" value="1" >
                            <div class="newCinfo">
                                <h3><span class="newCust">NEW CUSTOMERS - <span class="medium">ENTER YOUR BILLING INFORMATION</span></span></h3>
                                <br><p>Please enter the required information about yourself below.</p>
                                <span class="smallLine"><span class="orange">*</span> Indicates a required field</span><br>

                                <div class="clear"></div>
                                <div class="newL">
                                    <label>First Name <span class="orange">*</span></label>
                                    {!! Form::text('first_name', null) !!}
                                </div>
                                <div class="newL">
                                    <label>Last Name <span class="orange">*</span></label>
                                    {!! Form::text('last_name', null) !!}
                                </div>
                                <div class="clear"></div>
                                <div class="newL">
                                    <label>Email <span class="orange">*</span></label>
                                    {!! Form::email('email', null) !!}
                                </div>
                                <div class="newL">
                                    <label>Phone Number <span class="orange">*</span></label>
                                    {!! Form::text('phone', null) !!}
                                </div>
                                <div class="clear"></div>
                                <div class="newL2">
                                    <label>Company <span class="orange">*</span></label>
                                    {!! Form::text('company_name', null, ['class' => 'inputLong']) !!}
                                </div>
                                <div class="newL2">
                                    <label>Address 1 <span class="orange">*</span></label><br>
                                    {!! Form::text('address1', null, ['class' => 'inputLong']) !!}
                                </div>
                                <div class="newL2">
                                    <label>Address 2</label><br>
                                    {!! Form::text('address2', null, ['class' => 'inputLong']) !!}
                                </div>
                                <div class="clear"></div>
                                <div class="newL">
                                <label>Country</label><br/>
                                    {!! Form::select('country_id', ['' => 'Please Select A Country']+$countries , null, ['class' => 'field-select']) !!}
                                </div>
                                <div class="clear"></div>
                                <div class="newL3">
                                    <label>City</label>
                                    {!! Form::text('city', null, ['class' => 'inputSmall']) !!}
                                </div>
                                <div class="newL3">
                                    <label>State</label>
                                    {!! Form::text('state', null, ['class' => 'inputSmall']) !!}
                                </div>
                                <div class="newL3">
                                    <label>Postal Code<span class="orange">*</span></label>
                                    {!! Form::text('postal_code', null, ['class' => 'inputSmall']) !!}
                                </div>
                            </div><!--/newCinfo-->
                            <!-- end billing info //-->

                            <div class="mailFinfo">
                                <h3><span class="newCust">MAIL FORWARDING INFORMATION</span></h3>
                                <p>
                                    {!! Form::checkbox('mf_same', 'yes', null ,  ['class' => 'inputSmall', 'onclick' => "mfchange();"]) !!}
                                    Yes, I'd like my mail forwarded to my billing address.
                                </p>
                                <br>
                                <div class="newL">
                                    <label>First Name <span class="orange">*</span></label>
                                    {!! Form::text('mf_first_name', null) !!}
                                </div>
                                <div class="newL">
                                    <label>Last Name <span class="orange">*</span></label>
                                    {!! Form::text('mf_last_name', null) !!}
                                </div>
                                <div class="clear"></div>

                                <div class="newL2">
                                    <label>Address 1 <span class="orange">*</span></label>
                                    {!! Form::text('mf_address1', null, ['class' => 'inputLong']) !!}
                                </div>
                                <div class="newL2">
                                    <label>Address 2</label>
                                    {!! Form::text('mf_address2', null, ['class' => 'inputLong']) !!}
                                </div>
                                <div class="newL2">
                                    <label>Company Name <span class="orange">*</span></label>
                                    {!! Form::text('mf_company_name', null, ['class' => 'inputLong']) !!}
                                </div>

                                <div class="newL">
                                    <label>Country <span class="orange">*</span></label><br/>
                                    {!! Form::select('mf_country_id', ['' => 'Please Select A Country']+$countries, null) !!}
                                </div>

                                <div class="clear"></div>
                                <div class="newL3">
                                    <label>City</label>
                                    {!! Form::text('mf_city', null, ['class' => 'inputSmall']) !!}
                                </div>

                                <div class="newL3">
                                    <label>State</label>
                                    {!! Form::text('mf_state', null, ['class' => 'inputSmall']) !!}
                                </div>
                                <div class="newL3">
                                    <label>Postal Code <span class="orange">*</span></label>
                                    {!! Form::text('mf_postal_code', null, ['class' => 'inputSmall']) !!}
                                </div>

                                <div class="clear"></div>
                                <!-- end username information//-->
                            </div><!--/mailFinfo-->
                            <!-- end mail forwarding info //-->

                            <div class="AccountPW">
                                <h3><span class="newCust">ACCOUNT PASSWORD INFORMATION</span></h3>
                                <div class="newL">
                                    <label>Password <span class="orange">*</span></label><br/>
                                    {!! Form::password('password', null) !!}<br>
                                    <span class="smallLine">10 character limit</span>
                                </div>
                                <div class="newL">
                                    <label>Confirm Password <span class="orange">*</span></label><br/>
                                    {!! Form::password('password_confirmation', null) !!}<br>
                                </div>
                                <div class="clear"></div>
                                <!-- end username information//-->
                            </div><!--/AccountPW-->

                            <div class="PaymentInfo">
                                <h3><span class="newCust">PAYMENT INFORMATION</span></h3>
                                <input type="radio" name="payType" id="creditCard" value="cc" onclick="paymentMethod();"> Pay by Credit Card  &nbsp; &nbsp;
                                <input type="radio" name="payType" id="bitcoin" value="bitcoin" onclick="paymentMethod();">Pay with Bitcoin<br>
                                <div class="clear"></div>

                                <div id="checkout-fields" style="display:none;">
                                    <div class="newL2">
                                        <label>Cardholder's Name<span class="orange">*</span></label>
                                        {!! Form::text('cc_name', null, ['class' => 'inputLong']) !!}
                                    </div>
                                    <div class="newL">
                                        <label>Card Number<span class="orange">*</span></label>
                                        {!! Form::text('cc_number', null) !!}
                                    </div>
                                    <div class="newL">
                                        <label>CVV2 Number<span class="orange">*</span></label>
                                        {!! Form::text('ccv3', null) !!}<br/>
                                        <abbr>
                                            <a href="{{ url('cvv2') }}" class="aqua smallLine" onclick="window.open (this.href, 'child', 'height=300,width=600, scrollbars=yes'); return false" title="Click for more information">Where's my CVV2?</a>
                                        </abbr>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="newL">
                                        <label>Expiration Date: <span class="orange">*</span></label>
                                        {!! Form::select('cc_month', ['01' => 'January (01)', '02' => 'February (02)', '03' => 'March (03)', '04' => 'April (04)', '05' => 'May (05)', '06' => 'June (06)', '07' => 'July (07)', '08' => 'August (08)', '09' => 'September (09)', '10' => 'October (10)', '11' => 'November (11)', '12' => 'December (12)'], null) !!}
                                    </div>
                                    <div class="newL">
                                        <label>Expiration Date: <span class="orange">*</span></label>
                                        {!! Form::select('cc_year', ['14' => 2014, '15' => 2015, '16' => 2016, '17' => 2017, '18' => 2018, '19' => 2019, '20' => 2020, '21' => 2021, '22' => 2022, '23' => 2023, '24' => 2024], null) !!}
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div id="bitpay-fields" style="display: none;">
                                    <br /><br /><p><span class="bold">Please accept the terms and hit continue to go to the Bitpay checkout</span></p>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>

                            </div><!--/PaymentInfo-->
                            <!-- end payment information//-->


                            <div class="acceptTerms">
                                {!! Form::checkbox('agree', 'yes', null) !!}
                                <label><span class="orange">*</span> I agree to the Terms of Service - </label>
                                <a href="{{ url('mr-terms') }}" class="aqua" target="V">Terms of Service</a>
                                <br/><br/>
                                {!! Form::submit('CONTINUE', ['class' => 'aquaBtn changeMtop continueBTN' ]) !!}

                                <div class="clear"></div>
                            </div><!--/acceptTerms-->
                            <!-- end terms information//-->
                        {!! Form::close() !!}
                        <!-- END BRM CODE //-->

                        

                    </div><!--/wrapDescrip-->
                </div><!--/StepsContentLeft-->
            </div><!--/wrapMRdetails-->

            <div class="clear"></div>
        </div><!--/detailsTopWrap2-->

        <div class="nearWrap"></div><!--/nearWrap-->

    </div>
    <!--/intWrap-->
@stop

@section('scripts')
    <script src="/js/icheck.js"></script>
    <script type="text/rocketscript" data-rocketsrc="/js/jquery.tooltipster.min.js"></script>
    <script type="text/rocketscript" data-rocketsrc="/js/icheck.js"></script>
    <script type="text/rocketscript">
        jQuery(document).ready(function($) {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });

            $('.iCheck-helper').on('click', function() {
                $(this).siblings('input').click();
            });
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
                content: $('<span> We have recently updated our login procedure.<br><br>Now, you can use the email address you gave us when you became a client, or if you were a customer starting before August 13, 2012, you can also use your your old username (be sure to type username@abcnvirtual.com).<br><br><span class="mediumBold">If you have forgotten your password please use our <br><a href="https://www.alliancevirtualoffices.com/password-recover.php" class="blue mediumBold">password recovery page</a></span> </span>')
            });

            if ($(window).width() > 850) {
                $(".dformright2").stick_in_parent()
            }
            else {};

            $( window ).resize(function() {
                if ($(window).width() < 850) {
                    $(".dformright2").trigger("sticky_kit:detach");
                }
                else {
                    $(".dformright2").stick_in_parent()
                };
            });

            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });

        });

        function mfchange() {
            var mf_same = $("input[name='mf_same']");
            var checked = !mf_same[0].checked;
            var name;
            var val = '';
            var inputs = [
                'first_name', 'last_name', 'email', 'phone', 'company_name', 'address1', 
                'address2', 'country_id','city', 'state', 'postal_code'
            ];
            /*if(!checked && !confirm('You sure want to unuse this field, all "MAIL FORWARDING INFORMATION" inputs will be empty.')) {
                return false;
            }*/
            for( key in inputs ){
                name = inputs[key];
                if(checked) {
                    val = $("input[name='"+name+"']").val();
                    $("input[name='mf_"+name+"']").val(val);
                }
            }
        }

        function paymentMethod() {
            var cc = document.getElementById('creditCard');
            var bitcoin = document.getElementById('bitcoin');
            //console.log(cc);
            //console.log(bitcoin);
            if(cc.checked) {
                $('#checkout-fields').show();
                $('#bitpay-fields').hide();
            }
            if(bitcoin.checked) {
                $('#checkout-fields').hide();
                $('#bitpay-fields').show();
            }
        }
    </script>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/tooltipster.css"/>
    <link rel="stylesheet" type="text/css" href="/css/themes/tooltipster-light.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/css/flat/grey.css">
@stop