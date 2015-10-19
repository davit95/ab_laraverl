/*
File: jquery.config.js
Media: screen
Copyright: (c) 2011 Brand Rich Media
Author: Brandon Neil Richards
Author URI: http://www.brandrichmedia.com/
*/

$(function() 
{
		

		
		//tabbed menu
		var tabContainers = $('#LR50, #LR100, #LR200');

		$('#tabs a').click(function () {
		        tabContainers.hide().filter(this.hash).show();

		        $('#tabs a').removeClass('selected');
		        $(this).addClass('selected');

		        return false;
		    }).filter(':first').click();	
		
		//open windows without embedding target="_blank"				
		$('a[rel="external"]').each(function() {
		$(this).attr('target', '_blank');
		});
		
		// remove value text in form fields
		// remove input text
				$('[rel="rmv"]').click(function() {
					if (this.value == this.defaultValue) {
						this.value = '';
					}
				});
				
				$('[rel="rmv"]').blur(function() {
					if (this.value == '') {
						this.value = this.defaultValue;
					}
				});
		// show hide
		//toggle sermon series summary
				$('#details').hide();
				$('.show-details').click(
				  function () {
				    $('#details').slideDown(600);
				    return false;
				});
		
		

	
});