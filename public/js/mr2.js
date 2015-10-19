$(function() {
    function updateTotal(Mroom) {
        $('.total').html('');
        var total = 0;

        $('#hor-minimalist-b tr:visible:has(:checked)').each(function() {
            if ($(this).hasClass('service') && $(this).attr('rate')) {
                total += parseInt($(this).attr('rate')) * parseInt($(this).find('.duration').val());
            } else {
                total += parseInt($(this).attr('cost'));
            }
        });
        $('tr.Mroom[Mroom="' + Mroom + '"] .total').html('<span class="convert">$' + total.toString() + '</span>');
    };

    $(':checkbox').click(function() {
		
        updateTotal($(this).parents('tr').attr('Mroom'));
		
		 if($("span:contains('£')").length > 1) {
				$("span:contains('$')").each(
						function(index, element) {
							$(element).html($(element).html().replace('$', ''));
						});
						$('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert1.php', decimals: 2 });
				} 
				else {
					
				};
				
			if($("span:contains('€')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert2.php', decimals: 2 });
						$("span:contains('$')").each(
							function(index, element) {
								$(element).html($(element).html().replace('$', ''));
							});
							
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });	
				} 
				else {
					
				};
				
				
				if($("span:contains('$')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'USD', convertFrom: 'GBP', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'USD', convertFrom: 'EUR', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
				} 
				else {
					
				};
				
				
				
				
		
				
			
    });

    $('select.duration').change(function() {
        updateTotal($(this).parents('tr').attr('Mroom'));
		
		if($("span:contains('£')").length > 1) {
				$("span:contains('$')").each(
						function(index, element) {
							$(element).html($(element).html().replace('$', ''));
						});
						$('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert1.php', decimals: 2 });
				} 
				else {
					
				};
				
			if($("span:contains('€')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert2.php', decimals: 2 });
						$("span:contains('$')").each(
							function(index, element) {
								$(element).html($(element).html().replace('$', ''));
							});
							
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });	
				} 
				else {
					
				};
				
				
				if($("span:contains('$')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'USD', convertFrom: 'GBP', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'USD', convertFrom: 'EUR', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
				} 
				else {
					
				};
				
    });


   $(':radio').click(function() {
	   
        if (!$(this).val()) return;
        var tr = $(this).parents('tr');
        var Mroom = tr.attr('Mroom');

        $('#hor-minimalist-b tr').removeClass('selected');
        $('tr.service').removeClass('visible').hide();
        $('tr.service[Mroom="' + Mroom + '"]').addClass('visible').show();
        $(this).parents('tr').addClass('selected');
        updateTotal(Mroom);
		
		if($("span:contains('£')").length > 1) {
				$("span:contains('$')").each(
						function(index, element) {
							$(element).html($(element).html().replace('$', ''));
						});
						$('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'GBP', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert1.php', decimals: 2 });
				} 
				else {
					
				};
				
			if($("span:contains('€')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert2.php', decimals: 2 });
						$("span:contains('$')").each(
							function(index, element) {
								$(element).html($(element).html().replace('$', ''));
							});
							
						$('.convert').currency({ region: 'EUR', convertFrom: 'USD', convertLocation: 'http://www.alliancevirtualoffices.com/convert3.php', decimals: 2 });	
				} 
				else {
					
				};
				
				
				if($("span:contains('$')").length > 1) {
				$("span:contains('£')").each(
						function(index, element) {
							$(element).html($(element).html().replace('£', ''));
						});
						$('.convert').currency({ region: 'USD', convertFrom: 'GBP', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
						$("span:contains('€')").each(
							function(index, element) {
								$(element).html($(element).html().replace('€', ''));
							});
							
						   $('.convert').currency({ region: 'USD', convertFrom: 'EUR', convertLocation: 'http://www.alliancevirtualoffices.com/convert4.php', decimals: 2 });
				} 
				else {
					
				};
				
    });

});