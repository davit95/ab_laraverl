{{-- <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ url('logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul> --}}

<div class="logo"><img src="/admin_assets/admin/images/admin_logo.png" width="200" height="62" border="0"></div>
<div class="mobileMenu"></div>
<div class="menu">
    <!-- <div class="dropD_header">
        <div class="sSelectWrap1">
            <div class="sSelectWrap2">
                <select id="BPSelectDD">
                    <option selected="">CSR</a></option>
                    <option>CONTROL PANEL</option>
                    <option>OWNER CP</option>
                    <option>CLIENT CP</option>
                </select>
            </div> 
        </div> 
    </div> --> 
    <a href="{{ url('/csr') }}" class="nd">
        <div class="menu_btn @if(Request::is('csr-home*')) menu_active @endif">
            <div class="@if(Request::is('csr-home*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">CSR HOME</div>
        </div> 
    </a>
    <a href="{{ url('/csr-accounting') }}" class="nd">
        <div class="menu_btn @if(Request::is('csr-accounting*')) || Request::is('csr-accounting*')) menu_active @endif">
            <div class="@if(Request::is('csr-accounting*')) || Request::is('csr-accounting*')) menu_btnL2_a @endif"></div>
            <div class="menu_btnR lh_menu">ACCOUNTING</div>
        </div>
    </a>
    <a href="{{ '//'.env('DOMAIN', 'http://admin.abcn.com/').'/virtual-offices' }}" class="nd">
        <div class="menu_btn @if(Request::is('locations*')) menu_active @endif">
            <div class="@if(Request::is('locations*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">LOCATIONS</div>
        </div>
    </a>
    <a target="_blank" href="{{ '//'.env('DOMAIN', 'http://admin.abcn.com/').'/login' }}" class="nd">
        <div class="menu_btn @if(Request::is('customer-login*')) menu_active @endif">
            <div class="@if(Request::is('customer-login*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">CUSTOMER-LOGIN</div>
        </div>
    </a>
    <a href="{{ url('/csr-exit-interview') }}" class="nd">
        <div class="menu_btn @if(Request::is('exit-interview*')) menu_active @endif">
            <div class="@if(Request::is('exit-interview*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">EXIT INTERVIEW</div>
        </div> 
    </a>
</div> 
