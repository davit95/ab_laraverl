@extends('admin.layouts.layout')

@section('page-header')
	Centers
@stop
@section('content_top')    
    <div class="ct_icon_oc"></div> 
        <div class="ct_wrapp">
        
    <div class="clear"></div>    
@stop
@section('content')
    <div class="h2wrapp">
        <div class="h2Icon view"></div>
        <div class="h2txt">
            <h2>Center</h2>
        </div>
    </div> 
    <div class="owner_show">
        @include('alerts.messages')
        @include('admin.centers.parts._center-show')
	</div>
@stop