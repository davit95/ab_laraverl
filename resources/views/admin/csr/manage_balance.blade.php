@extends('admin.csr.layouts.layout')
    
@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
        <div class="w_box view_box paddin_left_content" style="width:90%; background: #F4F4F4; overflow:hidden; ">
        	<div class="pull-left"  style="width: 35%;">
        		<div class="formOinfo left_side_area_content manage_balance_order" >
					 <span class="lh_fi mediumBold customer_text_area_headers pull-left">
                		Customer Information:
            		</span>&nbsp;
            		<br>	
						<span class="costumer_text_area">ABCN</span>
					<br>
					<span class="costumer_text_area">{{$customer->first_name}}  {{$customer->last_name}}</span>
					<br>
					<span class="costumer_text_area">{{$customer->address1}}</span>
					<br>
					<br>
					<span class="costumer_text_area">{{$customer->address2}}</span>
					<br>
					<span class="costumer_text_area">{{$customer->phone}}</span>
					<br>
					<span class="costumer_text_area">{{$customer->email}}</span>
					<br>
					<br>
					<a href="#" target="V" class="customer_text_area_links"><img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/eye2.png"> View this customer's Admin area</a>
					<br><a href="#" class="customer_text_area_links"><img class="icon" width="16" height="16" src="https://www.alliancevirtualoffices.com/csr/images/pencil.png" alt="Edit" title="Edit"> Edit Customer's Info</a><br>
				</div>
        	</div>
        	<div class="pull-right" style="width:55%; text-align:left">
        		<div class="test2">
				<div>
				 <span class="lh_fi mediumBold customer_text_area_headers pull-left">
                	Balance History  
            	</span>&nbsp;
				<table border="0" cellspacing="3" cellpadding="3" class="table" >
					<thead>
						<tr>
							<th width="100"><strong>ID #</strong></th>
							<th width="100"><strong>Action Date</strong></th>
							<th width="150"><strong>Type</strong></th>
							<th width="110"><strong>Invoice #</strong></th>
							<th width="100"><strong>Invoice<br>Date</strong></th>
							<th width="155"><strong>Amount</strong></th>
							<th width="130"><strong>Balance</strong></th>
						</tr> 
					</thead>
					<tbody>
						@forelse( $invoices as $invoice )
						    @include('admin.csr.parts._manage_balanse_item')
						@empty
						    
						@endforelse
					</tbody>
				</table></div>
				<br style="clear: both;">
				<span class="lh_fi mediumBold customer_text_area_headers pull-left">
                	Customer Balance Info 
            	</span>&nbsp;
				<table border="0" cellspacing="5" cellpadding="5" width="100%">
					<tbody>
						<tr>
							<td width="130">
								<span class="costumer_text_area">Current Balance:</span>
							</td>
							<td>
								<span class="costumer_text_area">
									$ {{$customer_balance_amount}}
								</span>
							</td>
						</tr>
					<tr>
						<td>
							<span class="costumer_text_area">Last Change Date:</span>
						</td>
						<td>
							<span class="costumer_text_area">
								{{($balance_change_date != '') ? date_format($balance_change_date, 'j/m/y') : 'N/A'}}
							</span>
						</td>
					</tr>
					</tbody>
				</table>
				<br>
				{!! Form::open(['method' => 'post' , 'url' => '/customers/'.$customer->id.'/add-balance']) !!}
					<span class="lh_fi mediumBold customer_text_area_headers pull-left">
	                	Receive Payment
	            	</span>&nbsp;
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tbody>
							<tr>
								<td width="130">
									<span class="costumer_text_area">Amount:</span>
								</td>
								<td class="table_text_align">
									{!! Form::text('amount', null, ['class' => 'manage_balance_inputs', 'id' => 'Amount'])!!}
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Type:</span>
								</td>
								<td class="table_text_align">
									{!! Form::select('type',$balance_types, null, [ 'class' => 'customer_text_area_selects']) !!}
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Check or Wire Number/ID:</span>
								</td>
								<td class="table_text_align">
									{!! Form::text('id', null, ['class' => 'manage_balance_inputs', 'id' => 'ID'])!!}
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Received on date:</span>
								</td>
								<td class="table_text_align">
									{!! Form::select('year',$years, null, [ 'class' => 'customer_text_area_selects', 'id' => 'year']) !!}
									{!! Form::select('month',$months, null, [ 'class' => 'customer_text_area_selects', 'id' => 'month']) !!}
									{!! Form::select('day',$days, null, [ 'class' => 'customer_text_area_selects', 'id' => 'day']) !!}
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Notes:</span>
								</td>
								<td class="table_text_align">
									{!! Form::textarea('notes', null,['class' => 'manage_balance_inputs', 'id' => 'Notes', 'cols' => '25', 'rows' => '5']) !!}
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td class="table_text_align">
									{!! Form::submit('Submit', array('class'=>'customer_text_area_button')) !!}
								</td>
							</tr>
						</tbody>
					</table>
				{!! Form::close() !!}
				<br><br>
				@if($customer_balance_amount > 0)
					{!! Form::open(['method' => 'post' , 'url' => '/manage-invoice-from-balance']) !!}
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tbody>
								<tr>
									<td width="130" class="costumer_text_area">Amount Available:</td>
									<td class="costumer_text_area">$ {{$customer_balance_amount}}</td>
								</tr>
								<tr>
									<td width="130">
										<span class="costumer_text_area">
											Amount to assign:
										</span>
									</td>
									<td class="table_text_align">
										{!! Form::text('amount', null, ['class' => 'manage_balance_inputs'])!!}
									</td>
								</tr>
								<tr>
									<td>
										<span class="costumer_text_area">
											Invoice to be changed:
										</span>
									</td>
									<td class="table_text_align">
										<select name="invoice_id" class="customer_text_area_selects"> 
											<option value="{{$last_pending_invoice->id}}">
												{{$last_pending_invoice->id}} ({{date_format($balance_change_date, 'M d, Y')}})
											</option> 
											<option value="{{$next_invoice->id}}">
												{{$next_invoice->id}} (Next Invoice)
											</option> 
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<span class="costumer_text_area">
											Entered on date:
										</span>
									</td>
									<td>
										{!! Form::select('year',$years, null, [ 'class' => 'customer_text_area_selects']) !!}
										{!! Form::select('month',$months, null, [ 'class' => 'customer_text_area_selects']) !!}
										{!! Form::select('day',$days, null, [ 'class' => 'customer_text_area_selects']) !!}
									</td>
								</tr>
								<tr>
									<td>
										<span class="costumer_text_area">
											Notes:
										</span>
									</td>
									<td>
										{!! Form::textarea('notes', null,['class' => 'manage_balance_inputs', 'cols' => '25', 'rows' => '5']) !!}
									</td>
								</tr>
								<tr>
									<td>
										<span class="costumer_text_area">
											Clear declined status?
										</span>
									</td>
									<td>
										{!! Form::checkbox('remove_from_declined', 'yes', null, ['class' => 'manage_balance_inputs']) !!}
										{!! Form::hidden('customer_id', $customer->id, []) !!}    
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td class="table_text_align">
										{!! Form::submit('Submit', array('class'=>'customer_text_area_button')) !!}
									</td>
								</tr>
							</tbody>
						</table>
					{!! Form::close() !!}
				@endif
				<br><br>
				<a href=""  style="color: #369 !important;">Go to this Customer's Account Information Page</a>
			</div>
		</div>
		<div class="bBox_btns">       
		    <div class="edit_oBtn bordL">
	    		<a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink">
	        		<div class="sBox_icons edit_green"></div>edit customer's info
	        	</a>
		    </div>
		    <div class="clear"></div>
		</div>
	</div>
</div>
@stop

