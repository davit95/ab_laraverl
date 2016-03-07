@extends('admin.layouts.layout')

@section('page-header')
	Owners & Centers
@stop
@section('content_top')   
<!-- {!! Form::open([ 'url' => url('owners') , 'method' => 'GET' ]) !!}
	<div class="col-md-3">
		{!! Form::text('company_or_owner_name', Request::get('company_or_owner_name'), [ 'class' => 'form-control' , 'placeholder' => 'Company or Owner\'s Name', 'id' => 'company_or_owner_name' ]) !!}
	</div>
	<button type="submit" class="pull-left btn btn-success"><i class="fa fa-search"></i></button>
{!! Form::close() !!} --> 
    <div class="ct_icon_oc"></div>
	    <div class="ct_wrapp">
	    <div class="ct_title"><h1>OWNERS &amp; CENTERS</h1></div> 
	    <div class="ct_tools">
		    <input class="ct_input" type="text">
		     <a href="view-owners-centers.html" class="search_btn"></a>	
			    <a href="{{ url('owners/add-document') }}" class="tools_gray_btn lightbox">
			    	<div>
			    		<div class="tools_btn_l1"></div>
			    			<div class="tools_btn_r">Documents</div>
	    			</div></a>
			    <a href="{{ url('owners/documents') }}" class="tools_gray_btn lightbox">
				    <div><div class="tools_btn_l2"></div>
				    	<div class="tools_btn_r">Documents</div>
				    </div>
			    </a>
		    </div> 
	    </div> 
    <div class="clear"></div>    
@stop
@section('content')
	<div class="row form-group">		
		<a href="{{ url('owners/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Owner</a>
	</div>
	<div class="row">
		<div class="col-lg-12 table_box">
		    <div class="dataTable_wrapper">                
		        @include('alerts.messages')
	            @include('admin.owners.parts._owner-list-index')
		    </div>
		</div>   
	</div>
@stop