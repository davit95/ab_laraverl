@extends('admin.csr.layouts.layout')



@section('content')	
	<div class="row">
		<div class="col-lg-12 table_box">
		    <div class="dataTable_wrapper">                
		        @include('alerts.messages')
	            @include('admin.csr.parts._pending-mrs-list-index')
		    </div>
		</div>   
	</div>
@stop