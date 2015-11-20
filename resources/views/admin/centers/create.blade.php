@extends('admin.layouts.layout')

@section('page-header')
	New Center - [ Company / Owner ]
@stop

@section('content')
	<div class="row form-group">
		@include('admin.owners.parts._filter')
		<a href="{{ url('owners/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Owner</a>
	</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.centers.forms._center-form')
    	</div>
    </div>
@stop