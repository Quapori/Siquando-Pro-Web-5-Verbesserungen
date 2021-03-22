(function ($) {
    'use strict';
    $.fn.ngSFXSplit = function () {
        $(this).each(function () {
            var stage = $(this),
                left = stage.hasClass('ngparasfxsplitleft'),
                images = stage.find('img'),
                displaystage = $('<div>').addClass('ngparasfxsplitdisplay').appendTo(stage),
                displaycontainer = $('<div>').appendTo(displaystage),
                displayimage = $('<div>').appendTo(displaycontainer),
                lastScroll = 0,
                w = $(window),
                ticking = false,
                offset = 0,
                zoom = 1,
                mode = 't';


            var nosticky = displaycontainer.css('position') !== 'sticky';

            setImage();
            setMode();

            function setMode() {
                if (nosticky) {
                    switch (mode) {
                        case 'f':
                            displaystage.css({
                                'position': 'fixed',
                                'left': stage.offset().left + (left ? 0 : Math.floor(stage.width() / 2)) + 'px',
                                'width': Math.floor(stage.width() / 2) + 'px'
                            });
                            displaycontainer.css({
                                'top': '0',
                                'bottom': 'auto',
                                'position': 'absolute'
                            });
                            break;
                        case 't':
                            displaystage.css({
                                'position': 'absolute',
                                'left': (left ? 0 : Math.floor(stage.width() / 2)) + 'px',
                                'width': '50%'
                            });
                            displaycontainer.css({
                                'top': '0',
                                'bottom': 'auto',
                                'position': 'absolute'
                            });
                            break;
                        case 'b':
                            displaystage.css({
                                'position': 'absolute',
                                'left': (left ? 0 : Math.floor(stage.width() / 2)) + 'px',
                                'width': '50%'
                            });
                            displaycontainer.css({
                                'position': 'absolute',
                                'bottom': '0',
                                'top': 'auto'
                            });
                            break;
                    }
                }
            }

            function setImage() {
                displayimage.css('background-image', 'url(' + images.eq(offset).attr('src') + ')');
            }

            function place() {
                var newoffset = (lastScroll - stage.offset().top) / displaycontainer.height(),
                    newmode = 'f';

                if (newoffset < 0) {
                    newoffset = 0;
                    newmode = 't';
                }
                if (newoffset > images.length - 1) {
                    newoffset = images.length - 1;
                    newmode = 'b';
                }

                if (newmode != mode) {
                    mode = newmode;
                    setMode();
                }

                newoffset = Math.round(newoffset);

                if (newoffset != offset) {

                    offset = newoffset;

                    setImage();
                    displayimage.css({
                        'transition': 'opacity 0s, transform 0s',
                        'visibility': 'hidden',
                        'opacity': '0',
                        'transform': 'scale3d(1.1,1.1,1)'
                    });
                    displayimage.height();
                    displayimage.css({
                        'transition': 'opacity 0.6s, transform 0.6s',
                        'visibility': 'visible',
                        'opacity': '1',
                        'transform': 'scale3d(1,1,1)'
                    });
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
    $('.ngparasfxsplit').ngSFXSplit();
});
