@extends('admin.csr.layouts.layout')

@section('content')	
	<div class="row">
		<div class="col-lg-12 table_box">
			<div class="tabs-container">
				<h3 class="text-center">Welcome Dmitry</h3>
				<br>
				<ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">New Orders</a></li>
				    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Your Orders</a></li>
				</ul>
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="new_orders"></div>
				    <div role="tabpanel" class="tab-pane" id="your_orders"></div>
				</div>
			</div>
		    <!-- <div class="dataTable_wrapper">                
		        @include('alerts.messages')
	            @include('admin.csr.orders')
		    </div> -->
		</div>   
	</div>
@stop
