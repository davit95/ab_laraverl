@extends('layout.layout')

@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

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
                        <div class="MyCart2">ORDER TOTAL: &nbsp; <span class="aqua">{!! session('currency.symbol') !!}{{ round($price_total*session('rate'), 2) }}</span></div>
                        <div class="sideCartLine">
                            <a style="text-decoration:none;" href="{{ url('customer-information') }}">
                                <div class="aquaBtn">PLACE ORDER NOW</div>
                            </a>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete-item').click(function() {
                if(confirm('Are you sure you want to delete this Item?')){
                    $(this).parent().submit();
                }
                return false;
            });
        });
    </script>
@stop