@extends('admin.csr.layouts.layout')
    
@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
        <div class="w_box view_box paddin_left_content" style="width:90%; background: #F4F4F4; height:100%; ">
        	<div align="center">
        		<div style="width: 100%; margin: 0 auto;">
				<div style="width: 300px; margin: 0 auto 15px auto; font-weight: bold;"	>
					<span class="lh_fi mediumBold customer_text_area_headers">
						Add extra charge to invoice #: {{$invoice->id}}
					</span>
				</div>
				{!! Form::open(['method' => 'put' , 'url' => '/new_charge/'.$invoice->id, 'name' => 'form1',  'align' => 'center']) !!}
					<!-- <input type="hidden" name="invoice" value="125407549">
					<input type="hidden" name="step" value="new-charge">
					<input type="hidden" name="nstep" value="2"> -->
					<table width="500" border="0" cellspacing="4" cellpadding="4" style="margin: 0 auto;">
						<tbody>
							<tr>
								<td align="left">
									{!! Form::label('Amount to add:') !!}	
								</td>
								<td align="left">
									{!! Form::text('amount', null,['class' => 'manage_balance_inputs', 'id' => 'amount'])!!}	
								</td>
							</tr>
							<tr>
								<td align="left">
									{!! Form::label('What is this charge for:') !!}
								</td>
								<td align="left">
									{!! Form::select('service', $charge_reasons, null , ['class' => 'customer_text_area_selects', 'id' => 'select']) !!}
								</td>
							</tr>
							<tr>
								<td align="left">
									{!! Form::label('Or enter your own description:') !!}	
								</td>
								<td align="left">
									{!! Form::text('service_other', null,['class' => 'manage_balance_inputs', 'id' => 'services'])!!}
								</td>
							</tr>
							<tr>
								<td align="left">
									{!! Form::label('Date for this charge:') !!} 
								</td>
								<td align="left">
									{!! Form::select('period', $period, null , ['class' => 'customer_text_area_selects', 'id' => 'select']) !!}
									
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td align="left">
									<br>
									{!! Form::submit('Submit', array('class'=>'customer_text_area_button')) !!}
								</td>
							</tr>
						</tbody>
					</table>
				{!! Form::close() !!}
				
			</div> 
		</div>
        	<div class="bBox_btns">
       			<div class="edit_oBtn bordL"><a href="{{ url('customers/'.$invoice->customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    		</div> 
    		<div class="clear"></div>
        </div>
	</div>
@stop