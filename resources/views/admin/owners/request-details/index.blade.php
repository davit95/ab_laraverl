@extends('admin.layouts.layout')

@section('page-header')
	Owners & Centers
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12 table_box">
			@include('alerts.messages')
			@include('admin.owners.request-details.parts.list')
		</div>
	</div>
@stop