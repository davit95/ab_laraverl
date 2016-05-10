
    $(document).on('ready', function(){
        $('.change').niceselect();
    })




function getLatAndLng(){
    var state = $( "#states option:selected" ).text();
    var country = $( "#countries option:selected" ).text();
    var city = $('#city').val();
    var address = city + ' ' + state + ' ' + country;
    $.ajax({
      url: "http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
      type: "POST",
      success: function(res){
         $('#lat').val(res.results[0].geometry.location.lat);
         $('#lng').val(res.results[0].geometry.location.lng);
      }
    });
} 

    $('.show_plp_package').on('click', function(){
        if($(this).prop('checked')) {
            $('.pl_plus').removeClass('hide');
            $('.pl_plus_form').removeClass('hide');
        } else {
            $('.pl_plus').addClass('hide');
            $('.pl_plus_form').addClass('hide');
        }
    })

    $.each([1,2,3,4,5,6],function(i, val){
        $('.txtLink2' + val).css('cursor', 'pointer');
        $('.txtLink2' + val).on('click', function(){
            if($('#hide' + val).hasClass('hide')) {
                $('#hide' + val).removeClass('hide');
            } else {
                $('#hide' + val).addClass('hide');
            }
        })
    })
    $.each([1,2,3,4,5,6],function(i, val){
        $('.rule_d' + val).change(function(){
            $.post('/alts-and-captions', {category:$(this).val(), center_city: $('#city').val()}, function(data){
                var rand_int = Math.floor(3*Math.random());
                console.log($('.rule_d' + val).attr('name'));
                var alt = data.alts[0][rand_int];
                var caption = data.caps[0][rand_int];
                $('#photo_2_avo_alt' + $('.rule_d' + val).attr('name').substr($('.rule_d' + val).attr('name').length - 1)).val(alt);
                $('#photo_2_avo_caption' + $('.rule_d' + val).attr('name').substr($('.rule_d' + val).attr('name').length - 1)).val(caption);
            })
        })
    })
    if($('#city').val() !== '') {
        $('.center_photos').removeClass('hide');
        $('.center_photos').addClass('show');
    }

    $('#city').on('change', function(){
        var city = $('#city').val();
        if(city !== '') {
            $('.center_photos').removeClass('hide');
            $('.center_photos').addClass('show');
        } else {
            $('.center_photos').removeClass('show');
            $('.center_photos').addClass('hide');
        }
    })
