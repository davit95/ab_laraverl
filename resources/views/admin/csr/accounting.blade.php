@extends('admin.csr.layouts.layout')
@section('content')

<div class="row">
	<div class="col-xs-8 col-xs-offset-2 text-center dataTable_wrapper accounting-buttons-cont">
		<div><a class="btn btn-lg btn-default" href="{{url('/charge')}}" class="btnsAccount">Charge Screen</a></div>
		<div><a class="btn btn-lg btn-default" href="{{url('/csr-declined')}}" class="btnsAccount">Unpaid Invoices</a></div>
		<div><a class="btn btn-lg btn-default" href="{{url('/csr-pending-mrs')}}" class="btnsAccount">Pending Meeting Room Invoices</a></div>
		<div><a class="btn btn-lg btn-default" href="https://www.alliancevirtualoffices.com/csr/index.php?step=owner-summary-report" class="btnsAccount">Owner Summary Report</a></div>
		<div><button style="outline: 0;cursor:pointer;border: 0;color: #fff;padding: 10px 20px;font-size: 20px;border-radius: 5px;background-color:#2759B1; " class="appointedd-booking-popover" ap-appid="56defb419089be603a8b4573">Book now</button></div>
	</div>
</div>
<!-- <center>
	<table width="985" border="0" align="top" cellpadding="0" cellspacing="0" bgcolor="#f4f4f4" class="ContentTable">
		<tr>
			<td valign="top">
				<div>
					<div style="width: 900px; margin: 15px auto 0 auto; text-align: left;"><br><br>
						<a href="https://www.alliancevirtualoffices.com/csr/charge.php" class="btnsAccount">Charge Screen</a><br><br>
						<a href="https://www.alliancevirtualoffices.com/csr/declined.php" class="btnsAccount">Unpaid Invoices</a><br><br>
						<a href="https://www.alliancevirtualoffices.com/csr/pending-mrs.php" class="btnsAccount">Pending Meeting Room Invoices</a><br><br>
						<a href="https://www.alliancevirtualoffices.com/csr/index.php?step=owner-summary-report" class="btnsAccount">Owner Summary Report</a>
						<button style="outline: 0;cursor:pointer;border: 0;color: #fff;padding: 10px 20px;font-size: 20px;border-radius: 5px;background-color:#2759B1; margin-left: 390px; margin-top: 25px;" class="appointedd-booking-popover" ap-appid="56defb419089be603a8b4573">Book now</button> <script data-rocketsrc="//s3-eu-west-1.amazonaws.com/appointedd-portal-assets/popover/appointedd-button.min.js" type="text/rocketscript"></script>
					</div> 
				</div>
			</td>
		</tr>
	</table>
</center> -->
@stop
@section('scripts')
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"71ec62ab54a1203281ca112e9ef5d14f",petok:"d9df47e57fb3e9f77da02501840c1ec902123b4b-1459778156-1800",zone:"alliancevirtualoffices.com",rocket:"a",apps:0,sha2test:0}];document.write('<script type="text/javascript" src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=e982913d31/cloudflare.min.js"><'+'\/script>');}}catch(e){};
//]]>
</script>
<script type="text/rocketscript">
		<!--
		function MM_openBrWindow(theURL,winName,features) { //v2.0
		  window.open(theURL,winName,features);
		}
		//-->
		</script>


<script data-rocketsrc="jquery-1.1.3.1.pack.js" type="text/rocketscript"></script>
<script data-rocketsrc="thickbox-compressed.js" type="text/rocketscript"></script>
@stop

@section('styles')
	<style type="text/css" media="all">@import "thickbox.css";</style>
@stop