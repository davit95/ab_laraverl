@extends('admin.layouts.layout')

@section('page-header')
	Add New Owner
@stop

@section('content')
	<div class="row form-group">
		@include('admin.owners.parts._filter')
	</div>
    @include('admin.owners.forms._owner-form')
@stop