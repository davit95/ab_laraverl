<tr role="row" class="odd">
    <td><a  href="{{ url('invoices/'.$invoice->id) }}">{{ $invoice->id }}</a></td>    
    <td>{{$invoice->created_at}}</td>
    <td></td>
    <td><a href="{{ url('customers/'.$invoice->customer->id) }}">{{$invoice->customer->first_name}}</a></td>
    <td>step 1</td>
    <td></td>
    <td></td>
    <td>DMITRY</td>
</tr>

