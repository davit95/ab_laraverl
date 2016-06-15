<table id="dataTable" class="display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="reportsT_info" style="width: 100%;">
{{-- <table class="table table-striped table-bordered table-hover" id="centers-table"> --}}

<thead>
    <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Center ID: activate to sort column descending" style="width: 45px;">ID</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="Operator Name: activate to sort column ascending" style="width: 183px;">Users's Name</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="Street: activate to sort column ascending" style="width: 125px;">User's Email</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="City: activate to sort column ascending" style="width: 64px;">User's Phone</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="State: activate to sort column ascending" style="width: 35px;">User's Address</th>        
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="State: activate to sort column ascending" style="width: 35px;">Postal Code</th>        
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="State: activate to sort column ascending" style="width: 35px;">Actions</th>        
    </tr>
</thead>
    <tbody>
        @forelse( $users as $user )
            @include('admin.users.parts._user-item-index')
        @empty
            @include('alerts.no-data-table')
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <th rowspan="1" colspan="1">ID</th>
        <th rowspan="1" colspan="1">User's Name</th>
        <th rowspan="1" colspan="1">User's Email</th>
        <th rowspan="1" colspan="1">User's Phone</th>
        <th rowspan="1" colspan="1">User's Address</th>
        <th rowspan="1" colspan="1">Postal Code</th> 
        <th rowspan="1" colspan="1">Actions</th> 
    </tr>
    </tfoot>
</table>
    
@section('styles')

    <link href="/admin_assets/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="/admin_assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- <link href="/admin_assets/admin/css/custom.css" rel="stylesheet"> -->
@stop
@section('scripts')
    <script src="/admin_assets/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="/admin_assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="/admin_assets/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="/admin_assets/admin/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#dataTable').DataTable();
            $('.tooltip-demo').tooltip({
                selector: "[data-toggle=tooltip]",
                container: "body"
            });
            $("[data-toggle=popover]").popover();
            $('#dataTable_paginate').css('display', 'none');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete-owner').click(function() {
                $(this).parent().submit();
            });
        });
    </script>
@stop