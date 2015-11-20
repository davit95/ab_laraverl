<table class="table table-striped table-bordered table-hover" id="owners-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Owner's Name</th>
            <th>Website URL</th>
            <th>Email</th>
            <th class="action">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $owners as $owner )
            @include('admin.owners.parts._owner-item-index')
        @empty
            @include('alerts.no-data-table')
        @endforelse
    </tbody>
</table>
<div class="pull-right">
    {!! $owners->render() !!}
</div>
@section('styles')

    <link href="/admin_assets/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="/admin_assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/admin_assets/admin/css/custom.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="/admin_assets/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="/admin_assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="/admin_assets/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="/admin_assets/admin/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.tooltip-demo').tooltip({
                selector: "[data-toggle=tooltip]",
                container: "body"
            });
            $("[data-toggle=popover]").popover();
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