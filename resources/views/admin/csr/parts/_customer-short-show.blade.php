
<a href="#">{{$customer->first_name}} {{$customer->last_name}}</a><br>
<b>Customer Number: </b> {{$customer->id}} <br>
<b>Csr</b> ???? <br>
<b>Operator Name: </b> {{$customer->company_name}} <br>
<b>Center Name: </b> {{isset($customer->centers[0]) ? $customer->centers[0]->name : null}} <br>
<b>Center City: </b> {{isset($customer->city) ? $customer->city->name : null}} <br>
<b>Center State: </b> {{isset($customer->us_state) ? $customer->us_state->name : null}} <br><br>
<hr>