(function($) {
    $.fn.ngProtectedDownload = function() {
        if ($(this).length > 0) {
            var link = $(this).attr('data-sqprotecteddownloadlink'),
                delay = parseInt($(this).attr('data-sqprotecteddownloaddelay'));

            window.setTimeout(function() {
                window.location.replace(link);
            }, delay * 1000);
        }
    };
})(jQuery);

$(window).load(function() {
    $('div[data-sqprotecteddownloadlink]').ngProtectedDownload();
});
