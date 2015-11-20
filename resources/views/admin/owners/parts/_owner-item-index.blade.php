<tr class="odd gradeX">
    <th><a href="{{ url('owners/'.$owner->id) }}">{{ $owner->id }}</a></th>
    <th>{{ $owner->company_name }}</th>
    <th>{{ $owner->name }}</th>
    <th><a href="{{ $owner->url }}" target="_blank">{{ $owner->url }}</a></th>
    <th>{{ $owner->email }}</th>
    <th class="tooltip-demo">
        {!! Form::open([ 'url' => url('owners/'.$owner->id), 'method' => 'DELETE' ]) !!}
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="View Owner" href="{{ url('owners/'.$owner->id) }}"><i class="fa fa-eye"></i></a>
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="Edit Owner" href="{{ url('owners/'.$owner->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            <a class="action-icon delete-owner" data-toggle="tooltip" data-placement="top" title="Delete Owner" href='#'><i class="fa fa-close"></i></a>
        {!! Form::close() !!}
    </th>
</tr>