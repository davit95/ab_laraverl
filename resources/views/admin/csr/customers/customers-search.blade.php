@extends('admin.csr.layouts.layout')


@section('content')	
    <div class="row">
        <div class="col-lg-12">
        	<h2><b>Search Results</b></h2>
        	<hr>
        	@forelse( $customers as $customer )
            	@include('admin.csr.parts._customer-short-show')
       		@empty
            	@include('alerts.no-data-table')
        	@endforelse
    	</div>
    </div>
@stop