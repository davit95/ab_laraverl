<table class="table table-striped table-bordered table-hover" id="reports-table">
    <thead>
        <tr>
            <th>Owner ID</th>
            <th>Locations</th>
            <th>Company</th>
            <th>Owner Name</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $reports as $report )
            <tr class="odd gradeX">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @empty
            @include('alerts.no-data-table')
        @endforelse
    </tbody>
</table>