@extends('admin.csr.layouts.layout')
@section('content')	
	<!-- <div class="container">
        <div class="jumbotron" id = "invContent">
            <div id = "AVOlogo" class = "pull-left col-md-6 col-sm-6 col-xs-12"></div>
            <div class = "pull-right col-md-6"> <img src="#" width = "100px"> </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
              <h3>Column 1</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
            </div>
            <div class="row">
        	    <div class = "col-sm-4">
        	    	
        	    </div>
        	</div>
            <div class="col-sm-4">
                <h3>Column 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
            </div>
            <div class="col-sm-4">
                <h3>Column 3</h3>        
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
            </div>
        </div>
    </div> -->
<div id="invContent">
    <div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 3px;">
        <div id="invoiceTop">
            <div id="AVOlogo"></div>
            <div id="contact">
                <strong>Toll Free:</strong> +1 888.869.9494<br>
                <strong>Phone:</strong> +1 949.777.6340<br>
                <strong>Email:</strong> services@alliancevirtualoffices.com
            </div>
            <div id="address">{{$customer->address1}} <br>{{$customer->address2}}</div>
            <div id="date">
                <span class="t1">
                    Invoice
                </span>
                <br>
                <strong>
                    Invoice Date:
                </strong> 
                <!-- May 23, 2016 -->
                {{$customer->created_at}}
            </div>
        </div>
        <div id="userDivision">
            <div id="UserLogin">
                <strong>
                    User Login:
                </strong>
                    {{$customer->email}}
            </div>
            <div id="InvoiceNumber">
                <strong>
                    Invoice Number:
                </strong>
                    {{$customer->id}}
            </div>
        </div>
        <div id="AllSummary">
            <div id="cutomer">
                <span class="t2">
                    CUSTOMER INFORMATION
                </span><br><br>
                Triskel Consulting Services<br>
                {{$customer->first_name}} {{$customer->last_name}}<br>
                {{$customer->address1}}<br>
                {{$customer->city->name}}, {{$customer->state}} 11787 {{$customer->country_code}}<br>
                {{$customer->phone}}<br>
                {{$customer->email}}<br>
                <br><br>
            </div>
            <div id="InvoiceSumm">
                <span class="t2">
                    BILLING SUMMARY
                </span><br><br>
                <div id="lef" class="spaceTot">TOTAL:</div>
                <div id="righ" class="spaceTot">$0<br></div>
            </div>
        </div>
        <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php" target="_blank">
            <div id="Marketing"></div>
        </a>
        <div id="social">
            <a href="https://twitter.com/AllianceVirtual" target="_blank">
                <div id="tweet"></div>
            </a>
            <a href="https://www.facebook.com/AllianceVirtual" target="_blank">
                <div id="face"></div>
            </a>
        </div>
        <div id="billing" class="t2">ADDRESS DETAILS</div> <br>
        <div style="width: 447px; float: left;"><strong>Invoice Total:</strong></div>
        <div style="float: left;"><span class="redB">$0</span></div>
        <div style="clear: both;"><br>
            <div id="questions">
                Questions about your new invoice? &nbsp; Visit our 
                <a class = "questions_a" href="http://www.alliancevirtualoffices.com/billing-faq.html">Billing FAQs</a> Page.&nbsp; &nbsp;
            </div><br><br>
        <span style="color: red; font-weight: bold;">
            Original Invoice: {{$customer->id}}
        </span> 
        <br><br>
            <div id="importantDates"></div>
        </div>
    </div>
</div>
@stop
