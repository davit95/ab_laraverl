
<tr role="row" class="odd">
    <td><input type="checkbox" checked = "true" style="margin-right:10px"> <a href="#">{{$invoice->customer->first_name}} {{$invoice->customer->last_name}}</a></td>    
    <td><a href="#">{{$invoice->id}}</a></td>
    <td><a href="#">{{$invoice->id}}</a><br>${{$invoice->price}}<br>{{date_format($invoice->created_at,'M m, Y')}}</td>
    <td>${{$invoice->price}}</td>
    <td>{{isset(unserialize($invoice->serialized_card_item_info)['product']) ? unserialize($invoice->serialized_card_item_info)['product']->address1 : ''}}</td>
    <td>{{isset(unserialize($invoice->serialized_card_item_info)['product']) ? unserialize($invoice->serialized_card_item_info)['product']->company_name : ''}}</td>
</tr>