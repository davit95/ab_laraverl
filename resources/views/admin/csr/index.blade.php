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
				<div id="myTabContent" class="tab-content"> 
					@if($role == 'admin')
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab"> 
							@include('alerts.messages')
							@include('admin.csr.new_orders')
						</div> 
						<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab"> 
							@include('alerts.messages')
							@include('admin.csr.your_orders')
						</div>
					@else
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab"> 
							@include('alerts.messages')
							@include('admin.csr.orders')
						</div> 
						<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab"> 
							@include('alerts.messages')
							@include('admin.csr.orders')
						</div>
					@endif
					
				</div>
			</div>
		    <!-- <div class="dataTable_wrapper">                
		        @include('alerts.messages')
	            
		    </div> -->
		</div>   
	</div>
@stop
