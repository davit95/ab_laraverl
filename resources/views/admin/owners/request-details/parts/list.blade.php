<table id="dataTable" class="display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="reportsT_info" style="width: 100%;">
{{-- <table class="table table-striped table-bordered table-hover" id="owners-table"> --}}
<thead>
    <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Center Name: activate to sort column descending" style="width: 15%;">Center Name</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="I Whould Like To: activate to sort column ascending" style="width: 15%;">I Whould Like To</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" aria-label="Notes: activate to sort column ascending" style="width: 15%;">Notes</th>
        <th class="sorting" tabindex="0" aria-controls="reportsT" rowspan="1" colspan="1" style="width: 15%;">Action</th>
    </tr>
</thead>
    <tbody>
        @forelse( $requestDetails as $detail )
            @include('admin.owners.request-details.parts.item')
        @empty
            @include('alerts.no-data-table')
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <th rowspan="1" colspan="1">Center Name</th>
        <th rowspan="1" colspan="1">I Whould Like To</th>
        <th rowspan="1" colspan="1">Notes</th>
        <th rowspan="1" colspan="1">Action</th>
    </tr>
    </tfoot>
</table>
{!! $requestDetails->render() !!}