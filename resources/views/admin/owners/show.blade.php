@extends('admin.layouts.layout')

@section('page-header')
	Owners & Centers
@stop
@section('content_top')    
    <div class="ct_icon_oc"></div> 
        <div class="ct_wrapp">
        <div class="ct_title"><h1>OWNERS &amp; CENTERS</h1></div> 
        <div class="ct_tools">
            {!! Form::open([ 'url' => url('owners') , 'method' => 'GET' , 'class' => 'pull-left']) !!}
                {!! Form::text('company_or_owner_name', Request::get('company_or_owner_name'), [ 'class' => 'ct_input', 'id' => 'company_or_owner_name' ]) !!}
                <button type="submit" class="search_btn"></button>
            {!! Form::close() !!}            
                <a href="{{ url('owners/create') }}" class="tools_gray_btn lightbox">
                    <div>
                        <div class="tools_btn_l1"></div>
                            <div class="tools_btn_r">New Owner</div>
                    </div>
                </a>
            </div> 
        </div> 
    <div class="clear"></div>    
@stop
@section('content')
    <div class="h2wrapp">
        <div class="h2Icon view"></div>
        <div class="h2txt">
            <h2>OWNER</h2>
        </div>
    </div> 
    <div class="owner_show">
        @include('alerts.messages')
        @include('admin.owners.parts._owner-show')
	</div>
	<div class="content_wrapp2">        
        @include('admin.owners.parts._centers-show')    
        @include('admin.owners.parts._members-show')
    </div>    
@stop