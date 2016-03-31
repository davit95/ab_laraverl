<!-- @foreach($centers as $center)
<p>{{$center->name}}</p>

@endforeach -->
@extends('admin.layouts.layout')

@section('page-header')
	New Center - [ Company / Owner ]
@stop

@section('content')	
    <div class="row form-group">		
		<a href="{{ url('centers/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Center</a>
	</div>
	<div class="row">
		<div class="col-lg-12 table_box">
		    <div class="dataTable_wrapper">                
		        @include('alerts.messages')
	            @include('admin.centers.parts._center-list-index')
		    </div>
		</div>   
	</div>
@stop
