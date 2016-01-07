$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();

    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#sticky').addClass('stick');
            $('.acResults').addClass('stick');
        } else {
            $('#sticky').removeClass('stick');
            $('.acResults').removeClass('stick');            
            $('.acResults').css('top',div_top + 92 + 'px');
        }
    }
});