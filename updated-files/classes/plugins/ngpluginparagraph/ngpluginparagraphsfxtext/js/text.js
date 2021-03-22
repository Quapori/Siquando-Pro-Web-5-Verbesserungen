(function ($) {
    'use strict';
    $.fn.ngSFXText = function () {
        $(this).each(function () {
            var container = $(this),
                background = container.children('.ngparasfxtextbackground'),
                image = background.children('.ngparasfxtextimage'),
                topspacer = container.children('.ngparasfxtexttopspacer'),
                bottomspacer = container.children('.ngparasfxtextbottomspacer'),
                lastScroll = 0,
                w = $(window),
                ticking = false,
                nosticky = background.css('position') !== 'sticky',
                mode = 't';

            if (nosticky) {
                background.css('position', 'absolute');
                topspacer.css('display', 'block');
            }

            function place() {
                var containertop = container.offset().top,
                    containerheight = container.height(),
                    spacerheight = bottomspacer.height(),
                    newmode = 't';

                if (lastScroll > containertop) {
                    if (lastScroll > containertop + containerheight - spacerheight) {
                        newmode = 'b';
                    } else {
                        newmode = 'f';
                    }
                }

                if (mode != newmode) {
                    mode = newmode;
                    switch (mode) {
                        case 'f':
                            if (nosticky) {
                                background.css({
                                    'position': 'fixed',
                                    'top': '0',
                                    'bottom': 'auto',
                                    'left': container.offset().left+'px',
                                    'width': container.width()+'px'
                                });
                            }
                            image.css('opacity', '0.5');
                            break;
                        case 't':
                            if (nosticky) {
                                background.css({
                                    'position': 'absolute',
                                    'top': '0',
                                    'bottom': 'auto',
                                    'left': '0',
                                    'width': '100%'
                                });
                            }
                            image.css('opacity', '1');
                            break;
                        case 'b':
                            if (nosticky) {
                                background.css({
                                    'position': 'absolute',
                                    'top': 'auto',
                                    'bottom': '0',
                                    'left': '0',
                                    'width': '100%'
                                });
                            }
                            image.css('opacity', '1');
                            break;
                    }
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
        });

    };
})(jQuery);

$(document).ready(function () {
    $('.ngparasfxtextcontainer').ngSFXText();
});
