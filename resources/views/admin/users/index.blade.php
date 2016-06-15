

 @extends('admin.layouts.layout')

@section('page-header')
	New Center - [ Company / Owner ]
@stop

@section('content')
    <div class="row form-group">
		@if(Request::is('users*'))	
			<a href="{{ url('/admin-users') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Alliance Csr</a>		
			<!-- <a href="{{ url('owners/create') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Owner</a> -->
		@else
			<a href="{{ url('/admin-users') }}" class="btn btn-outline btn-default" style="margin-left:15px;"><i class="fa fa-plus"></i> New Accounting Admin</a>
		@endif
	</div>
	<div class="row">
		<div class="col-lg-12 table_box">
			<div class="tabs-container">
				<ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="@if(Request::is('users*')) active @endif"><a href="/users">Alliance csr</a></li>
				    <li role="presentation" class="@if(!Request::is('users*')) active @endif"><a href="/accounting-admin">Accounting Admin</a></li>
				</ul>
				<div id="myTabContent" class="tab-content"> 
					<div role="tabpanel" class="tab-pane fade @if(Request::is('users*')) active in @endif" id="users" aria-labelledby="alliance-user-tab"> 
						@include('alerts.messages')
		            	@if(!Request::is('accounting-admin*'))
		            		@include('admin.users.parts._user-list-index')
	            		@endif
					</div>					
					<div role="tabpanel" class="tab-pane fade @if(!Request::is('users*')) active in @endif" id="accounting-admin" aria-labelledby="accounting-admin-tab"> 
						@include('alerts.messages')
						@if(Request::is('accounting-admin*'))							
							@include('admin.users.parts._accounting-user-list-index')
						@endif
					</div>
				</div>		
			</div>    
		</div>
	</div>
@stop

