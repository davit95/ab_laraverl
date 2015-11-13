<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a @if(Request::is('/'))  class="active" @endif href="{{ url('/') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a @if(Request::is('reports'))  class="active" @endif href="{{ url('reports') }}"><i class="fa fa-fw fa-file-text"></i> Reports</a>
            </li>
            <li>
                <a @if(Request::is('owners'))  class="active" @endif href="{{ url('owners') }}"><i class="fa fa-fw fa-user"></i> Owners & Centers</a>
            </li>
            <li>
                <a @if(Request::is('users'))  class="active" @endif href="{{ url('users') }}"><i class="fa fa-fw fa-users"></i> Users</a>
            </li>
        </ul>
    </div>
</div>