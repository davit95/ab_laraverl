<tr role="row" class="odd">
    <td><a href="{{ url('owners/'.$owner->id) }}">{{ $owner->id }}</a></td>    
    <td>{{ $owner->company_name }}</td>
    <td>{{ $owner->name }}</td>
    <td><a href="{{ $owner->url }}" target="_blank">{{ $owner->url }}</a></td>
    <td>{{ $owner->email }}</td>
    <td class="tooltip-demo">
        {!! Form::open([ 'url' => url('owners/'.$owner->id), 'method' => 'DELETE' ]) !!}
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="View Owner" href="{{ url('owners/'.$owner->id) }}"><i class="fa fa-eye"></i></a>
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="Edit Owner" href="{{ url('owners/'.$owner->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            <!-- <a class="action-icon delete-owner" type="submit" data-toggle="tooltip" data-placement="top" title="Delete Owner" style="cursor: pointer"><i class="fa fa-close"></i></a> -->
            <!-- {!! Form::submit('delete', array('class'=>'action-icon delete-owner')) !!} -->
            <button type="submit" class="action-icon delete-owner" data-toggle="tooltip" data-placement="top" title="Delete Owner">
                <i class="fa fa-close"></i>
            </button>
        {!! Form::close() !!}
    </td>
</tr>