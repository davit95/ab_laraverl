<div class="w_box view_box" style="width:90%">

    <div class="form_left">
        
        <div class="line">
            <span class="lh_fi mediumBold">Invoice #: </span>&nbsp;
            <div class="formOinfo">
                <p>
                    <strong>
                        <a href="{{ ""  }}" target="V">
                            {{$invoice->customer->id}}
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
                {{$invoice->customer->first_name}} {{$invoice->customer->last_name}}<br>
                {{$invoice->customer->address1}}<br>
                <br>
                {{ (null != $invoice->customer->city ) ? $invoice->customer->city->name : ''}}, {{ (null != $invoice->customer->country) ? $invoice->customer->country->name : ''}} {{$invoice->customer->postal_code}} <br>
                {{$invoice->customer->email}} <br>
                Customer Type: AVO Direct <br>

            </p>
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold"></span>&nbsp;
            <div class="formOinfo">
                <p>
                    <a href="{{ url('customers/'.$invoice->customer->id.'/edit') }}">
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
                    {{-- @if($files)
                       @foreach($files as $file)
                           <a href="#">{{$file->path}}</a><br><br>
                       @endforeach
                   @endif --}}
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
                            {!! Form::open( [ 'url' => url('/customers/'.$invoice->customer->id.'/upload'), 'method' => 'POST', 'files' => true ]) !!}
                                {!! Form::label('Type of file :') !!}
                                {!! Form::select('file_category', ['Identification' => 'Identification', 'Post Office Form' => 'Post Office Form', 'Misc.' => 'Misc.'], null, ['class' => 'form-control', 'data-multi' => true]) !!}
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
                    <a href="{{ url('customers/'.$invoice->customer->id.'/file') }}">
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
                    <a href="/new_charge/{!!$invoice->customer->id!!}" title="Add AUX Charges to invoice # 125407282">
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

            <div class="line">
                <!-- <span class="lh_fi mediumBold">
                    <strong>Change Status:</strong>
                </span>&nbsp; -->
                {!! Form::open(  [ 'url' => url('/users/'.$invoice->customer->id), 'method' => 'DELETE', 'files' => true ]) !!}
                    <div class="formOinfo"> 
                         <input type="submit" class = "btn btn-primary" value="Cancel Order">
                    </div>
                {!!Form::close()!!}
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Invoice Amount:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <p> ${{$invoice->price}}</p>
                </div>
            </div>
            <div class="line">
                <span class="lh_fi mediumBold">
                    <strong>Charge Amount:</strong>
                </span>&nbsp;
                <div class="formOinfo">
                   <p> $ <input type="text" name="charge_amount" value="{{$invoice->price}}" style="width: 70px;">  (Prorated amount)</p>
                </div>
            </div>

            <div class="line">
                <span class="lh_fi mediumBold">
                    
                </span>&nbsp;
                <div class="formOinfo">
                    <p>
                        <a href = "{{ url('/invoices/'.$invoice->id.'/charge') }}" type="button" class = "btn btn-primary">Charge</a>&nbsp; &nbsp; &nbsp;
                        <a href = "{{ url('/csr') }}" type="button" class = "btn btn-info btn-lg" value="Cancel">Cancel</a>
                    </p>
                </div>
            </div>
        {!!Form::close()!!}

        <div class="line">
            <span class="lh_fi mediumBold">
                <hr>
                <strong>Changes Log:</strong>
            </span>&nbsp;
            <div class="formOinfo">
                <!-- <p> 
                    ISAAC<br>
                    March 28, 2016, 9:56 am<br>
                    Changed to close<br>
                    Comments: <br>
                </p> -->
            </div>
        </div>
        <div class="line">
            <span class="lh_fi mediumBold">
                <strong>DNC History:</strong>
            </span>&nbsp;
            <div class="formOinfo">
                
            </div>
        </div>
        
    </div> 
    
    <div class="bBox_btns">
       
        <div class="edit_oBtn bordL"><a href="{{ url('customers/'.$invoice->customer->id.'/edit') }}" class="gLink"><div class="sBox_icons edit_green"></div>edit customer's info</a></div>
    </div> 
    <div class="clear"></div>
</div>
</div>