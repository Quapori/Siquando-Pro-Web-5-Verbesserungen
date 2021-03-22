(function ($) {
    'use strict';
    $.fn.ngSFXOneOfMany = function () {
        $(this).each(function () {
            var stage = $(this),
                container = stage.children('div'),
                column1 = stage.find('.ngparasfxoneofmanycolumn1'),
                column2 = stage.find('.ngparasfxoneofmanycolumn2'),
                column3 = stage.find('.ngparasfxoneofmanycolumn3'),
                columns = container.children('div'),
                img1 = stage.find('.ngparasfxoneofmanyimg1'),
                img2 = stage.find('.ngparasfxoneofmanyimg2'),
                lastScroll = 0,
                ticking = false,
                effect = parseInt(stage.attr('data-effect')),
                padding = parseInt(stage.attr('data-padding')),
                ratio = parseFloat(stage.attr('data-ratio')),
                w = $(window),
                nosticky = container.css('position') !== 'sticky',
                mode = 't';

            function ease(x) {
                return 1 - (1 - x) * (1 - x);
            }

            function position() {
                var width = Math.ceil(columns.width()),
                    height = Math.ceil(width / ratio),
                    max = 0,
                    c, i;

                for (c = 0; c < columns.length; c++) {
                    var column = columns.eq(c),
                        images = column.children('img'),
                        columnheight = images.length * height,
                        y = 0;

                    if (columnheight > max) max = columnheight;

                    column.css('height', columnheight + 'px');

                    for (i = 0; i < images.length; i++) {
                        var image = images.eq(i);

                        image.css({
                            'top': (y + padding) + 'px',
                            'left': padding + 'px',
                            'width': (width - 2 * padding) + 'px',
                            'height': (height - 2 * padding) + 'px'
                        });

                        y += height;
                    }
                }

                stage.css('height', (max + effect) + 'px');
            }

            function place() {
                var stagetop = stage.offset().top,
                    windowheight = w.height(),
                    newoffset = (lastScroll - stagetop) / effect,
                    newmode = 'f';

                if (newoffset < 0) {
                    newoffset = 0;
                    newmode='t';
                }
                if (newoffset > 1) {
                    newoffset = 1;
                    newmode='b';
                }

                if (nosticky && mode!=newmode) {
                    mode=newmode;
                    switch (mode) {
                        case 'f':
                            container.css({
                                'position':'fixed',
                                'top':'0',
                                'bottom':'auto',
                                'left': stage.offset().left+'px',
                                'width': stage.width()+'px'
                            });
                            break;
                        case 't':
                            container.css({
                                'position':'absolute',
                                'top':'0',
                                'bottom':'auto',
                                'left': '0',
                                'width': '100%'
                            });
                            break;
                        case 'b':
                            container.css({
                                'position':'absolute',
                                'top':'auto',
                                'bottom':'0',
                                'left': '0',
                                'width': '100%'
                            });
                            break;
                    }
                }

                newoffset = ease(newoffset);

                var scale = 2.5 - newoffset * 1.5;

                img2.css('opacity', newoffset);
                img1.css('transform', 'scale3d(' + scale + ',' + scale + ',1)');
                column3.css('transform', 'translate3d(0,' + Math.floor((effect - newoffset * effect)) + 'px,0');
                column2.css('transform', 'translate3d(0,' + Math.floor((effect / 2 - newoffset * effect / 2)) + 'px,0');
                column1.css('transform', 'translate3d(0,' + Math.floor((effect / 4 - newoffset * effect / 4)) + 'px,0');
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
            w.on('resize', function () {
                position();
                place();
            });

            position();
            place();

        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparasfxoneofmany').ngSFXOneOfMany();
});