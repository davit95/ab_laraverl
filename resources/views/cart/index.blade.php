@extends('layout.layout')
@section('title') Virtual Office, Virtual Office Solutions from Alliance Virtual Offices @stop
@section('content')
    <div class="intWrap">
        <div class="resutsTop">
            <div class="ResutlsTitle">
                <span class="bold">MY CART</span> &nbsp; <img src="images/myCart.png" class="myCartImg"/>
            </div>
            <div style="clear:both"></div>
            <div class="detailsTopWrap2 changeMtop2">
                <div class="LeftCart">
                    @forelse($items as $item)
                        @include('cart.parts.item')
                    @empty
                        <p>
                            <span class="bold">Your Shopping Cart is empty.</span>
                            <br><br>
                            Please fill it up with a
                            <a href="/virtual-offices" class="aqua">virtual office</a>,
                            <a href="/live-receptionist" class="aqua">live receptionist</a> or
                            <a href="/meeting-roos" class="aqua">meeting room</a>.
                        </p>
                    @endforelse
                    {{-- <div class="productCartW">
                        <div class="sideCartTL">
                            <h4 class="bold aqua">PRODUCT:</h4>
                        </div>
                        <div class="sideCartTr orange">
                            <a href="#" class="gray3">Remove &nbsp;<img src="images/remove.png" class="remove"/></a>
                        </div>
                        <div class="clear"></div>
                        <p>
                            <span class="mediumBold">Medium Meeting Room</span>
                            <br>
                            <span class="gray3">Plaza Del Mar 12526 High Bluff Drive Suite 300 San Diego CA 92130</span>
                            <br>
                            <span class="smallLine mediumBold">04/29/2015<br>11:30 am - 1:30 pm</span>
                        </p>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL2">MEETING ROOM:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$45</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">TOTAL AMOUNT:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$90</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="sideCartL2">30% DUE NOW:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold">$27</span>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="sideCartL2">TOTAL:</td>
                                <td class="sideCartr2">
                                    <span class="mediumBold aqua mediumBold">$14</span>
                                </td>
                            </tr>
                        </table>
                    </div> --}}
                </div>
                <div class="dsidecart radiusTop">
                    <div class="contactPhonesCart">
                        <div class="centerForm">
                            NORTH AMERICA:    +1 888.869.9494<br>
                            INTERNATIONAL:     +1 949.777.6340
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="theSideCartWrap changeMtop">
                        <div class="MyCart2">ORDER TOTAL: &nbsp; <span class="aqua">$194</span></div>
                        <div class="sideCartLine">
                            <div class="aquaBtn">PLACE ORDER NOW</div>
                        </div>
                        <div class="clear"></div>
                        <div class="bottomSideCart hide">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Aenean a leo eu tellus ultricies pretium ac eget purus. Proin eu diam dignissim.
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@stop
