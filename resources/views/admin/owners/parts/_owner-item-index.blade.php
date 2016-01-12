<tr role="row" class="odd">
    <td><a href="{{ url('owners/'.$owner->id) }}">{{ $owner->id }}</a></td>    
    <td>{{ $owner->company_name }}</td>
    <td>{{ $owner->name }}</td>
    <td><a href="{{ $owner->url }}" target="_blank">{{ $owner->url }}</a></td>
    <td>{{ $owner->email }}</td>
    <td class="tooltip-demo">
        {!! Form::open([ 'url' => url('owners/'.$owner->id), 'metdod' => 'DELETE' ]) !!}
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="View Owner" href="{{ url('owners/'.$owner->id) }}"><i class="fa fa-eye"></i></a>
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="Edit Owner" href="{{ url('owners/'.$owner->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            <a class="action-icon delete-owner" data-toggle="tooltip" data-placement="top" title="Delete Owner" href='#'><i class="fa fa-close"></i></a>
        {!! Form::close() !!}
    </td>
</tr>