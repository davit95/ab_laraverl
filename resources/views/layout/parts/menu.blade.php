<div class="headMenu">
    <div class="logo">
        <a href="{!! URL::action('HomeController@index')!!}">
            <img src="/images/AVOlogo.png" width="279" height="55" border="0" alt="Alliance Virtual Offices">
        </a>
    </div>
    @if( !empty($currencies) )
        {!! Form::open(['url' => url('change-currency'), 'method' => 'GET', 'class' => 'currencyMenu']) !!}
            <select class="currency-select" name="currency">
                @foreach($currencies as $currency)
                     {{ var_dump($currency->name, session('currency')) }}
                    <option data-img-src="{{ url('/images/currencies/'.$currency->image) }}" value="{{ $currency->name }}" @if(session('currency.name') == $currency->name ) selected="selected" @endif><span class="light">&nbsp;{{ $currency->symbol }}</span></option>
                @endforeach
            </select>
        {!! Form::close() !!}
    @endif
    <a href="#" class="menuBtnLink"><div class="menuBtn"></div></a>
    <div class="menu">
        <div class="btnMenu"><a class="@if(Request::is('virtual-offices*')) active @endif" href="{!! URL::action('VirtualOfficesController@index') !!}">VIRTUAL OFFICES</a></div>
        <div class="btnMenu"><a class="@if(Request::is('meeting-rooms*')) active @endif" href="{!! URL::action('MeetingRoomsController@index') !!}">MEETING ROOMS</a></div>
        <div class="btnMenu"><a class="@if(Request::is('live-receptionist*')) active @endif" href="{!! URL::action('AvoPagesController@liveReceptionist') !!}">LIVE RECEPTIONISTS</a></div>
        <div class="btnMenu"><a href="/login.php"><span class="light">Login</span></a></div>
        <div class="btnMenu"><a class="@if(Request::is('contact*')) active @endif" href="{!! URL::action('AvoPagesController@contact') !!}"><span class="light">Contact</span></a></div>
        <div class="btnMenu"><a class="@if(Request::is('cart*')) active @endif" href="{!! URL::action('CartController@index') !!}"><span class="orange">CART</span><img src="/images/cart-icon.png" class="cartIcon" border="0" width="23" height="23"></a></div>
    </div>
</div>