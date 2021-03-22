(function ($) {
    'use strict';
    $.fn.ngSFXGallery = function () {
        $(this).each(function () {
            var stage = $(this),
                container = stage.children('div'),
                images = container.children('div'),
                lastScroll = 0,
                w = $(window),
                ticking = false,
                nosticky = container.css('position') !== 'sticky',
                offset = 0,
                zoom = 1,
                zoomfactor = parseInt(stage.attr('data-zoom')),
                mode = 't';


            stage.css('height',100*(images.length+1)+'vh');

            if (nosticky) {
                container.css('position', 'absolute');
            }

            function place() {
                var stagetop = stage.offset().top,
                    imageheight = images.eq(0).height(),
                    newoffset = Math.floor((lastScroll - stagetop) / imageheight),
                    newmode = 'f';

                if (newoffset < 0) {
                    newoffset = 0;
                    newmode = 't';
                }
                if (newoffset > images.length - 1) {
                    newoffset = images.length - 1;
                    newmode = 'b';
                }

                if (newmode != mode && nosticky) {
                    switch (newmode) {
                        case 'f':
                            container.css({
                                'position': 'fixed',
                                'top': '0',
                                'bottom': 'auto',
                                'left': container.offset().left+'px',
                                'width': container.width()+'px'
                            });
                            break;
                        case 't':
                            container.css({
                                'position': 'absolute',
                                'top': '0',
                                'bottom': 'auto',
                                'left': '0',
                                'width': '100%'
                            });
                            break;
                        case 'b':
                            container.css({
                                'position': 'absolute',
                                'top': 'auto',
                                'bottom': '0',
                                'left': '0',
                                'width': '100%'
                            });
                            break;
                    }
                }

                if (newoffset != offset) {

                    images.css({
                        'visibility': 'hidden',
                        'opacity': '0'
                    });
                    images.eq(newoffset).css({
                        'visibility': 'visible'
                    });
                    images.eq(newoffset).height();
                    images.eq(newoffset).css({
                        'opacity': '1'
                    });
                }

                var newzoom = 1 + (lastScroll - stagetop - imageheight * newoffset) / imageheight * zoomfactor/100;

                if (newzoom < 1) newzoom = 1;
                if (newzoom > 1+zoomfactor/100) newzoom = 1+zoomfactor/100;

                if (newzoom != zoom || newoffset != offset) {
                    images.eq(newoffset).css('transform', 'scale(' + newzoom + ')');
                }

                offset = newoffset;
                zoom = newzoom;
                mode = newmode;
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

            images.css({
                'visibility': 'hidden',
                'opacity': '0'
            });
            images.eq(0).css({
                'visibility': 'visible',
                'opacity': '1'
            });
        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparasfxgallery').ngSFXGallery();
});
