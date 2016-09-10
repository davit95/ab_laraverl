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
									<!-- <select class="customer_text_area_selects">
										//
									</select> -->
									<!-- <select name="service_month" class="customer_text_area_selects">
										<option value="" selected="selected"></option>
										<option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">Jun</option>
										<option value="07">Jul</option>
										<option value="08">Aug</option>
										<option value="09">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<select name="service_day" class="customer_text_area_selects">
										<option value="" selected="selected"></option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
									</select>
									<select name="service_year" class="customer_text_area_selects">
										<option value="" selected="selected"></option>
										<option value="2009">2009</option>
										<option value="2010">2010</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
									</select> -->
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