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

                {{isset($customer->city) ? $customer->city->name : null}}, {{ isset($customer->state) ? $customer->state : null}} 11787 {{isset($customer->country_code) ? $customer->country_code : null}}<br>

                {{$customer->phone}}<br>
                {{$customer->email}}<br>
                <br><br>
            </div>
            <div id="InvoiceSumm">
                <span class="t2">
                    BILLING SUMMARY
                </span><br><br>

                 @if($invoice->type == 'vo')
                    <div class="pull-left">
                          Virtual Ofice Package
                        <br>
                        Mail Forwarding:
                        <br>
                        {{$invoice->vo_plan}}:
                        <br>
                        Setup Fee
                    </div>
                    <div class="pull-right" style="text-align:right;">
                    <br>    
                     <span class="boldet_color">${{$invoice->vo_mail_forwarding_price}}</span>
                        <br>   
                         <span class="boldet_color">${{$package_price}}.00</span>
                        <br>
                        <span class="boldet_color">$100.00</span>    
                    </div>
                               
                   
                    <br>

                <div id="lef" class="spaceTot">TOTAL:</div>
                <div id="righ" class="spaceTot">${{$package_price + $invoice->vo_mail_forwarding_price + '100'}}<br></div>
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
        <div class="t2 bordered_bottom">ADDRESS DETAILS</div>
        <div  class="inovice_detaeils">
            <div class="green_text pull-left">
                Virtual Office Address
                <br>
                <span class="invoice_inner_texts">
                    {{$center_addres->address1}}
                    {{$center_addres->address2}}
                    {{$center_addres->postal_code}}
                </span>
            </div>
            <div class="green_text pull-right">
                Mail Forwarding Address
                <br>
                <span class="invoice_inner_texts">
                    {{$customer->address1}}
                </span>
            </div>  

        </div>
        <div class="t2 bordered_bottom">BILLING DETAILS</div>
        <div id="billing" class="inovice_detaeils">
            <div class="bordered_bottom">
                <div class="green_text">
                    Virtual Office Package
                    <br>
                    <span class="invoice_boldet_text">
                        Description:    {{$invoice->vo_plan}}:
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Price: 
                        <span class="boldet_color pull-right">${{$package_price - $lr_price}}.00</span>
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Setup Fee:
                        <span class="boldet_color pull-right">$100.00</span>
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Package Term:  {{$customer->duration}} Months
                    </span>
                </div>
            </div>
            <div class="bordered_bottom">
                <div class="green_text">
                    Mail Forwarding
                    <br>
                     <span class="invoice_boldet_text">
                        Courier:  {{$mail_forwarding->name}}  
                    </span>
                    <br>
                     <span class="invoice_boldet_text">
                        Frequency:   {{$frequency}} 
                    </span>
                    <br>
                     <span class="invoice_boldet_text">
                        Price:    <span class="boldet_color pull-right">${{$mail_forwarding->price * $quality}} </span>     
                    </span>
                </div>
            </div>
             <div class="bordered_bottom" style="padding:10px 0px 10px 0px;">
                <span class="green_text">
                    Live Receptionist and Phone Package
                </span>
                <br>

                 <span class="invoice_boldet_text">
                     Package Price:
                 </span>
                <span class="invoice_inner_texts">
                    {{$invoice->lr_name}}(Phone# {{$invoice->phone_number_selected}})
                   
                        <span class="boldet_color pull-right">${{$lr_price}}</span>
                </span>
            </div>
             <div class="bordered_bottom" style="padding:10px 0px 10px 0px;">
                <span class="green_text">
                    Live Receptionist and Phone Package
                </span>
                <br>
                 <span class="invoice_boldet_text">
                     Package Price:
                 </span>
                 <span class="invoice_inner_texts">
                    Package Discount (Phone #: )
                    <span class="boldet_color pull-right">
                        @if($package_price != '')
                                -$10
                        @else
                            $0
                        @endif                   
                    </span>
                </span>
            </div>
             <div >
                <strong>Invoice Total:</strong>
                <span class="boldet_color pull-right">{{$package_price + $quality*$mail_forwarding->price + '100' }}</span>
            </div>
        @endif
        @if($invoice->type == 'mr')
        <div class="pull-left">
            Meeting Room
             <br>
            Meeting Room Amenities
            <br>
            <span style="font-weight:bold; color:black;">TOTAL:</span>    
        </div>
        <div class="pull-right">
            <span class="boldet_color">
                ${{$invoice->price}}
            </span>
            <br>
            <span class="boldet_color">
                $0.00
            </span>
             <br>
            <span class="boldet_color">
               ${{$invoice->price}}
            </span>
        </div>
        <div style="clear:both;"></div>
        </div>
        <div style="clear:both"></div>
        <a href="http://www.alliancevirtualoffices.com/meeting-room-locations.php" target="_blank">
            <div id="Marketing"></div>
        </a>
        </div>
        <div id="social">
            <a href="https://twitter.com/AllianceVirtual" target="_blank">
                <div id="tweet"></div>
            </a>
            <a href="https://www.facebook.com/AllianceVirtual" target="_blank">
                <div id="face"></div>
            </a>
        </div>
        <div class="t2 bordered_bottom">ADDRESS DETAILS</div>
        <div  class="inovice_detaeils">
            <div class="green_text">
                    Meeting Room Location
            </div>
        </div>
        <div class="t2 bordered_bottom">BILLING DETAILS</div>
        <div  class="inovice_detaeils">
            <div class="bordered_bottom">
                <div class="green_text">
                    Meeting Room
                    <span class="invoice_boldet_text">
                        Meeting Room:   
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Meeting Room: {{$mr_name->name}}
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Meeting Date: {{\Carbon\Carbon::parse($invoice->mr_date)->format('m/d/Y')}} 
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Meeting Time: {{\Carbon\Carbon::parse($invoice->mr_start_time)->format('H:i A')}}  - {{\Carbon\Carbon::parse($invoice->mr_end_time)->format('H:i A')}}
                    </span>
                    <br>
                    <span class="invoice_boldet_text">
                        Amount Due:
                          
                        <span class="boldet_color pull-right">$ {{$invoice->price}}</span>
                    </span>
                </div>
            </div>
            </div>  
        <div class="t2 bordered_bottom">
            <div  class="inovice_detaeils">
                <div class="green_text">
                    Meeting Room Amenities
                    <br>
                     <span class="invoice_boldet_text">
                         Package Total Price:
                         <span class="boldet_color pull-right">$ {{$invoice->price}}</span>
                     </span>
                </div>
            </div>
        </div>
        </div>
        <div class="t2">
            <div  class="inovice_detaeils">
             <span class="meeting_room_texts" style="font-weight:bold; color:#666">
                Amount Due at time of meeting
                </span>
                <Br>
               <span class="meeting_room_texts"> 
                    Meeting Room Balance <span style="color:#666;">${{$mr_name->full_day_rate}}</span>
                </span>
                <br>    
                <span class="meeting_room_texts"> 
                Meeting Room Amenities Balance <span style="color:#666;">$</span>
                </span>
                <br>
                 <span class="meeting_room_texts">
                    Total Remaining Balance  <span style="color:#666;">${{$mr_name->full_day_rate}}</span>
                    </span>
                    <br>
                    <br>
                <div >
                    <span class="invoice_boldet_text">Invoice Total:</span>
                    <span class="boldet_color pull-right">$ {{$invoice->price}}</span>
                </div>
                </div>
                
        @endif  
        </div>
         <br>
            <div id="questions">
                Questions about your new invoice? &nbsp; Visit our 
                <a class = "questions_a" style="text-decortation:underline !important; color:#207F9F !important;" href="{{url('/billing-faq')}}">Billing FAQs</a> Page.&nbsp; &nbsp;
            </div><br><br>
        <span style="color: red; font-weight: bold;">
            Original Invoice: {{$customer->id}}


        </span> 
         @if($invoice->type == 'mr')
                <br>
                <span class="invoice_boldet_text">IMPORTANT DATES:</span>
                <br>
                <span>Start Date: {{\Carbon\Carbon::parse($invoice->mr_start_time)->format('M d,Y')}}</span>
                <br>
                <span>Term Length:</span>
                <br>
                <span>Automatic Term Renewal Date: {{\Carbon\Carbon::parse($invoice->mr_end_time)->format('M d,Y')}}</span>
                <br>
                <span>30 Day Cancellation Deadline NOTIFICATION:</span>
                <br>
                <span>
                    <a href="" style="text-decortation:underline !important; color:#207F9F !important;" >https://www.alliancevirtualoffices.com/vo-terms.html</a>
                </span>
            @endif
        <br><br>
            <div id="importantDates"></div>
        </div>
    </div>
</div>
@stop
