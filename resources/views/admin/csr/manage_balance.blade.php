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
				<tbody><tr>
				<td width="100"><strong>ID #</strong></td>
				<td width="100"><strong>Action Date</strong></td>
				<td width="150"><strong>Type</strong></td>
				<td width="110"><strong>Invoice #</strong></td>
				<td width="100"><strong>Invoice<br>Date</strong></td>
				<td width="155"><strong>Amount</strong></td>
				<td width="130"><strong>Balance</strong></td>
				</tr> </tbody></table></div>
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
								<span class="costumer_text_area">$0.00</span>
							</td>
						</tr>
					<tr>
						<td>
							<span class="costumer_text_area">Last Change Date:</span>
						</td>
						<td>
							<span class="costumer_text_area">N/A</span>
						</td>
					</tr>
					</tbody>
				</table>
				<br>
				<form action="" method="post">
					<input type="hidden" name="step" value="manage-customer-balance">
					<input type="hidden" name="c" value="2">
					<input type="hidden" name="custid" value="7455">
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
									<input name="Amount" type="text" id="Amount" class="manage_balance_inputs">
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Type:</span>
								</td>
								<td class="table_text_align">
									<select name="Type" class="customer_text_area_selects">
										<option value="Check">Check</option>
										<option value="Wire">Wire</option>
										<option value="CC">Credit Card</option>
										<option value="Bitcoin">Bitcoin</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<span class="costumer_text_area">Check or Wire Number/ID:</span>
								</td>
								<td class="table_text_align"><input name="ID" type="text" id="ID"  class="manage_balance_inputs" ></td>
							</tr>
							<tr>
							<td>
								<span class="costumer_text_area">Received on date:</span>
							</td>
							<td class="table_text_align">
							<select name="ro_month" class="customer_text_area_selects">
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
							<select name="ro_day" class="customer_text_area_selects">
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
							<select name="ro_year" class="customer_text_area_selects">
								<option value="" selected="selected"></option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<span class="costumer_text_area">Notes:</span>
						</td>
						<td class="table_text_align">
							<textarea name="Notes" id="Notes" cols="25" rows="5" class="manage_balance_inputs"></textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="table_text_align"><input type="submit" name="Submit" value="Submit" class="customer_text_area_button"></td>
					</tr>
				</tbody>
			</table>
		</form>
		<br><br>
		<a href=""  style="color: #369 !important;">Go to this Customer's Account Information Page</a>
	</div>
</div>
<div class="bBox_btns">
       
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>

</div>
@stop