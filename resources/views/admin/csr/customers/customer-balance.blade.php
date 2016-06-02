@extends('admin.csr.layouts.layout')

@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
        @include('admin.csr.parts._customer-balance-show')
	</div>
@stop