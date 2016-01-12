<!DOCTYPE html>
<html lang="en">

<head>

    <title>ABCN Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="/admin_assets/admin/css/abcnCom_style.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/jquery-ui.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/nice_select.css" rel="stylesheet">
    
    <link href="/admin_assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/admin_assets/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/admin_assets/admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin_assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/admin_assets/admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin_assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/admin_assets/admin/css/custom.css">
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
    {{-- <div class="container"> --}}

        <!-- Navigation -->
        <div class="header">        
            @include('admin.layouts.navbar')
        </div>
        <div class="content_wrapper">
            <div class="content_top">
                @yield('content_top')
            </div>
            <div class="content_wrapp2">
                @yield('content')
            </div>
        </div>
        <div class="abcnfooter">©2016 Alliance Business Centers Network. All rights reserved.</div>          
    </div>
    <script type="text/javascript">
        // if($('body').height()>$(window).height()){
        //    $('.abcnft').addClass('abcnfooter')  
        //    console.log('ASD');           
        // }else{
        //     console.log('zxc');
        //     $('.abcnft').addClass('abcnfooterPosition')             
        // }
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script type='text/javascript' src="/admin_assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/admin_assets/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    @yield('scripts')

</body>

</html>
