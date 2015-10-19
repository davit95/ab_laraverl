$(function()
{
	
	$( ".btnPlans" ).click(function(e) {
		//alert()
		e.preventDefault();
	   //$( ".RplansBox" ).show();
	   $(this).parents('.TheResult').find(".RplansBox").show();
	  });
	  
	  $( ".RPBtop" ).click(function() {
	   //$( ".RplansBox" ).hide();
	   $(this).parents('.RplansBox').hide();
	  });
	  $( ".RPBplan1" ).click(function() {
	   $(this).parent().prev().prev().prev().prev(".PlanFt1").show();
	  });
	  $( ".RPBplan2" ).click(function() {
	   $(this).parent().prev().prev().prev(".PlanFt2").show();
	  });
	  $( ".RPBplan3" ).click(function() {
	   $(this).parent().prev().prev(".PlanFt3").show();
	  });
	  $( ".RPBplan4" ).click(function() {
	   $(this).parent().prev(".PlanFt4").show();
	  });
	  $( ".RPBtop2" ).click(function() {
	   $(this).parent().parent().hide();
	  });
})