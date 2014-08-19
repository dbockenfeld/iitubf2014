$(document).ready(function() {
    $(window).scroll(sticky_lock);
    sticky_lock();
});
function sticky_lock() {
    var window_top = $(window).scrollTop()+50;
    var div_top = $('#lock-anchor').offset().top;
    if (window_top > div_top) {
        $('.audio-box').addClass('lock-box');
    } else {
        $('.audio-box').removeClass('lock-box');
    }
}