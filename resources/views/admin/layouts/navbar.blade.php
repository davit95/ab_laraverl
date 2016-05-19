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

<div class="logo"><a href="{{ url('reports') }}"><img src="/admin_assets/admin/images/admin_logo.png" width="200" height="62" border="0"></a></div>
<div class="mobileMenu"></div>
<div class="menu">
    <div class="dropD_header">
        <div class="sSelectWrap1">
            <div class="sSelectWrap2">
                <select id="BPSelectDD">
                    <option selected="" value="reports">CONTROL PANEL</option>
                    <option class="csr" value="csr">CSR</option>
                    <option>OWNER CP</option>
                    <option>CLIENT CP</option>
                </select>
            </div> 
        </div> 
    </div> 
    <a href="{{ url('reports') }}" class="nd">
        <div class="menu_btn @if(Request::is('reports*')) menu_active @endif">
            <div class="@if(Request::is('reports*')) menu_btnL1_a @else menu_btnL1 @endif"></div>
            <div class="menu_btnR lh_menu">REPORTS</div>
        </div>
    </a>
    <a href="{{ url('centers') }}" class="nd">
        <div class="menu_btn @if(Request::is('owners*')) || Request::is('centers*')) menu_active @endif">
            <div class="@if(Request::is('owners*')) || Request::is('centers*')) menu_btnL2_a @else menu_btnL2 @endif"></div>
            <div class="menu_btnR m_menu">OWNERS<br>&amp; CENTERS</div>
        </div>
    </a>
    <a href="{{ url('users') }}" class="nd">
        <div <div class="menu_btn @if(Request::is('users*')) menu_active @endif">
            <div class="@if(Request::is('users*')) menu_btnL3_a @else menu_btnL3 @endif"></div>
            <div class="menu_btnR m_menu">ACCOUNTS<br>&amp; USERS</div>
        </div> 
    </a>
    <a href="{{ url('logout') }}" class="nd">
        <div class="menu_btn lh_menu grayMenu">LOGOUT</div> 
    </a>
</div> 
<script type="text/javascript">
   $( "#BPSelectDD" ).change(function() {
        //var hostname;
        //hostname = window.location.hostname;
        //console.log(hostname);
        var page =  $("#BPSelectDD option:selected").val().toLowerCase();
        var url = 'http://admin.abcn.dev'  + '/' + page;
        //alert(url)
        window.location.replace(url);
    });
</script>
