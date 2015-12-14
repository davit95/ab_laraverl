@extends('layout.layout')

@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
    <div class="intWrap">
        <div class="resutsTop">
            <div class="detailsTopWrap2">
                <div class="dformright radiusTop">
                    <div class="contactPhones2">
                        <div class="centerForm">
                            NORTH AMERICA:    +1 888.869.9494<br>
                			INTERNATIONAL:     +1 949.777.6340
                        </div>
                    </div>
                    <div class="cForm2">
                        <div class="centerForm2">
                            <h3>INQUIRE ABOUT <span class="bold">VIRTUAL OFFICES</span></h3>
                            {!! Form::open([ 'url' => url('sendcontact') , 'method' => 'post' ]) !!}
                                <div>
                                    {!! Form::label('name','Name', [ 'class' => $errors->has('name')?'label label-error':"label" ]) !!}
                                    {!! Form::text('name', null,[ 'class' => $errors->has('name')?'input-error':'' , 'required']) !!}
                                    @if($errors->has('name'))
                                        <small class="text-error-custom">{{ $errors->get('name')[0] }}</small>
                                    @endif
                                </div>
                                <div>
                                    {!! Form::label('email','Email', [ 'class' => $errors->has('email')?'label label-error':"label" ]) !!}
                                    {!! Form::email('email', null,[ 'class' => $errors->has('email')?'input-error':'' , 'required']) !!}
                                    @if($errors->has('email'))
                                        <small class="text-error-custom">{{ $errors->get('email')[0] }}</small>
                                    @endif
                                </div>
                                <div>
                                    {!! Form::label('company','Company', [ "class" => $errors->has('company')?'label label-error':"label" ]) !!}
                                    {!! Form::text('company', null,[ 'class' => $errors->has('company')?'input-error':'' , 'required']) !!}
                                    @if($errors->has('company'))
                                        <small class="text-error-custom">{{ $errors->get('company')[0] }}</small>
                                    @endif
                                </div>
                                <div>
                                    {!! Form::label('phone','Phone', [ "class" => $errors->has('phone')?'label label-error':"label" ]) !!}
                                    {!! Form::text('phone', null,[ 'class' => $errors->has('phone')?'input-error':'' , 'required']) !!}
                                    @if($errors->has('phone'))
                                        <small class="text-error-custom">{{ $errors->get('phone')[0] }}</small>
                                    @endif
                                </div>
                                <div>
                                    {!! Form::label('comments','Comments', [ "class" => $errors->has('comments')?'label label-error':"label" ]) !!}
                                    {!! Form::textarea('comments', null,[ 'class' => $errors->has('comments')?'input-error':'' , 'required']) !!}
                                    @if($errors->has('comments'))
                                        <small class="text-error-custom">{{ $errors->get('comments')[0] }}</small>
                                    @endif
                                </div>

                                <label for="label"><div class="label"><a href="{{ url('privacy-policy') }}" target="_blank" class="privateP">Privacy Policy</a></div></label>
                                <label for="submit"></label>
                                <button type="submit" id="submit2">SEND</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="descTopLeft">
                    <div class="wrapDescrip">
                        <div class="contactInformation">
                            <h3 class="gray3">CONTACT INFORMATION</h3><br>

                        		<div class="contact1">
                                    <span class="mediumBold gray1">North America</span>
                              		<p class="side_bio">International Corporate Headquarters<br />
                					   23 Corporate Plaza, Suite 150<br />
                					   Newport Beach, CA 92660,
                					   USA
                                    </p>
                              		<p>
                                        <span class="side_bio">
                                		    <span class="mediumBold smallLine">Email:</span>
                                            <a href="mailto:services@alliancevirtualoffices.com" class="aqua smallLine">services@alliancevirtualoffices.com</a>
                                        </span>
                                        <br>
                                	</p>
                                    <br>
                                    <p class="light">Contact Center Headquarters<br />
                					2831 St. Rose Parkway, Ste. 200<br />
                					Henderson, NV 89052,
                					USA</p>
                                </div>

                                <div class="contact2">
                                    <span class="mediumBold gray1">In Latin America</span>

                                    <p class="light">International Corporate Headquarters<br>
                					   23 Corporate Plaza, Suite 150<br>
                					   Newport Beach, CA 92660,
                					   USA
                                    </p>
                                    <p>
                                        <span class="side_bio">
                                            <span class="mediumBold">Phone:</span> +1 (949) 313 3409<br>
                                            <span class="mediumBold smallLine"> Email:</span>
                                            <a href="mailto:tmaeda@alliancevirtualoffices.com" class="aqua smallLine">tmaeda@alliancevirtualoffices.com</a>
                                        </span><br>
                                    </p>
                                </div><!--/contact2-->

                                <div class="contact3">
                                    <span class="mediumBold gray1">In Russia, Middle East and Africa</span>
                                    <p class="side_bio">4th Floor Block B, Entrance 2, Business Village <br />
                				        Dubai United Arab Emirates
                                    </p>
                                    <p class="side_bio"><span class="mediumBold">Phone:</span> +971 4 2535000<br />
                                        <span class="mediumBold smallLine">Email:</span>
                                        <a href="mailto:sherif@alliancevirtualoffices.com" class="aqua smallLine">sherif@alliancevirtualoffices.com </a>
                                    </p>
                                    <br>
                				</div>

                                <div class="contact4">
                                    <span class="mediumBold gray1">In Europe and the UK </span>
                                  	<p>Catalina Basaguren / Regional Sales<br>
                                        De Bouw 115<br>
                                        3991 SZ Houten, The Netherlands
                                    </p>
                                    <p>
                                        <span class="mediumBold">Phone:</span> +31 (0) 30 208 07 67 (Europe)<br>
                    				    <span class="mediumBold">Phone:</span> +44 203 514 1808 (UK)<br>
                                        <span class="mediumBold smallLine">Email:</span>
                                        <a href="mailto:catalina@alliancevirtualoffices.com" class="aqua smallLine">catalina@alliancevirtualoffices.com</a><br>
                                    </p>
                                </div>

                                <div class="contact5">
                                    <span class="mediumBold gray1">In Asia</span>
                                    <p>10/2 Hungerford Street Calcutta 700 017, India
                                    <p><span class="mediumBold">Phone:</span> + 91 (33) 4050 9200<br />
                                        <span class="mediumBold smallLine">Email:</span> <a href="mailto:svatcha@alliancevirtualoffices.com" class="aqua smallLine">svatcha@alliancevirtualoffices.com</a>
                                    </p>
                                </div>

                                <div class="contact6">
                                    <span class="mediumBold gray1">In Australia</span>
                                    <p class="side_bio">International Corporate Headquarters<br />
                					   23 Corporate Plaza, Suite 150<br />
                					   Newport Beach, CA 92660,
                					   USA
                                    </p>
                                    <p><span class="mediumBold">Toll Free:</span> +1 (800) 869 9595<br />
                                        <span class="mediumBold">Phone:</span> +1 (949) 313 3400<br/>
                                        <span class="mediumBold smallLine">Email:</span><a href="mailto:catalina@alliancevirtualoffices.com" class="aqua smallLine"> catalina@alliancevirtualoffices.com</a>
                                    </p>
                                </div>

                                <div class="ServiceHrs">
                                    <span class="mediumBold gray1">Customer Service Center:</span><br><br>
                                    <p>Monday-Friday from 8 a.m. - 8 p.m Eastern Time (US). You may also email us anytime at
                                        <a href="mailto:services@alliancevirtualoffices.com" class="aqua smallLine">services@alliancevirtualoffices.com</a>. <br/>Also check out our <a href="http://alliancevirtualoffices.com/service-holidays.php" class="melon">Holiday schedule</a>
                                        for our Live Receptionists and Customer Service Representatives.
                                    </p>
                			        <br><br>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
@stop