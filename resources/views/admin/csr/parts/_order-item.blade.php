<tr role="row" class="odd">
    <td><a  href="{{ url('orders/'.$customer->id) }}">{{ $customer->id }}</a></td>    
    <td>{{$customer->created_at}}</td>
    <td></td>
    <td><a href="{{ url('customers/'.$customer->first_name.'/'.$customer->id) }}">{{$customer->first_name}}</a></td>
    <td>step 1</td>
    <td></td>
    <td></td>
    <td>DMITRY</td>
</tr>

