<div class="row">
    <div class="logo col-md-7">
        @if(isset($white_site) && $white_site->logo != "")
            <a href="#">
                <img src="/whitesite_logos/{{ $white_site->logo }}" width="279" height="55" border="0" alt="Alliance Virtual Offices">
            </a>
        @endif
    </div>
    <div class="menu col-md-5">
        <div class="item">
            <a class="@if(Request::is('*live-receptionist*')) active @endif" href="{!! URL::action('LiveReceptionistsController@index') !!}">LIVE RECEPTIONISTS</a>
        </div>
        @if(isset($white_site))
            @if($white_site->meeting_rooms_offers)
                <div class="item">
                    <a class="@if(Request::is('*meeting-rooms*')) active @endif" href="{!! URL::action('MeetingRoomsController@index') !!}">MEETING ROOMS</a>
                </div>
            @endif
            @if($white_site->virtual_offices_offers)
                <div class="item">
                    <a class="@if(Request::is('*virtual-offices*')) active @endif" href="/white-site/{{ $white_site->id }}/virtual-offices-introduction">VIRTUAL OFFICES</a>
                </div>
            @endif                
        @endif
        <div class="item">
            <a class="@if(Request::is('*home*')) active @endif" href="">HOME</a>
        </div>
        <br>
        <div class="call-us">CALL US AT:   (213) 377-5770</div>
    </div>    
</div>