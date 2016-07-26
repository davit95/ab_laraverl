@extends('admin.csr.layouts.layout')
    
@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
<div class="w_box view_box paddin_left_content" style="width:90%; background: #F4F4F4;">
    <div class="form_left left_side_area">
        <div class="line right_side_area_line">
            <div class="formOinfo left_side_area_content">
                <span class="lh_fi mediumBold customer_text_area_headers" > Customer Information: </span>
                <div style="float: right;"><img src="https://www.alliancevirtualoffices.com/csr/images/visa-icon.jpg" border="0" style="margin:31px 11px;"></div>
                <!-- <div style="color: white; background-color: red; font-weight: bold;">CUSTOMER TERMINATED</div> -->
                <span class="costumer_text_area">
                    <br>
                Processing Departament 
                <br> 
                    {{$customer->first_name}}
                <br>
                {{$customer->address1}}
                <br>
                <br>              
                {{$customer->first_name}} {{$customer->last_name}}, {{isset($customer->country) ? $customer->country->code : null }} {{$customer->postal_code}}
                <br>
                {{$customer->fax}}
                <br>
                {{$customer->email}}
                <br>
                Customer Type: AVO Direct 
                <br>
                Phone.com Phone Number: {{$customer->phone}}
                <br>
                <br>
                </span>
                <a class="customer_text_area_links" href="" target="V">
                    <img class="icon" width="16" height="13" src="https://www.alliancevirtualoffices.com/csr/images/eye2.png">&nbsp;View this customer's Admin area
                </a>
                <br>
                <a class="customer_text_area_links" href="">
                    <img class="icon" width="16" height="16" src="https://www.alliancevirtualoffices.com/csr/images/pencil.png" alt="Edit" title="Edit">&nbsp;Edit Customer's Info
                </a>
                <br>
                <a class="customer_text_area_links" href="" target="V">
                    <img class="icon" width="16" height="13" src="https://www.alliancevirtualoffices.com/csr/images/order.png">&nbsp;Place order as this Customer
                </a>   
            </div>
            <div class="line">
                <div class="formOinfo" style="width:361px;">
                    <span class="lh_fi mediumBold customer_text_area_headers" > Customer's Files: </span>&nbsp;
                    <div class="files-category customer_text_area_text">Identification</div>
                    <div class="files-category customer_text_area_text">Post Office Form</div>
                    <div class="files-category customer_text_area_text">Misc.</div>
                    <div class="files-category customer_text_area_text">CMRA</div>
                    <a class="customer_text_area_links" href="">
                        <img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/upload.png"> Upload file for this customer
                    </a>
                </div>
            </div>
        </div>         
    </div>
    <div class="form_right right_side_content">
       <div class="line text_align_left">
         <span class="lh_fi mediumBold customer_text_area_headers">
            Invoice / Account Options    
        </span><br><br>
        • <a  class="customer_text_area_links" href="?step=new-charge&amp;invoice=4309462"> Add extra charges to upcoming invoice</a> 
        (#<a class="customer_text_area_links" href="" target="_blank">4309462</a>)
        <br>
        • <a  class="customer_text_area_links" href="">Add Recurring Charge or Credit to 4309462</a>
        <br>
        • <a  class="customer_text_area_links" href="/customers/{!!$customer->id!!}/manage-balance">Manage Customer Balance</a>
         <br>
        <br>
        </div>
       
        <div class="line text_align_left">
            <span class="lh_fi mediumBold customer_text_area_headers">
            Customer Status    
            </span>
            <br>
            <br>
            <span class="costumer_text_area">
                Customer Admin Status:
            </span>
            <select name="customer_status" class="customer_text_area_selects" style="float: right; margin-top: -8px;">
                <option value="Active">Active</option>
                <option value="Pending">Pending</option>
                <option value="Hold" selected="selected">Hold</option>
            </select>
        </div> 
        <div class="line text_align_left">
            <br>
            <span class="lh_fi mediumBold customer_text_area_headers">
                Recurring Charging Status    
            </span>
            <br>
            <div class="cerca" style="height: 35px; padding-top: 10px; background-color: red; color: white;">125402041
                <select class="statusChange customer_text_area_selects" name="recurring_status_125402041" style="float: right; margin-top: -8px;">
                    <option value="Live">Live</option>
                    <option value="Closed" selected="selected">Closed</option>
                    <option value="Hold">Hold</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <div class="StatusNotes" id="closing_notes_for_125402041" style="display: none;">
                Notes:
                <textarea name="notes_for_125402041" style="width: 150px; height: 60px; float: right; margin-top: -10px;"></textarea>
                <br class="clear">
            </div> 
            <input type="submit" name="submit" value="Submit" class="customer_text_area_button">
        </div>
        <div class="line text_align_left">
             <span class="lh_fi mediumBold customer_text_area_headers">
                Completed Invoice History    
            </span>&nbsp;
            <table border="0" cellspacing="3" cellpadding="3" class="table" style="width:75%; ">
                <tbody>
                    <tr>
                        <td ><strong>Invoice</strong></td>
                        <td ><strong>Invoice Date</strong></td>
                        <td ><strong>Amount</strong></td>
                    </tr> 
                    @foreach($completed_invoices as $invoice)
                        <tr>
                            <td><a class="customer_text_area_links" href="" target="V">{{$invoice->id}}</a></td>
                            <td>{{$invoice->created_at}}</td>
                            <td>$ {{$invoice->price}}</td>
                        </tr>
                    @endforeach   
                </tbody>
            </table>  
        </div>
        <div class="line text_align_left">
            <span class="lh_fi mediumBold customer_text_area_headers">
                Unpaid Invoice(s)    
            </span>&nbsp;
            <table border="0" class="table">
                <tbody>
                    <tr>
                        <td ><strong>Invoice</strong></td>
                        <td ><strong>Date</strong></td>
                        <td ><strong>Amount</strong></td>
                        <td ><strong>Action</strong></td>
                    </tr>
                    @foreach($declined_invoices as $invoice)
                        <tr>
                            <td><a class="customer_text_area_links" href="" target="V">{{$invoice->id}}</a></td>
                            <td>{{$invoice->created_at}}</td>
                            <td>$ {{$invoice->price}}</td>
                            <td> </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="line text_align_left">
            <span class="lh_fi mediumBold customer_text_area_headers">
                Next Invoice(s)    
            </span>&nbsp;
            <table border="0" cellspacing="3" cellpadding="3" class="table">
                <tbody>
                    <tr>
                        <td ><strong>Invoice</strong></td>
                        <td ><strong>Invoice </strong></td>
                        <td ><strong>Amount</strong></td>
                        <td ><strong>Action</strong></td>
                    </tr>
                    @foreach($next_invoices as $invoice)
                        <tr>
                            <td><a class="customer_text_area_links" href="" target="V">{{$invoice->id}}</a></td>
                            <td>{{$invoice->created_at}}</td>
                            <td>$ {{$invoice->price}}</td>
                            <td> </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
             <span class="lh_fi mediumBold customer_text_area_headers">
                DNC History:
            </span>&nbsp;
            <br>
            <br>
            <span class="lh_fi mediumBold customer_text_area_headers">
                Recurring Charges:
            </span>&nbsp;
        </div>
        
           
    </div>
    
    <div class="bBox_btns">
       
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>
    </div>
@stop
