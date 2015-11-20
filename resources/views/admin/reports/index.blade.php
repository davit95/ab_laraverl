@extends('admin.layouts.layout')

@section('page-header')
	Reports
@stop

@section('content')
    @include('admin.reports.parts._filter')
    <div class="row">
        <div class="col-lg-12">
            <div class="dataTable_wrapper">
                @if(!Request::has('type') || Request::get('type') == 'centers')
                    @include('admin.reports.parts._report-centers-index')
                @else
                    @include('admin.reports.parts._report-owners-index')
                @endif
            </div>
        </div>
    </div>
@stop

@section('styles')
    <link href="/admin_assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/admin_assets/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <link href="/admin_assets/admin/bower_components/bootstrap/bootstrap-daterangepicker-master/daterangepicker.css" rel="stylesheet">

    <link href="/admin_assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="/admin_assets/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="/admin_assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="/admin_assets/admin/bower_components/bootstrap/bootstrap-daterangepicker-master/moment.min.js"></script>

    <script src="/admin_assets/admin/bower_components/bootstrap/bootstrap-daterangepicker-master/daterangepicker.js"></script>

    <script type="text/javascript">
        $(function() {

            function cb(start, end) {
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
            }
            //cb(moment().subtract(29, 'days'), moment());

            $('#reportrange').daterangepicker({
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            $('#report-type, #activity').click(function(){
                $(this).parents('form').submit();
            });

        });
    </script>
@stop