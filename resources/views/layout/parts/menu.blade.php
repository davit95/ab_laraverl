<div class="headMenu">
    <div class="logo">
        <a href="{!! URL::action('HomeController@index')!!}">
            <img src="/images/AVOlogo.png" width="279" height="55" border="0" alt="Alliance Virtual Offices">
        </a>
    </div>
    <a href="#" class="menuBtnLink"><div class="menuBtn"></div></a>
    <div class="menu">
        <div class="btnMenu"><a class="@if(Request::is('virtual-offices*')) active @endif" href="{!! URL::action('VirtualOfficesController@index') !!}">VIRTUAL OFFICES</a></div>
        <div class="btnMenu"><a class="@if(Request::is('meeting-rooms*')) active @endif" href="{!! URL::action('MeetingRoomsController@index') !!}">MEETING ROOMS</a></div>
        <div class="btnMenu"><a class="@if(Request::is('live-receptionist*')) active @endif" href="{!! URL::action('AvoPagesController@liveReceptionist') !!}">LIVE RECEPTIONISTS</a></div>
        <div class="btnMenu"><a href="/login.php"><span class="light">Login</span></a></div>
        <div class="btnMenu"><a class="@if(Request::is('contact*')) active @endif" href="{!! URL::action('AvoPagesController@contact') !!}"><span class="light">Contact</span></a></div>
        <div class="btnMenu"><a href="/cart.php"><span class="orange">CART</span><img src="/images/cart-icon.png" class="cartIcon" border="0" width="23" height="23"></a></div>
    </div>
</div>