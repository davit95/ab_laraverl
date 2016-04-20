@extends('admin.csr.layouts.layout')

@section('content')
    
    <div class="owner_show">
        @include('alerts.messages')
        <div class="w_box view_box" style="width:100%">

    <div class="form_left">
        <div class="line">
            <span class="lh_fi mediumBold"> Customer Information: </span>&nbsp;
            <div class="formOinfo">
                <div style="float: right;"><img src="https://www.alliancevirtualoffices.com/csr/images/visa-icon.jpg" border="0" style="margin: 10px;"></div>
                <div style="color: white; background-color: red; padding: 3px; font-weight: bold;">CUSTOMER TERMINATED</div>
                <p>PROCESSING DEPARTMENT</p>
                STEPHEN NGUYEN
                <br>
                6856 CITRADORA CT
                <br>
                <br>              
                GARGEN GROVE, CA 92845
                <br>
                949-642-1171
                <br>
                MICHAELT@PROCESSINGDEPARTMENT.ORG
                <br>
                Customer Type: AVO Direct 
                <br>
                Phone.com Phone Number: 18004460535
                <br>
                <br>
                <a href="" target="V">
                    <img class="icon" width="16" height="13" src="https://www.alliancevirtualoffices.com/csr/images/eye2.png">&nbsp;View this customer's Admin area
                </a>
                <br>
                <a href="">
                    <img class="icon" width="16" height="16" src="https://www.alliancevirtualoffices.com/csr/images/pencil.png" alt="Edit" title="Edit">&nbsp;Edit Customer's Info
                </a>
                <br>
                <a href="" target="V">
                    <img class="icon" width="16" height="13" src="https://www.alliancevirtualoffices.com/csr/images/order.png">&nbsp;Place order as this Customer
                </a>   
            </div>
            <div class="line">
                <span class="lh_fi mediumBold"> Customer's Files: </span>&nbsp;
                <div class="formOinfo">
                    <div class="files-category-header">Customer's Files:</div> 
                    <div class="files-category">Identification</div>
                    <div class="files-category">Post Office Form</div>
                    <div class="files-category">Misc.</div>
                    <div class="files-category">CMRA</div>
                    <a href="">
                        <img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/upload.png"> Upload file for this customer
                    </a>
                </div>
            </div>
        </div>         
    </div>
    <div class="form_right">
        <!-- <div class="line">
            <span class="lh_fi mediumBold">
                Invoice / Account Options    
            </span>&nbsp;
            <div class="formOinfo">
                • <a href="?step=new-charge&amp;invoice=4309462"> Add extra charges to upcoming invoice</a> 
                (#<a href="" target="_blank">4309462</a>)
                <br>
                • <a href="">Add Recurring Charge or Credit to 4309462</a>
                <br>
                • <a href="">Manage Customer Balance</a>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                Customer Status    
            </span>&nbsp;
            <div class="formOinfo">
                Customer Admin Status:
                <select name="customer_status" style="float: right; margin-top: -8px;">
                    <option value="Active">Active</option>
                    <option value="Pending">Pending</option>
                    <option value="Hold" selected="selected">Hold</option>
                </select>
            </div>
        </div> 
        <div class="line">
            <span class="lh_fi mediumBold">
                Recurring Charging Status    
            </span>&nbsp;
            <div class="formOinfo">
                <div class="cerca" style="height: 35px; padding-top: 10px; background-color: red; color: white;">125402041
                    <select class="statusChange" name="recurring_status_125402041" style="float: right; margin-top: -8px;">
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
                <br>
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                Completed Invoice History    
            </span>&nbsp;
            <div class="formOinfo">
                <table border="0" cellspacing="3" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="100"><strong>Invoice</strong></td>
                            <td width="150"><strong>Invoice Date</strong></td>
                            <td width="150"><strong>Amount</strong></td>
                        </tr> 
                        <tr>
                            <td><a href="" target="V">125402041</a></td>
                            <td>April 28, 2011</td>
                            <td>$235.00</td>
                        </tr>   
                    </tbody>
                </table>  
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                Unpaid Invoice(s)    
            </span>&nbsp;
            <div class="formOinfo">
                <table border="0" cellspacing="3" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="100"><strong>Invoice</strong></td>
                            <td width="150"><strong>Date</strong></td>
                            <td width="150"><strong>Amount</strong></td>
                            <td width="100"><strong>Action</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                Next Invoice(s)    
            </span>&nbsp;
            <div class="formOinfo">
                <table border="0" cellspacing="3" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="100"><strong>Invoice</strong></td>
                            <td width="150"><strong>Invoice </strong></td>
                            <td width="150"><strong>Amount</strong></td>
                            <td width="100"><strong>Action</strong></td>
                        </tr>
                        <tr>
                            <td><a href="" target="V">4309462</a></td>
                            <td>December 31, 1969</td>
                            <td>$322.88</td>
                            <td> </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                DNC History:
            </span>&nbsp;
            <div class="formOinfo">
                
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                Recurring Charges:
            </span>&nbsp;
            <div class="formOinfo">
                
            </div>
        </div> -->
    </div>
    
    <div class="bBox_btns">
       
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>
    </div>
@stop
