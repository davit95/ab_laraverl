<!DOCTYPE html>
<html lang="en">

<head>

    <title>White Site</title>

    <!-- Bootstrap Core CSS -->    
    <link href="/admin_assets/admin/css/jquery-ui.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/nice_select.css" rel="stylesheet">
    
    <link href="/admin_assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    

    <!-- Morris Charts CSS -->
    <link href="/admin_assets/admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin_assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
    <link rel="stylesheet" href="/css/white-site.css">
    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script type='text/javascript' src="/admin_assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js"></script> --}}
    <script type='text/javascript' src="/admin_assets/admin/js/jquery.dataTables.min.js"></script>
    <script type='text/javascript' src="/admin_assets/admin/js/nice_select.min.js"></script>
</head>

<body>

    <div id="wrapper">    

        <!-- Navigation -->
        <div class="header col-md-12">        
            @include('white-site.layouts.header')
        </div>
        <div class="content_wrapper">            
            <div class="content_wrapp2">
                @yield('content')
            </div>
        </div>
        <div class="col-md-12 footer"><div class="content">©2016 All rights reserved.</div></div>
    </div>   
    <!-- Bootstrap Core JavaScript -->
    <script type='text/javascript' src="/admin_assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    @yield('scripts')

</body>

</html>
