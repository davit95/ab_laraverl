@extends('white-site.layouts.layout')
@section('content')
	<div class="col-md-12 virtual-offices-introduction">
		<div class="row">
			<div class="col-md-12 title">
				Virtual Offices
			</div>
			<div class="subtitle col-md-6">
				Give your business <b>the professional push</b> it deserves with the ultimate in flexibility, 
				quality and affordability.
			</div>
			<div class="col-md-7">
				<ul class="list">
					<li>
						<b>Your Calls, Answered:</b> Create the right impression by having incoming calls answered in your company name, 
						handled in a friendly and professional manner, and redirected according to your instructions.
					</li>
					<li><b>Professional Business Address:</b> Choose from hundreds of buildings all over the world, 
						from glass-fronted finance centers and soaring skyscrapers to stylish downtown digs
					</li>
					<li>
						<b>Mobile Meeting Points:</b> Benefit from touchdown office space when you're working on the go. 
						Take advantage of professional conference rooms, on-demand meeting space and superior day offices.
					</li>
					<li>
						<b>Mail Handling:</b> Have mail sent to your business address, safe in the knowledge that it will be received, 
						handled and forwarded to the location of your choice. Or, pop in to collect it yourself.
					</li>
					<li>
						<b>Local Area Code:</b>	 Setting up in a new city? Establish your presence with your own telephone number and local area code, 
						which sets the scene and shows you mean business right from the word 'Go'.
					</li>				
				</ul>				
				<a class="get_started" href="/white-site/{{ $white_site->id }}/virtual-offices">GET STARTED</a>
			</div>
		</div>
	</div>
@stop