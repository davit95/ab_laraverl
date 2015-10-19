$(function() {
    function updateTotal(Mroom) {
        $('.total').html('');
        var total = 0;

        $('#hor-minimalist-b tr:visible:has(:checked)').each(function() {
            if ($(this).hasClass('service') && $(this).attr('rate')) {
                total += parseInt($(this).attr('rate')) * parseInt($(this).find('.duration').val());
            } else {
                total += parseInt($(this).attr('cost'))
            }
        });
        $('tr.Mroom[Mroom="' + Mroom + '"] .total').html('$' + total.toString());
    };

    $(':checkbox').click(function() {
        updateTotal($(this).parents('tr').attr('Mroom'));
    });

    $('select.duration').change(function() {
        updateTotal($(this).parents('tr').attr('Mroom'));
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
    });

});