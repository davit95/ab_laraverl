@extends('admin.layouts.layout')

@section('content')
    <div class="owner_show">
        @include('alerts.messages')
        @include('admin.csr.parts._customer-show')
	</div>
@stop