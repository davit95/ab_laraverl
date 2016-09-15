
<tr role="row" class="odd">
    <td>{{$invoice->id}}</td>    
    <td>{{date_format($invoice->created_at, 'j/m/y')}}</td>
    <td>{{$invoice->status == 'approved' ? 'CC' : 'Decline'}}</td>
    <td>{{$invoice->id}}</td>
    <td>{{date_format($invoice->created_at, 'j/m/y')}}</td>
    <td>${{$invoice->price}}</td>
    <td>-$</td>
</tr>