<div class="w_box view_box" style="width:90%">

    <div class="form_left">
        
        <div class="line">
            <span class="lh_fi mediumBold">Invoice #: </span>&nbsp;
            <div class="formOinfo">
                <p>
                    <strong>
                        <a href="" target="V">
                            {{$customer->id}}
                        </a>
                    </strong> &nbsp;
                    <a href="" target="V">
                        <img src="https://www.alliancevirtualoffices.com/external/images/Download-PDF.png">
                    </a>
                </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                <strong>Customer Information:</strong></span>&nbsp;
            <div class="formOinfo">
            <p>
                Isaac Vollaire<br>
                39 Sage Canyon Road<br>
                <br>
                Pomona, CA 91766 <br>
                ivollaire@abcn.com <br>
                Customer Type: AVO Direct <br>
            </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"></span>&nbsp;
            <div class="formOinfo">
                <p>
                    <a href="{{ url('customers/'.$customer->id.'/edit') }}">
                        <img class="icon" width="16" height="16" src="https://www.alliancevirtualoffices.com/csr/images/pencil.png" alt="Edit" title="Edit"> Edit Customer's Info
                    </a>
                </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Customer's Files </span>&nbsp;
            <div class="formOinfo">
                <div class="customer_files2">
                    <div class="files-category">Identification</div>
                    <ul> </ul> <div class="files-category">Post Office Form</div>
                    <ul> </ul> <div class="files-category">Misc.</div>
                    <ul> </ul> <div class="files-category">CMRA</div>
                    <ul> </ul> 
                </div>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"></span>&nbsp;
            <div class="formOinfo">
                <p>
                    <a href="">
                        <img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/upload.png"> Upload file for this customer
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="form_right">
        <div class="line">
            <span class="lh_fi mediumBold">
                Card Type: 
            </span>&nbsp;
            <div class="formOinfo">
                <img src="https://www.alliancevirtualoffices.com/csr/images/visa-icon.jpg" border="0">
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                
            </span>&nbsp;
            <div class="formOinfo">
                <p>
                    <a href="" title="Add AUX Charges to invoice # 125407282">
                        <img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/add.png" alt="Edit" title="Edit"> Add extra charges to invoice 125407282
                    </a>
                </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                <strong>Comments:</strong> 
            </span>&nbsp;
            <div class="formOinfo">
                <p>
                    <textarea name="comments"></textarea>
                </p>
            </div>
        </div>
        <form action="" name="form1" method="post">
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Change Status:</strong>
                </span>&nbsp;
                <div class="formOinfo"> 
                    <select name="status" onchange="mul_alert()">
                        <option value="">Please Select</option>
                        <option value="step1">Step 1: Contact Customer</option>
                        <option value="step2">Step 2: Received Documentation Back</option>
                        <option value="step3">Step 3: Received Confirmation from Center</option>
                        <option value="charge">Step 4: Charge Card</option>
                        <option value="">-------------------------------------</option>
                        <option value="close" selected="selected">Cancel Order</option>
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Invoice Amount:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <p> $104</p>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Charge Amount:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <p> $ <input type="text" name="charge_amount" value="38.17" style="width: 70px;">  (Prorated amount)</p>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Start Date:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <select name="start_date_month">
                       <option value=""></option>
                       <option value="01">January (01)
                       </option><option value="02">February (02)
                       </option><option value="03">March (03)
                       </option><option value="04" selected="selected">April (04)
                       </option><option value="05">May (05)
                       </option><option value="06">June (06)
                       </option><option value="07">July (07)
                       </option><option value="08">August (08)
                       </option><option value="09">September (09)
                       </option><option value="10">October (10)
                       </option><option value="11">November (11)
                       </option><option value="12">December (12)
                       </option>
                    </select> 
                    /
                    <select name="start_date_day">
                        <option value=""></option>
                    @for($i = 1; $i <=31; $i++)
                        @if($i == 19)
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                        @endif
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    
                    </select>
                    /
                    <select name="start_date_year">
                        <option value=""></option>
                        @for($i = 13; $i <=20; $i++)
                            @if($i == 16)
                                <option value="{{$i}}" selected="selected">20{{$i}}</option>
                            @endif
                            <option value="{{$i}}">20{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>End Date:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <select name="start_date_month">
                       <option value=""></option>
                       <option value="01">January (01)
                       </option><option value="02">February (02)
                       </option><option value="03">March (03)
                       </option><option value="04" selected="selected">April (04)
                       </option><option value="05">May (05)
                       </option><option value="06">June (06)
                       </option><option value="07">July (07)
                       </option><option value="08">August (08)
                       </option><option value="09">September (09)
                       </option><option value="10">October (10)
                       </option><option value="11">November (11)
                       </option><option value="12">December (12)
                       </option>
                    </select> 
                    /
                    <select name="start_date_day">
                        <option value=""></option>
                    @for($i = 1; $i <=31; $i++)
                        @if($i == 19)
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                        @endif
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    
                    </select>
                    /
                    <select name="start_date_year">
                        <option value=""></option>
                        @for($i = 13; $i <=20; $i++)
                            @if($i == 16)
                                <option value="{{$i}}" selected="selected">20{{$i}}</option>
                            @endif
                            <option value="{{$i}}">20{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Notification Date:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <select name="start_date_month">
                       <option value=""></option>
                       <option value="01">January (01)
                       </option><option value="02">February (02)
                       </option><option value="03">March (03)
                       </option><option value="04" selected="selected">April (04)
                       </option><option value="05">May (05)
                       </option><option value="06">June (06)
                       </option><option value="07">July (07)
                       </option><option value="08">August (08)
                       </option><option value="09">September (09)
                       </option><option value="10">October (10)
                       </option><option value="11">November (11)
                       </option><option value="12">December (12)
                       </option>
                    </select> 
                    /
                    <select name="start_date_day">
                        <option value=""></option>
                    @for($i = 1; $i <=31; $i++)
                        @if($i == 19)
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                        @endif
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    
                    </select>
                    /
                    <select name="start_date_year">
                        <option value=""></option>
                        @for($i = 13; $i <=20; $i++)
                            @if($i == 16)
                                <option value="{{$i}}" selected="selected">20{{$i}}</option>
                            @endif
                            <option value="{{$i}}">20{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    
                </span>&nbsp;
                <div class="formOinfo">
                    <p>
                        <input type="submit" name="Submit" value="Submit">&nbsp; &nbsp; &nbsp; 
                        <input type="button" value="Back" onclick="history.go(-1)">
                    </p>
                </div>
            </div>
        </form>
        <div class="line">
            <span class="lh_fi mediumBold">
                <hr>
                <strong>Changes Log:</strong>
            </span>&nbsp;
            <div class="formOinfo">
                <p> 
                    ISAAC<br>
                    March 28, 2016, 9:56 am<br>
                    Changed to close<br>
                    Comments: <br>
                </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                <strong>DNC History:</strong>
            </span>&nbsp;
            <div class="formOinfo">
                
            </div>
        </div>
        <!-- <div class="line">
            <span class="lh_fi mediumBold"></span>&nbsp;
            <div class="formOinfo"><a href="">Add extra charges to invoice {{ $customer->id }}</a></div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Comments:</span>&nbsp;
            <div class="formOinfo"><textarea></textarea></div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Charge Status:</span>&nbsp;
            <div class="formOinfo"><select><option>Cancel Order</option></select></div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Invoice Amount:</span>&nbsp;
            <div class="formOinfo"></div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">Charge Amount:</span>&nbsp;
            <div class="formOinfo"></div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"> Start Date: </span>&nbsp;
            <div class="formOinfo">
                <select>
                    <option>April (07)</option>
                </select> /
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"> End Date: </span>&nbsp;
            <div class="formOinfo">
                <select>
                    <option>April (07)</option>
                </select> /
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"> Notification Date: </span>&nbsp;
            <div class="formOinfo">
                <select>
                    <option>April (07)</option>
                </select> /
            </div>
        </div> -->
    </div> 
    
    <div class="bBox_btns">
       
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>