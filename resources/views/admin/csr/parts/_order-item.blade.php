<tr role="row" class="odd">
    <td><a  href="{{ url('invoices/'.$invoice->id) }}">{{ $invoice->id }}</a></td>    
    <td>{{$invoice->created_at}}</td>
    <td>{{$invoice->type}}</td>
    <td><a href="{{ url('customers/'.$invoice->customer->id) }}">{{$invoice->customer->first_name}}</a></td>
    <td>
    	@if(in_array($invoice->id, $new_invoices_ids))
    		new
		@else
    		step 1
    	@endif
    </td>
    <td></td>
    <td></td>
    <td>DMITRY</td>
</tr>

