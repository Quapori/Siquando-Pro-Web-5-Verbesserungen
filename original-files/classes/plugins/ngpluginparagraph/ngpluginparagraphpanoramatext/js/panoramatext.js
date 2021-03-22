(function($) {
    'use strict';
    $.fn.ngPanoramaText = function() {
        $(this).each(function() {
            var that = $(this),
                fade = true;

            function handleScroll() {
                if (fade) {
                    var containerTop = that.offset().top,
                        containerHeight = that.height(),
                        windowheight = $(window).height(),
                        scrolltop = $(window).scrollTop();

                    if (containerTop + containerHeight / 3 < scrolltop + windowheight) {
                        that.addClass('ngparapanotextshow');
                        fade = false;
                    }
                }
            }

            $(window).on('scroll', handleScroll);
            $(window).on('load', handleScroll);

        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparapanotext').ngPanoramaText();
});
