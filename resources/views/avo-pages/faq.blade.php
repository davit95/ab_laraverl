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
                        </div><!--/centerForm-->
                    </div><!--/contactPhones2-->
                    <div class="cForm2">
                        <div class="centerForm2">
                            <h3>
                                INQUIRE ABOUT <span class="bold">VIRTUAL OFFICES</span>
                            </h3>
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
                        <div class="contactInformation faqs">
                            <h3 class="gray1">Frequently Asked Questions</h3>
                            <p>Our Virtual Offices include a variety of services and features at a great price. These frequently asked questions are for both those who already use the Alliance service and those are considering an Alliance Virtual Office. Select any question to view the full answer on this page. If you cannot find an answer to your question, please contact us at 888.869.9494.</p><br><br>
                            <p>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#1">I want a virtual office. Where do I start?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#2">What is an Alliance Virtual Office?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#3">What is a CMRA form and why do I need to complete it for my virtual office?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#4">What is a Virtual Phone System?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#5">How Does the Live Receptionist Service Work?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#6">How Does Alliance Count Live Answering Minutes?</a>
                                <br>
                                <img src="images/arrow3.gif" width="12" height="9" />
                                <a href="#7">How Does Alliance Count Virtual Phone System Minutes?</a>
                                <br>
                            </p>
                            <br>
                            <br>
                            <p class="mediumBold">
                                <a name="1" id="1"></a>
                                <span class="mediumBold gray1">I want a virtual office. Where do I   start? </span>
                            </p>
                            <p class="faq">
                                <span class="mediumBold gray2">Are you looking for only a live   receptionist to answer your calls?</span>
                                <br>
                                Then start by selecting one of our
                                <a href="{{ url('live-receptionist') }}" target="_blank">Live Receptionist</a> packages.
                                <br>
                                <br>
                            </p>
                            <p class="faq">
                                <span class="mediumBold gray2">Are you only   looking for an on-demand office?</span>
                                <br>
                                Then start by
                                <a href="{{ url('virtual-offices') }}" target="_blank">choosing a location</a>
                                <br>
                                <br>
                            </p>
                            <p class="faq">
                                <span class="mediumBold gray2">Are you looking for   both an on-demand office and a live receptionist?</span>
                                <br>
                                It's probably easiest to start by
                                <a href="{{ url('virtual-offices') }}" target="_blank">choosing a location</a>.
                                After you've chosen your location, we will prompt you to choose your   communications package.
                                <br>
                            </p>
                            <p class="faq">
                                <span class="mediumBold gray2">Still confused?</span>
                                Call us at 888.869.9494. We'd be glad to help.
                                <br>
                            </p>
                            <p class="mediumBold">
                                <a name="2" id="2"></a>
                                <span class="mediumBold gray1">What is an Alliance Virtual   Office?</span>
                            </p>
                            <p class="faq">
                                An Alliance Virtual Office combines   People, Place and Technology as the basis for a complete virtual office. These   essential elements offer mobile and work-from-home professionals an experienced   live receptionist to answer their phone, a place to meet or spend a day in a   professional office space and a start-of-the-art virtual phone system.
                                <br>
                            </p>
                            <p class="mediumBold">
                                <a name="3" id="3"></a>
                                <span class="mediumBold gray1">What is a CMRA form and why do I need to complete it for my virtual office?</span>
                            </p>
                            <p class="faq">CMRA stands for Commercial Mail Receiving Agency. Alliance Virtual Offices becomes your receiving agency when you become a client, and we adhere closely to the US Postal regulation that all of our clients who use one of our addresses in the United States complete, sign and notarize the
                                <a href="CMRA_form.pdf" target="_blank" style="color:#207F9F; text-decoration:underline; font-weight:bold;">CMRA form</a>.
                                This is a consumer protection to safeguard against fraudulent businesses, among other things.
                                <br>
                                Here is a step by step list on how to fill out the
                                <a href="CMRA_form.pdf" target="_blank" style="color:#207F9F; text-decoration:underline; font-weight:bold;">CMRA form</a>
                                boxes.
                            </p>
                            <ol class="faq" style="margin-top: 10px;">
                				<li>Print Date</li>
                				<li>Print your company name</li>
                				<li>(a,b,c, d) Leave this section blank- we will fill this section out</li>
                				<li>(a, b,c, d, e) Leave this section blank -we will fill this section out </li>
                				<li>Print your name if you would like the center to accept certified mail</li>
                				<li>Your Name</li>
                				<li>(a,b,c,d,e) Your home address (same address on your driver's license) </li>
                				<li>(a,b) 2 ID - One picture ID (example driver's license or passport) and One of the following are acceptable identifications:  include valid driver's license or state non-driver's identification card: armed forces, government, university, or recognized corporate identification card; passport, alien registration card or certificate of naturalization; current lease, mortgage or Deed of Trust, voter or vehicle registration card, or home or vehicle insurance policy.  IDs must match your home address.</li>
                				<li>Your Company Name</li>
                				<li>(a,b,c,d,e) Your current business address (if you do not have one,  list your home address again)</li>
                				<li>Type of Business</li>
                				<li>Fill in if applicable otherwise leave blank (for each name given we need 2 forms of ID)</li>
                				<li>Fill in if applicable otherwise leave blank (for each name given we need 2 forms of ID)</li>
                				<li>Fill in if applicable otherwise leave blank</li>
                				<li>Notary's signature and seal  (must be on this form) </li>
                				<li>Your signature</li>
                            </ol>
                            <p class="mediumBold">
                                <a name="4" id="4"></a>
                                <span class="mediumBold gray1">What is a Virtual Phone   System?</span>
                            </p>
                            <p class="faq">
                                A virtual phone system goes by many   names: VoIP phone, Virtual PBX, Virtual PBX Phone System, Small Business Phone System, etc. Whatever the name, our feature-rich virtual phone system allows users to set up a Fortune 500 type phone system for less. From conference calls   to dial by name directories, our phone system has it all. Best of all it can be   managed by a non-technical person through our intuitive web interface.
                                <br>
                            </p>
                            <p class="mediumBold">
                                <a name="5" id="5"></a>
                                <span class="mediumBold gray1">How Does the Live Receptionist   Service Work?</span>
                            </p>
                            <p class="faq">
                                Our experienced, professional live   receptionists have all been extensively trained to answer phones for a variety of companies, yet still answer each call in a personalized way. Once you are a client of Alliance, you can login to your Alliance management system and tell us   exactly how you want your phone to be answered. Give us explicit instructions on   how to answer your phone, where you are, where to reach you, etc. You can even   tailor our responses depending on who calls. Every time someone calls your number our software will display this information to our receptionists. Additionally, our receptionists get to know each of our clients (and their   frequent callers) and become familiar with the types of calls received. This   focus enables us to serve our clients better.
                                <br>
                            </p>
                            <p class="mediumBold">
                                <a name="6" id="6"></a>
                                <span class="mediumBold gray1">How Does Alliance Count Live Answering Minutes?</span>
                            </p>
                            <p class="faq">
                                Alliance counts Live Answering minutes by the second and we never round up!
                                <br>
                                You can view your Live Answering minutes in real-time through our client admin system.
                                <br>
                            </p>
                            <p class="mediumBold">
                                <a name="7" id="7"></a>
                                <span class="mediumBold gray1">How Does Alliance Count Virtual   Phone System Minutes?</span>
                            </p>
                            <p class="faq">
                                Alliance does not count any calls against our clients' minutes if they are 5 seconds or less. Other than that, our system counts 30 second increments so a 25 second call is 30 seconds and a 55 second call is counted as 1 minute. Please note that these minutes are counted separately from our Live Answering system.
                                <br>
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@stop