<div class="w_box view_box" style="width:90%">

    <div class="form_left">
        
        <div class="line">
            <span class="lh_fi mediumBold">Invoice #: </span>&nbsp;
            <div class="formOinfo">
                <p>
                    <strong>
                        <a href="{{ url('invoice/'.$customer->id) }}" target="V">
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
                {{$customer->first_name}} {{$customer->last_name}}<br>
                {{$customer->address1}}<br>
                <br>
                {{ (null != $customer->city ) ? $customer->city->name : ''}}, {{ (null != $customer->country) ? $customer->country->name : ''}} {{$customer->postal_code}} <br>
                {{$customer->email}} <br>
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Upload File</button>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                            {!! Form::open( [ 'url' => url('/customers/'.$customer->id.'/upload'), 'method' => 'POST', 'files' => true ]) !!}
                                {!! Form::label('Type of file :') !!}
                                {!! Form::select('region', ['Identification', 'Post Office Form', 'Misc.'], null, ['class' => 'form-control', 'data-multi' => true]) !!}
                                <br>
                                {!! Form::label('Please choose a file :') !!}
                                {!! Form::file('file', null,[ 'class' => 'gray_btn']) !!} 
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Upload', array('class'=>'btn btn-primary')) !!}
                            <button type="button" class="btn btn-default icon" data-dismiss="modal">Close</button>
                        </div>
                            {!! Form::close() !!}
                            @include('alerts.messages')
                      </div>
                      
                    </div>
                  </div>
                <!-- <p>
                    <a href="{{ url('customers/'.$customer->id.'/file') }}">
                        <img class="icon" src="https://www.alliancevirtualoffices.com/csr/images/upload.png"> Upload file for this customer
                    </a>
                </p> -->
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
        {!! Form::open(  [ 'url' => url('/customers'), 'method' => 'POST', 'files' => true ]) !!}
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

            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Change Status:</strong>
                </span>&nbsp;
                <div class="formOinfo"> 
                     <input type="button" class = "btn btn-primary" value="Cancel Order">
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

                        @foreach($months as $key => $month)
                            @if($key == date('m', strtotime($customer->created_at)))
                                <option value="{{$key}}" selected="selected">{{$month}}</option>
                            @endif
                                <option value="{{$key}}">{{$month}}</option>
                        @endforeach
                    </select>
                   <!-- <select name="start_date_month">
                       <option value="">{{ date('M', strtotime($customer->created_at)) }} ({{ date('m', strtotime($customer->created_at)) }})</option>

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
                    </select>  -->
                    /
                    <select name="start_date_day">
                        <option value=""><!-- {{ date('d', strtotime($customer->created_at)) }} --></option>
                        @for($i = 1; $i <=31; $i++)
                            @if($i == date('d', strtotime($customer->created_at)))
                                <option value="{{$i}}" selected="selected">{{$i}}</option>
                            @endif
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    
                    </select>
                    /
                    <select name="start_date_year">
                        <option value=""></option>
                        @for($i = 2013; $i <=2020; $i++)
                            @if($i ==  date('Y', strtotime($customer->created_at)))
                                <option value="{{$i}}" selected="selected">{{ date('Y', strtotime($customer->created_at)) }}</option>
                            @endif
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>End Date:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                    <select name="end_date_month">
                        @foreach($months as $key => $month)
                            @if($key == date('m', $end_date))
                                <option value="{{$key}}" selected="selected">{{$month}}</option>
                            @endif
                                <option value="{{$key}}">{{$month}}</option>
                        @endforeach
                    </select>
                   <!-- <select name="start_date_month">
                       <option value="">{{ date('M',$end_date) }} ({{ date('m', $end_date) }})</option>
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
                    </select>  -->
                    /
                    <select name="end_date_day">
                        @for($i = 1; $i <=31; $i++)
                            @if($i == date('d', $end_date ))
                                <option value="{{$i}}" selected="selected">{{$i}}</option>
                            @endif
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    
                    </select>
                    /
                    <select name="end_date_year">
                       
                        @for($i = 2013; $i <=2020; $i++)
                            @if($i == date('Y',$end_date ))
                                <option value="{{$i}}" selected="selected">{{date('Y',$end_date )}}</option>
                            @endif
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Notification Date:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                    <select name="not_date_month">
                        @foreach($months as $key => $month)
                            @if($key == date('m', $not_date))
                                <option value="{{$key}}" selected="selected">{{$month}}</option>
                            @endif
                                <option value="{{$key}}">{{$month}}</option>
                        @endforeach
                    </select>
                   <!-- <select name="start_date_month">
                       <option value="">{{ date('M',$not_date) }} ({{ date('m', $not_date) }})</option>
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
                    </select>  -->
                    /
                    <select name="not_date_day">
                        <option value="">{{ date('d', $not_date ) }}</option>
                    @for($i = 1; $i <=31; $i++)
                        @if($i == date('d', $not_date ))
                            <option value="{{$i}}" selected="selected">{{date('d', $not_date )}}</option>
                        @endif
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    
                    </select>
                    /
                    <select name="not_date_year">
                        @for($i = 2013; $i <=2020; $i++)
                            @if($i == date('Y',$not_date ))
                                <option value="{{$i}}" selected="selected">{{date('Y',$not_date )}}</option>
                            @endif
                            <option value="{{$i}}">{{date('Y',$not_date )}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    
                </span>&nbsp;
                <div class="formOinfo">
                    <p>
                        <input type="submit" class = "btn btn-primary" name="Submit" value="Charge">&nbsp; &nbsp; &nbsp; 
                        <a href = "{{ url('/csr') }}" type="button" class = "btn btn-info btn-lg" value="Cancel">Cancel</a>
                    </p>
                </div>
            </div>
        {{Form::close()}}
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
        <div class="edit_oBtn bordL"><a href="{{ url('centers/'.$center->id) }}" class="gLink"><div class="sBox_icons edit_green"></div>show center</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>