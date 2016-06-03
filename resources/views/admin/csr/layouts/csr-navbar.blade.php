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
 
<div class="logo"><a href="{{ url('csr') }}"><img src="/admin_assets/admin/images/admin_logo.png" width="200" height="62" border="0"></a></div>
<div class="mobileMenu"></div>
<div class="menu">
    @if(isset($role) && $role !== 'client_user')
        <div class="dropD_header">
            <div class="sSelectWrap1">
                <div class="sSelectWrap2">
                    <select id="BPSelectDD">
                        <option selected="" value="csr" class="csr">CSR</option>
                        <option value="reports">CONTROL PANEL</option>
                    </select>
                </div> 
            </div>
        </div>
        <a href="{{ url('/csr-accounting') }}" class="nd">
            <div class="menu_btn @if(Request::is('csr-accounting*')) || Request::is('csr-accounting*')) menu_active @endif">
                <div class="@if(Request::is('csr-accounting*')) || Request::is('csr-accounting*')) menu_btnL2_a @endif"></div>
                <div class="menu_btnR lh_menu">ACCOUNTING</div>
            </div>
        </a>
    @endif
    <a href="{{ '//'.env('DOMAIN', 'admin.abcn.com').'/virtual-offices' }}" class="nd">
        <div class="menu_btn @if(Request::is('locations*')) menu_active @endif">
            <div class="@if(Request::is('locations*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">LOCATIONS</div>
        </div>
    </a>
    <a target="_blank" href="{{ '//'.env('DOMAIN', 'admin.abcn.com').'/login' }}" class="nd">
        <div class="menu_btn @if(Request::is('customer-login*')) menu_active @endif">
            <div class="@if(Request::is('customer-login*')) menu_btnL1_a  @endif"></div>
            <div class="menu_btnR lh_menu">CUSTOMER-LOGIN</div>
        </div>
    </a>
    @if(isset($role) && $role !== 'client_user')
        <a target="_blank" href="{{ url('/admin-users') }}" class="nd">
            <div class="menu_btn @if(Request::is('customer-login*')) menu_active @endif">
                <div class="@if(Request::is('customer-login*')) menu_btnL1_a  @endif"></div>
                <div class="menu_btnR lh_menu">ADD ALLIANCE CSR</div>
            </div>
        </a>
        <a href="{{ url('/csr-exit-interview') }}" class="nd">
            <div class="menu_btn @if(Request::is('exit-interview*')) menu_active @endif">
                <div class="@if(Request::is('exit-interview*')) menu_btnL1_a  @endif"></div>
                <div class="menu_btnR lh_menu">EXIT INTERVIEW</div>
            </div> 
        </a>
    @endif
    <a href="{{ url('logout') }}" class="nd">
        <div class="menu_btn lh_menu grayMenu">LOGOUT</div> 
    </a>
</div> 
<script type="text/javascript">
   $( "#BPSelectDD" ).change(function() {
        //var hostname;
        //hostname = window.location.hostname;
        var page =  $("#BPSelectDD option:selected").val().toLowerCase();
        var url = 'http://admin.abcn.com'  + '/' + page;
        //alert(page);
        window.location.replace(url);
    });
</script>
