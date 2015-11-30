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

                    @foreach ($items as $item)
                        @if($item->type == 'mr')
                            <div class="eachSCartWrap marginTop paddingtop">
                                <h3 class=" bold">Meeting Room</h3>
                                <h4 class="bold blue">ADDRESS</h4>
                                <p>
                                    <span>{!! is_null($center = $item->center)?'':$center->city_name !!}</span>
                                    {!! $center->address1 !!} {!! $center->address2!!} {!! $center->city_name !!} {!! $center->us_state !!} {!! $center->postal_code !!}<br><span class="smallLine mediumBold">
                                    {{ (new DateTime($item->mr_date))->format('d/m/Y') }}<br>
                                    {{ (new DateTime($item->mr_start_time))->format('H:i a') }} - {{ (new DateTime($item->mr_end_time))->format('H:i a') }}
                                    </span>
                                </p>
                                <table width="100%">
                                    <tr>
                                        <td class="sideCartL2">{!! is_null($center = $item->center)?'':$center->city_name !!}:</td>
                                        <td class="sideCartr2"><span class="mediumBold">{!! session('currency.symbol') !!}{!! round($item->price_per_hour*session('rate'),2) !!}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sideCartL2">TOTAL AMOUNT:</td>
                                        <td class="sideCartr2"><span class="mediumBold">{!! session('currency.symbol') !!}{!! round($item->price*session('rate'), 2) !!}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="sideCartL2">30% DUE NOW:</td>
                                        <td class="sideCartr2"><span class="mediumBold">{!! session('currency.symbol') !!}{{ round(($item->price_due*session('rate')),2) }}</span></td>
                                    </tr>
                                </table>
                                <table width="100%">
                                    <tr>
                                        <td class="sideCartL3">TOTAL:</td>
                                        <td class="sideCartr2"><span class="mediumBold aqua mediumBold">{!! session('currency.symbol') !!}{!! round(($item->price_total*session('rate')), 2) !!}</span></td>
                                    </tr>
                                </table>
                            </div><!--/eachSCartWrap-->
                        @else
                            @if (!is_null($center = $item->center))
                                <span class="mediumBold">Virtual Office</span>
                                <div class="eachSCartWrap marginTop paddingtop">
                                    <h3 class=" bold">Virtual Office</h3>
                                    <h4 class="bold blue">ADDRESS</h4>
                                    <p>
                                        <span class="mediumBold">{!! is_null($center = $item->center)?'':$center->city_name !!}</span><br>
                                        {!! $center->address1 !!} {!! $center->address2!!} {!! $center->city_name !!}, {!! $center->us_state !!} {!! $center->postal_code !!}<br>
                                    </p>
                                    <table width="100%">
                                        <tr>
                                            <td class="sideCartL3">{!! $item->vo_plan !!}:</td>
                                            <td class="sideCartr2">
                                                <span class="mediumBold">{!! session('currency.symbol') !!}{!! $item->price*session('rate') !!}</span>
                                                <span class="smallLine gray3"> /month</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="sideCartL3">MAIL FORWARDING:</td>
                                            <td class="sideCartr2">
                                                <span class="mediumBold">{!! session('currency.symbol') !!}{!! $item->vo_mail_forwarding_price*session('rate') !!}</span>
                                                <span class="smallLine gray3"> /month</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="sideCartL3">SET UP FEE:</td>
                                            <td class="sideCartr2">
                                                <span class="mediumBold">$100</span>
                                                <span class="smallLine gray3">(one time only)</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td class="sideCartL3">TOTAL:</td>
                                            <td class="sideCartr2">
                                                <span class="mediumBold aqua mediumBold">{!! session('currency.symbol') !!}{!! $item->sum*session('rate') !!}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        @endif

                    @endforeach

                    <table class="totalLine" width="100%">
                        <tr>
                            <td class="sideCartL3">ORDER TOTAL:</td>
                            <td class="sideCartr2">
                                <span class="mediumBold aqua mediumBold">{!! session('currency.symbol') !!}{!! round(($price_total*session('rate')), 2) !!}</span>
                            </td>
                        </tr>
                    </table>

                    <div class="clear"></div>
                    <div class="bottomSideCart">
                        {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim. --}}
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
                    @if(session('warning'))
                        <div class="alert-warning-custom"><b>Warning: </b>{{ session('warning') }}</div>
                    @endif
                </div>
                <div class="StepsContentLeft">
                    <div class="wrapDescrip">
                        <h1 class="gray2">ORDER CONFIRMATION</h1>
                        <div class="reviewInfo">
                            <h3><span class="newCust">CUSTOMER INFORMATION</span></h3>
                            <br>
                            <p>
                                <span class="mediumBold">Name:</span> {{ $customer->first_name }} {{ $customer->last_name }}<br />
                                <span class="mediumBold">Company:</span> {{ $customer->company_name }}<br />
                                <span class="mediumBold">Address:</span> {{ $customer->address1 }}<br /> {{ isset($customer->address2)?$customer->address2:'' }} {{ isset($customer->city)?$customer->city:'' }}, {{ isset($customer->state)?$customer->state:'' }}  {{ $customer->postal_code }}<br />
                                <span class="mediumBold">Country:</span> {{ isset($customer->country)?$customer->country:'No selected country' }}<br>
                                <span class="mediumBold">Phone:</span> {{ $customer->phone }}<br />
                                <span class="mediumBold">Email:</span> {{ $customer->email }}<br><br>
                                <a href="{{ url('customer-information') }}" class="aqua">Edit Your Information</a><br>
                            </p>

                            <div class="clear"></div>

                            <div class="recurringCharge changeMtop2 ">
                                <h3><span class="newCust">Meeting Room Charge Agreement{{-- FIXME: need to be text --}}</span></h3>
                                <p>You are about to request your meeting room. Alliance Virtual Offices will confirm your request within 48 hours (most likely a lot sooner); until then your meeting room is not scheduled. We will NOT charge your card until we have your meeting room completely confirmed.
                                <br>
                                <br>
                                By clicking "Place Order" you authorize Alliance Virtual Offices to charge your credit card for the amount of {!! session('currency.symbol') !!}{!! round(($price_total*session('rate')), 2) !!} upon confirmation of your meeting room. The remaining balance of $162.22, plus any additional charges incurred, will be charged at the time of your meeting. Please have your credit card available at the meeting room facility to finalize your charges.
                                <br>
                                <br>
                                You will not have any recurring fees.
                                <br>
                                <br>
                                For any <strong>cancelation or rescheduling</strong> we will need a <strong>48 hours</strong> notification.
                                Any reschedule after this time we will not be able to ensure availability.</p>



                            </div><!--/recurringCharge-->
                            {!! Form::open(['name' => 'form1']) !!}
                                {!! Form::hidden('step', 'next') !!}
                                {!! Form::hidden('multiple', '$multiple') !!}
                                {!! Form::hidden('returning', '$returning') !!}
                                {!! Form::submit('PLACE ORDER', ['class' => 'aquaBtn changeMtop minW']) !!}
                            {!! Form::close() !!}
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

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/tooltipster.css"/>
    <link rel="stylesheet" type="text/css" href="/css/themes/tooltipster-light.css"/>
@stop 
@section('scripts')
    <script type="text/rocketscript" data-rocketsrc="/js/jquery.tooltipster.min.js"></script>
    <script type="text/rocketscript" src="/js/icheck.js"></script>
    <script type="text/rocketscript">
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
  <link href="/css/flat/grey.css" rel="stylesheet">
@stop