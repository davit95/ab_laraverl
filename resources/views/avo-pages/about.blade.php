@extends('layout.layout')

@section('title')
    Virtual Office, Virtual Office Solutions from Alliance Virtual Offices
@stop

@section('content')
    <div class="aboutWrap">
    	<div class="aboutAwrap">
            <div class="AboutTxtWrap">
                <a class="active" href="{!! URL::action('AvoPagesController@about') !!}">ABOUT</a>
                &nbsp;
                &nbsp;
                <a href="{!! URL::action('AvoPagesController@management') !!}">MANAGEMENT AND STAFF</a>
            </div><!--/AboutTxtWrap-->
            <br><br>
            <div class="AboutTxtWrap AboutTxtBoxes">
                <h1>About Alliance Virtual Offices</h1>
                <br>
                <h2 class="gray2 mediumBold">WHAT WE OFFER</h2>
                <p>Alliance Virtual Offices combines three central components necessary to service mobile and work-from-home professionals:
                    <br><br>
                    <span class="mediumBold melon">PEOPLE - PLACE - TECHNOLOGY</span>
                    <br><br>
                    Simply stated, we deliver <span class="mediumBold">the complete virtual office</span>.
                    <br><br>
                    The overhead costs of setting up an office can be exorbitant, and we know that our clients would rather be making money than spending it unnecessarily. Our experienced, <span class="medium">professional live receptionists (People), on-demand offices (Place) and virtual phone system (Technology)</span> make it a breeze for our clients to operate flexibly and project a better, more professional image – all at unbeatable values.
                </p>
                <br><br>
                <h2 class="gray2 mediumBold">WHO WE ARE</h2>
                <p>
                    Started in 2010, <span class="medium">Alliance Virtual Offices</span> boasts a management team that collectively holds decades of virtual and alternative officing experience. Our front line of sales representatives, customer support and live answering teams has industry experience that rivals the management team. Whether you are trying to weigh various officing options or if you simply need help managing your virtual office, our committed and experienced team can help you get the most of your virtual office.
                </p>
                <br><br>
                <h2 class="gray2 mediumBold">OUR MISSION</h2>
                <p>
                    Our mission is to offer <span class="medium">the most complete, reliable and feature-rich set of virtual office services</span> to our global market of mobile professionals and work-from-home entrepreneurs. We know that we do not succeed unless our clients do, so Alliance strives to stay ahead bring our clients the best, new products and services at a great value.
                </p>
            </div>
         </div>
    </div>
@stop