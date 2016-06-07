<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container" style="padding:50px 50px 0 50px">
	<div class="row">
		<header>
			 <div class="col-xs-6 col-md-3"> 
			 	<a href="#" class="thumbnail"> 
			 		<img  alt="100%x180" src="https://www.alliancevirtualoffices.com/external/images/alliance-virtual-offices-logo.png" data-holder-rendered="true" style="height: 90px; width: 100%; display: block;"> 
			 	</a> 
			 </div> 
			 <div class="col-xs-6 col-md-6 col-md-offset-3" style="height:90px"> 
			 	<div class="row">
				 	<nav class="navbar navbar-default">
				 	  <div class="container-fluid">
				 	    <ul class="nav navbar-nav navbar-right">
				 	      <li><a href="#">Live Receptionists</a></li>
				 	      <li><a href="#">Virtual Office Locations</a></li>
				 	      <li><a href="#">Meeting Rooms</a></li>
				 	    </ul>
				 	  </div>
				 	</nav>
				 </div>
			 </div>
		 </header>
	</div>
	<div class="row content">
		<div class="col-xs-6 col-md-3"> 
		 	<div>
		 	 	<p style="margin-top:30px">Account Information</p>
		 	 	<hr>
		 	 	<p>{{$client->first_name}} {{$client->last_name}}</p>
		 	 	<p>{{$client->address1}}</p>
		 	 	<p>{{$client->city->name}}, {{$client->city->country_code}} {{$client->postal_code}}</p>
		 	 	<p>{{$client->country}}</p>
		 	 	<p>Phone: {{$client->phone}}</p>
		 	 	<p>Email: {{$client->email}}</p>
		 	</div>
		 	<div>
		 		<p style="margin-top:30px">Select an option</p>
		 		<hr>
		 		<a href	="#">Admin Home Page</a><br><br>
		 		<a href	="#">Update Account</a><br><br>
		 		<a href	="#">Logout</a><br><br>
		 	</div>
		 	<div>
		 		<p style="margin-top:30px">Account Information</p>
		 		<hr>
		 		<p>as</p>
		 		<p>as</p>
		 		<p>as</p>
		 	</div>
		</div>
		
		<div class="col-xs-6 col-md-offset-2 col-md-4"> 
			<div class= "row">
		 	 <h2>Main Admin Area</h2>
		 	   <p>Below is a list of all your alliancevirtualoffices.com invoices.</p>            
		 	   <table class="table" style="outline:1px solid black">
		 	     <thead>
		 	       <tr style="outline:1px solid black;background-color: #207F9F;" >
		 	         <th>DATE</th>
		 	         <th>INVOICE NUMBER</th>
		 	         <th>DOWNLOAD</th>
		 	       </tr>
		 	     </thead>
		 	     <tbody>
		 	       <tr>
		 	         <td>June 2, 2016</td>
		 	         <td>Invoice #125407548</td>
		 	         <td><img src="https://www.alliancevirtualoffices.com/external/images/Download-PDF.png"></td>
		 	       </tr>
		 	       <tr>
		 	         <td>June 2, 2016</td>
		 	         <td>Invoice #125407548</td>
		 	         <td><img src="https://www.alliancevirtualoffices.com/external/images/Download-PDF.png"></td>
		 	       </tr>
		 	     </tbody>
		 	   </table>
		 	   </div>
		</div>
		<div class="col-xs-6 col-md-3"> 
		</div>
	</div>
</div>

<style type="text/css">
	td {
		border:2px solid #CCC;
	}
	body {
		background: #207F9F;
		box-shadow: inset 0px 0px 150px #222; 
	}
	.content{
		background: white;
	}
</style>