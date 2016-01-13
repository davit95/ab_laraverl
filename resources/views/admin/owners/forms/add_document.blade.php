@extends('admin.layouts.layout')

@section('page-header')
	Add Document
@stop
@section('content_top')
    <div class="ct_icon_od"></div> 
    <div class="ct_wrapp">
        <div class="ct_title"><h1>OWNERS DOCS</h1></div> 
        <div class="ct_tools">
            <p class="h1Desc">Upload general documents by owner type.</p>
            <div class="clear"></div>
        </div> 
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>
@stop
@section('content')   
   <form class="ownersForm">
   <div class="w_box lh_f addmoreGfiles">
   <div class="ga_right left">
   <div class="upload_file_w"><a href="#" class="upload_file_btn medium">Upload File</a></div> &nbsp; &nbsp; No file chosen
   </div> 
   <div class="ga_right right">
   <span class="lh_f">Member Type:</span>&nbsp;
   <div class="g_select">
   <div class="g_select2">
   <select class="f1_s">
   <option value="">Select</option>
   <option value="all">All Members</option>
   <option value="prefered members">Preferred Members</option>
   <option value="performance members">Performance Members</option>
   <option value="AVO participation only members">AVO Participation Only Location</option>
   </select>
   </div> 
   </div> 
   </div> 
   <div class="clear"></div>
   </div> 
   <div class="add_box">
   <a id="moreGfiles" class="gLink"><div class="txtLink">ADD FILE</div><div class="gIcon gAdd"></div></a>
   <div class="clear"></div>
   </div> 
   <div class="submit_w"><a href="#" class="submit_btn">SUBMIT</a></div>
   </form>   
@stop

@section('styles')    
@stop

@section('scripts')
    
@stop