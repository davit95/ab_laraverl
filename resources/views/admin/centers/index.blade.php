@extends('admin.layouts.layout')

@section('page-header')
	New Center - [ Company / Owner ]
@stop

@section('content')
    <div class="row form-group">
    	@if(!Request::is('owners*'))  		
			<a href="{{ url('centers/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Center</a>
		@endif
		@if(Request::is('owners*')) 
			@if($role === 'super_admin')		
				<a href="{{ url('owners/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Owner</a>
			@elseif($role === 'owner_user' && isset($owner))
				<a href="{{ url('owners/'.$owner->id.'/edit') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> Edit Owner</a>
			@endif		
			<!-- <a href="{{ url('owners/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Owner</a> -->
		@endif
	</div>
	<div class="row">
		<div class="col-lg-12 table_box">
			<div class="tabs-container">
				<ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="@if(!Request::is('owners*')) active @endif"><a href="/centers">Centers</a></li>
				    <li role="presentation" class="@if(Request::is('owners*')) active @endif"><a href="{{ url('/owners-centers') }}">Owners</a></li>
				</ul>
				<div id="myTabContent" class="tab-content"> 
					<div role="tabpanel" class="tab-pane fade @if(!Request::is('owners*')) active in @endif" id="centers" aria-labelledby="centers-tab"> 
						@include('alerts.messages')
		            	@if(!Request::is('owners*'))
		            		@include('admin.centers.parts._center-list-index')
	            		@endif
					</div>					
					<div role="tabpanel" class="tab-pane fade @if(Request::is('owners*')) active in @endif" id="owners" aria-labelledby="owners-tab"> 
						@include('alerts.messages')
						@if(Request::is('owners*'))							
							@include('admin.owners.parts._owner-list-index')
						@endif
					</div>
				</div>		
			</div>    
		</div>
	</div>
@stop
