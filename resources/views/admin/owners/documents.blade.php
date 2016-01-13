@extends('admin.layouts.layout')

@section('page-header')
	Add New Owner
@stop
@section('content_top')
	<div class="ct_icon_vod"></div> 
	<div class="ct_wrapp">
		<div class="ct_title"><h1>OWNERS DOCS</h1></div> 
		<div class="ct_tools">
			<p class="h1Desc">View general documents for owners.</p>
		</div> 
		</div> 
	<div class="clear"></div>
@stop
@section('content')
	<div class="h2wrapp mtop1">
		<div class="h2Icon edit"></div>
		<div class="h2txt">
			<h2>ALL MEMBERS DOCS</h2>
		</div>
	</div>
	<div class="w_box lh_f left">
		<input type="checkbox" name="allMembersFiles" value="VO" id="4">		
		<a href="#" class="gLink medium">File_name.pdf</a> <br>
		<input type="checkbox" name="allMembersFiles" value="VO" id="5">
		<a href="#" class="gLink medium">File_name2.pdf</a><br>
		<input type="checkbox" name="allMembersFiles" value="VO" id="10">		
		<a href="#" class="gLink medium">File_name5.pdf</a>
	</div>
	<div class="h2wrapp mtop1">
		<div class="h2Icon edit"></div>
		<div class="h2txt">
			<h2>PREFERRED MEMBERS DOCS</h2>
		</div>
	</div>
	<div class="w_box lh_f left">
		<input type="checkbox" name="allMembersFiles" value="VO" id="6"> 
		<a href="#" class="gLink medium">File_name3.pdf</a> <br>
		<input type="checkbox" name="allMembersFiles" value="VO" id="7"> 
		<a href="#" class="gLink medium">File_name4.pdf</a>
	</div>
	<div class="h2wrapp mtop1">
		<div class="h2Icon edit"></div>
		<div class="h2txt">
			<h2>AVO PARTICIPATION ONLY DOCS</h2>
		</div>
	</div>
	<div class="w_box lh_f left">
		No Files
	</div>
	<div class="remove_w">
		<button class="remove_btn btn">REMOVE SELECTED</button>
	</div>

@stop