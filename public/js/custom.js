$(document).on('ready', function()
{
	var map_drawn = false;
	all_addresses = JSON.parse(all_addresses);
	$(".listViewBtn").on('click', function()
	{
		$('.TheResult').show();
		$('.result-map-view').hide();
		$(this).parents('a').addClass('toggleActive');
		$('.mapViewBtn').parents('a').removeClass('toggleActive');
	});

	$(".mapViewBtn").on('click', function()
	{
		$('.result-map-view').show();
		$('.TheResult').hide();
		$(this).parents('a').addClass('toggleActive');
		$('.listViewBtn').parents('a').removeClass('toggleActive');
		if(!map_drawn)
		{
			map_drawn = true;
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': full_city }, function(results, status)
			{

				var map = new google.maps.Map(document.getElementById('map-canvas'),  {center: results[0].geometry.location, zoom: 10 });
				var circle = new google.maps.Circle({
				  map: map,
				  radius: 1609.344 * 25,    // 10 miles in metres
				  fillColor: '#f9f9f9'
				});
				var iconBase = '/images/';
				var mark = new google.maps.Marker(
				{
					position: results[0].geometry.location,
					icon: iconBase + 'marker-icon.png',
					map: map,
				})
				//circle.bindTo('center', mark, 'position');
				mark.setMap(null);
				
				for(var k in all_addresses)
				{
					//var address = all_addresses[k];
					(function(address){
						geocoder.geocode({'address': address.address}, function(res, stat)
						{
							if(stat === 'OK')
							{
								var marker = new google.maps.Marker(
								{
									position: res[0].geometry.location,
									map: map,
									icon: iconBase + 'marker-icon.png',
									title: address.address
								});

								 

								marker.addListener('click', function()
								{
									console.log(results);
									$.ajax({
										method : "GET",
										data : {center_type: $('#center_type').val()},
										url : '/ajax/centers/' + address.id,
										success : function(data)
										{
											var infowindow = new google.maps.InfoWindow(
											{
											    content: //"<div class='img_cont'><img src='http://www.abcn.com/images/photos/"+data.photo_path+"'></div><div class='text_cont'><h3>"+data.building_name+"</h3><div>"+data.address1+" "+data.city+", "+data.us_state+"</div><button class='popover_btn'><a class='linkBubble' href='"+data.url+"'>MORE INFO</a></button></div>"
												'<div class="info2">'+
													'<div class="info-body">'+
														'<a href="'+data.more_info_link+'" target="_blank">'+
															'<img src="'+data.image_src+'" class="info-img" alt="'+data.image_alt+'">'+
														'</a>'+
													'</div>'+
													'<div class="infoBuble2">'+
														'<h3>'+data.title+'</h3>'+
														'<div class="mapsPopupContent">'+data.address+'</div>'+
															'<a href="'+data.more_info_link+'" target="_blank" class="linkBubble">'+
																'<div id="btnBubble">MORE INFO</div>'+
															'</a>'+
														'</div>'+
													'</div>'+
												'</div>'
											});
											infowindow.open(map, marker);
										}
									})
								})
							}
							
						})
					}(all_addresses[k]))
					
				}
				
			})
		}
		

			
		});
	});