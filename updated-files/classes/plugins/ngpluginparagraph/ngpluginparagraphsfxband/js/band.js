(function ($) {
    'use strict';
    $.fn.ngSFXBand = function () {
        $(this).each(function () {
            var stage = $(this),
                container = stage.children('div'),
                images = container.children('img'),
                size = parseFloat(stage.attr('data-size')) / 100,
                effect = parseInt(stage.attr('data-effect')),
                gutter = parseInt(stage.attr('data-gutter')),
                inertia = parseInt(stage.attr('data-inertia')),
                stagewidth = 0,
                stageheight = 0,
                w = $(window),
                lastScroll = 0,
                ticking = false,
                i;

            for (i = 0; i < images.length; i++) {
                var image = images.eq(i);
                image.data('ratio', parseFloat(image.attr('width')) / parseFloat(image.attr('height')));
            }


            function place() {
                stagewidth = stage.width();
                stageheight = Math.floor(Math.max(stagewidth, w.height()) * size);

                var x = 0, i;

                stage.css({
                    'height': stageheight + 'px'
                });

                for (i = 0; i < images.length; i++) {
                    var image = images.eq(i),
                        picturewidth = Math.floor(stageheight * image.data('ratio'));

                    image.css({
                        'left': x + 'px',
                        'top': '0',
                        'width': picturewidth + 'px',
                        'height': stageheight + 'px',
                    });

                    x += picturewidth;

                    if (i < images.length - 1) x += gutter;
                }

                container.css({
                    'height': stageheight + 'px',
                    'width': x + 'px'
                });
            }

            function requestSetOffset() {
                lastScroll = w.scrollTop();

                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        setOffset();
                        ticking = false;
                    });

                    ticking = true;
                }
            }

            function setOffset() {
                var stagetop = stage.offset().top,
                    windowheight = w.height(),
                    offset = Math.min(1, Math.max(0, (lastScroll + windowheight - stagetop) / (windowheight + stageheight)));

                if (effect > 0) offset--;

                var shift = offset * stagewidth * effect / 100;

                container.css('transform', 'translate3d(' + shift + 'px,0,0)');
            }


            place();
            place();
            setOffset();

            container.height();

            if (inertia>0) container.css('transition','transform '+inertia+'ms ease-out');

            w.on('resize', function () {
                place();
                place();
                setOffset();
            });

            w.on('scroll', requestSetOffset);


        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparasfxband').ngSFXBand();
});