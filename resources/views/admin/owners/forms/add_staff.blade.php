@extends('admin.layouts.layout')

@section('page-header')
	Add Staff
@stop
@section('content_top')
    <div class="ct_icon_add"></div> 
    <div class="ct_wrapp">
      <div class="ct_title"><h1>STAFF MEMBERS</h1></div> 
      <div class="ct_tools">
        <p class="h1Desc">Bala Plaza Business Center, 101 Lindenwood Drive, Suite 225, Malvern, PA</p>
      </div> 
    </div> 
    <div class="clear"></div>
@stop
@section('content')   
    <form class="ownersForm">
      <div class="addstaffMember">
        <div class="w_box lh_f">
          <div class="form_left">
            First Name: <input type="text" class="f1" name="staffFirstname"><br>
            Last Name: <input type="text" class="f1" name="staffLastname"><br>
            Title: <input type="text" class="f1" name="staffTitle">
          </div> 
          <div class="form_right">
            Email: <input type="email" class="f1" name="staffEmail"><br>
            Phone: <input type="text" class="f1a" name="staffPhone"> Ext. <input type="text" class="f2" name="staffExt"><br>
            Phone: <input type="text" class="f1a" name="staffPhone2"> Ext. <input type="text" class="f2" name="staffExt">
          </div> 
          <div class="clear"></div>
        </div> 
      </div>
      <div class="add_box">
        <a id="addstaffMember" class="gLink"><div class="txtLink">ADD STAFF</div><div class="gIcon gAdd"></div></a>
        <div class="clear"></div>
      </div> 
      <div class="submit_w">
        <a href="#" class="btn submit_btn">SUBMIT</a>
      </div>
    </form>
@stop