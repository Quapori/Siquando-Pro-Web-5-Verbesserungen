(function ($) {
    'use strict';
    $.fn.ngSFXPop = function () {
        $(this).each(function () {
            var container = $(this),
                image = container.children('img'),
                lastScroll = 0,
                w = $(window),
                ticking = false,
                zoom = 0.7;

            function ease(x) {
                return x < 0.5 ? 2 * x * x : 1 - Math.pow(-2 * x + 2, 2) / 2;
            }

            function place() {
                var containertop = container.offset().top,
                    windowheight = w.height(),
                    newzoom = Math.min(1, Math.max(0, (lastScroll + windowheight - containertop) / windowheight));

                newzoom = 0.7 + ease(newzoom) * 0.3;

                if (newzoom != zoom) {
                    zoom = newzoom;
                    image.css('transform', 'scale3d(' + zoom + ',' + zoom + ',1)');
                }
            }

            function requestPlace() {
                lastScroll = w.scrollTop();

                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        place();
                        ticking = false;
                    });

                    ticking = true;
                }
            }

            w.on('scroll', requestPlace);
            w.on('resize', requestPlace);
            w.on('load', requestPlace);

            place();

        });

    };
})(jQuery);

$(document).ready(function () {
    $('.ngparasfxpop').ngSFXPop();
});
