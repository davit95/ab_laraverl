<div class="w_box view_box" style="width:100%">

    <div class="form_left" style="width: 40%">
    	<div class="line" style="text-align: left; padding-left: 50px;">
    	    <span class="lh_fi mediumBold">
    	        <strong>Customer Information:</strong></span>&nbsp;
    	    <div class="formOinfo" style="float: initial;">
    	    <br>
    	    <p>
    	        {{$customer->first_name}} {{$customer->last_name}}<br>
    	        {{$customer->address1}}<br>
    	        <br>
    	        {{$customer->city}}, {{$customer->country}} {{$customer->postal_code}} <br>
    	        {{$customer->email}} <br>
    	        Customer Type: AVO Direct <br>
    	    </p>
    	    </div>
    	</div>   
    </div>
    <div class="form_right" style="width: 60%; padding-right:10px">
     <table class="table">
         <thead>
           <tr>
             <th style="width: 14%">ID #</th>
             <th style="width: 14%">Action Date</th>
             <th style="width: 14%">Type</th>
             <th style="width: 14%">Invoice</th>
             <th style="width: 14%">Invoice Date</th>
             <th style="width: 14%">Amount</th>
             <th style="width: 16%">Balance</th>
           </tr>
         </thead>
         <tbody>
           @forelse( $customer as $customer_balance )
               @include('admin.csr.parts._customer-balance-item')
           @empty
               @include('alerts.no-data-table')
           @endforelse
         </tbody>
       </table>
    </div> 
    
    <div class="bBox_btns">
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
