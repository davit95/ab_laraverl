@extends('admin.layouts.layout')

@section('page-header')
	Owners & Centers
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12 request-detail">
			<div class="ct_title">
				<h1>Request Details For {{$requestDetail->center->name}}</h1>
			</div>
			<div class="col-md-12">
				<div class="row request-header">
					{{$requestDetail->title}}
					{{$requestDetail->first_name}}
					{{$requestDetail->last_name}}
					would like to 
					{{$requestDetail->i_would_like_to}}
					for
					<b>{{$requestDetail->center->name}}</b>.
					Size {{$requestDetail->size}}.
					Start Date {{$requestDetail->start_date}}
				</div>
			</div>
			<div class="col-md-12 notes">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<b>Notes</b>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							{{$requestDetail->notes}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 contact-info">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<b>Contact Info</b>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									Name :									
								</div>
							</div>
							<div class="col-md-6">
								{{$requestDetail->first_name}}  
								{{$requestDetail->last_name}}
							</div>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									Email :									
								</div>
							</div>
							<div class="col-md-6">
								{{$requestDetail->email}}								
							</div>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									Company :									
								</div>
							</div>
							<div class="col-md-6">
								{{$requestDetail->company}}								
							</div>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									Phone :									
								</div>
							</div>
							<div class="col-md-6">
								{{$requestDetail->phone}}								
							</div>							
						</div>
					</div>					
				</div>
			</div>
			<div class="col-md-12 buttons">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<button class="col-md-10 btn btn-success">Accept</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<button class="col-md-10 btn btn-danger">Decline</button>		
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
@stop