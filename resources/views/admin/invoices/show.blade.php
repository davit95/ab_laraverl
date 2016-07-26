@extends('admin.csr.layouts.layout')


@section('content_top')

<div class="pull-right">
	{!!Form::open([ 'url' => url('/csr/customer-search'), 'method' => 'POST' ])!!}
		<input name = "key" class="ct_input" type="text">
		<button type = "submit" class="search_btn"></button>
	{!!Form::close()!!}
</div>
<div class="clear"></div>


@stop
@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
        @include('admin.invoices.parts._invoice-show')
	</div>
@stop