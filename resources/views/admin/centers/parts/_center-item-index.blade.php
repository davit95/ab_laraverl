<tr role="row" class="odd">
    <td><a href="{{ url('centers/'.$center->id) }}">{{ $center->id }}</a></td>    
    <td>{{ $center->name }}</td>
    <td>{{ $center->slug }}</td>
    <td>{{ $center->city_name }}</td>
    <td>{{ $center->country }}</td>
    <td class="tooltip-demo">
        {!! Form::open([ 'url' => url('centers/'.$center->id), 'method' => 'DELETE' ]) !!}
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="View Owner" href="{{ url('centers/'.$center->id) }}"><i class="fa fa-eye"></i></a>
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="Edit Owner" href="{{ url('centers/'.$center->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            <button type="submit" class="action-icon delete-owner" data-toggle="tooltip" data-placement="top" title="Delete Center">
                <i class="fa fa-close"></i>
            </button>
        {!! Form::close() !!}
    </td>
</tr>