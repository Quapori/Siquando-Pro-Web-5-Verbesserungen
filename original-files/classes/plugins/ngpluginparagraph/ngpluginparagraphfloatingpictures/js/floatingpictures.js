(function ($) {
    'use strict';
    $.fn.ngFloatingPictures = function () {
        $(this).each(function () {
            var stage = $(this),
                images = stage.children('img'),
                delay = parseInt(stage.attr('data-delay')),
                depht = parseInt(stage.attr('data-depht')),
                scale = (100 + depht) / 100,
                textsize = parseInt(stage.attr('data-textsize')),
                overlay = stage.children('span').children('span'),
                current = 0;


            function showNext() {
                current++;

                if (current > images.length - 1)
                    current = 0;

                var previous = current - 1;

                if (previous < 0) previous = images.length - 1;

                for (var i = 0; i < images.length; i++) {
                    if (i !== current && i !== previous) {
                        images.eq(i).css('visibility', 'hidden');
                    }
                }

                images.eq(current).css({
                    'visibility': 'visible',
                    'opacity': '0',
                    'transition': 'all 0s',
                    'transform': 'scale3d(1,1,1)',
                    'z-index': '1'
                });

                images.eq(previous).css({
                    'z-index': '0'
                });

                images.eq(current).offset();

                images.eq(current).css({
                    'transition': 'opacity 2s, transform ' + (delay + 2) + 's linear',
                    'transform': 'scale3d(' + scale + ',' + scale + ',1)',
                    'opacity': '1'
                });

                enqueueNext();

            }

            function enqueueNext() {
                window.setTimeout(showNext, delay * 1000);
            }

            function setFontSize() {
                var size = stage.width() / (18 - textsize * 2);

                overlay.css('font-size', size + 'px');
            }

            images.eq(0).css('visibility', 'visible');
            images.eq(0).offset();
            images.eq(0).css({
                'transition': 'transform ' + (delay + 2) + 's linear',
                'transform': 'scale3d(' + scale + ',' + scale + ',1)'
            });

            if (overlay.length > 0) {
                setFontSize();
                $(window).on('resize', setFontSize);
            }

            enqueueNext();
        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparafloatingpictures').ngFloatingPictures();
});
