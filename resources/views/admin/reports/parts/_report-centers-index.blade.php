<table class="table table-striped table-bordered table-hover" id="reports-table">
    <thead>
        <tr>
            <th>Center ID</th>
            <th>Operator Name</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Platinum Price</th>
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
                <td></td>
            </tr>
        @empty
            @include('alerts.no-data-table')
        @endforelse
    </tbody>
</table>