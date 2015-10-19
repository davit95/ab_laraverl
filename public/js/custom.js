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
				var mark = new google.maps.Marker(
				{
					position: results[0].geometry.location,
					map: map,
				})
				//circle.bindTo('center', mark, 'position');
				mark.setMap(null);
				
				for(var k in all_addresses)
				{
					//var address = all_addresses[k];
					(function(address){
						console.log(address);
						geocoder.geocode({'address': address.address}, function(res, stat)
						{
							if(stat === 'OK')
							{
								var marker = new google.maps.Marker(
								{
									position: res[0].geometry.location,
									map: map,
									title: address.address
								});

								 

								marker.addListener('click', function()
								{
									
									$.ajax({
										method : "GET",
										url : '/ajax/centers/' + address.id,
										success : function(data)
										{
											//var center_info = JSON.parse(data);
											console.log(data);
											if(data.photos[0])
											{
												data.photo_path = data.photos[0].path;
											}
											else
											{
												data.photo_path = 'no_pic.gif';
											}
											var infowindow = new google.maps.InfoWindow(
											{
											    content: "<div class='img_cont'><img src='http://www.abcn.com/images/photos/"+data.photo_path+"'></div><div class='text_cont'><h3>"+data.building_name+"</h3><div>"+data.address1+" "+data.city+", "+data.us_state+"</div><button class='popover_btn'><a class='linkBubble' href='"+data.url+"'>MORE INFO</a></button></div>"
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