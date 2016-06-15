<tr role="row" class="odd">
    <td><a href="{{ url('users/'.$user->id) }}">{{ $user->id }}</a></td>    
    <td>{{ $user->first_name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone }}</td>
    <td>{{ $user->address1 }}</td>
    <td>{{ $user->postal_code }}</td>
    <td class="tooltip-demo">
        {!! Form::open([ 'url' => url('centers/'.$user->id), 'method' => 'DELETE' ]) !!}
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="View Owner" href="{{ url('users/'.$user->id) }}"><i class="fa fa-eye"></i></a>
            <a class="action-icon" data-toggle="tooltip" data-placement="top" title="Edit Owner" href="{{ url('users/'.$user->id.'/edit') }}"><i class="fa fa-edit"></i></a>
            <button type="submit" class="action-icon delete-owner" data-toggle="tooltip" data-placement="top" title="Delete Center">
                <i class="fa fa-close"></i>
            </button>
        {!! Form::close() !!}
    </td>
</tr>