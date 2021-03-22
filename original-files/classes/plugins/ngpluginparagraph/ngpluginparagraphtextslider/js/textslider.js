(function($) {
    'use strict';
    $.fn.ngTextSlider = function() {
        $(this).each(function() {
            var container = $(this),
                ul = container.find('ul'),
                lis = container.find('li'),
                bullets,
                drag = false,
                lastx = 0,
                newx = 0,
                offset = 0,
                width,
                blockscroll = false,
                flicktimer,
                flick = false,
                dynamicheight = container.attr('data-dynamicheight') === 'true',
                index = 0;

            function size() {
                width = container.width();

                lis.css({
                    'width': width + 'px'
                });
                ul.css({
                    'width': (width * lis.length) + 'px',
                });

                setIndex(false);
            }

            function releaseFlick() {
                flick = false;
            }


            function handleStart(x) {
                drag = true;
                lastx = x;
                newx = lastx;
                blockscroll = false;
                flick = true;

                if (flicktimer !== undefined) clearTimeout(releaseFlick);

                setTimeout(releaseFlick, 250);
            }

            function handleEnd() {
                drag = false;

                if (flick && Math.abs(newx - lastx) > 50) {
                    if (newx > lastx) {
                        index--;
                    } else {
                        index++;
                    }
                } else {
                    index = Math.round((offset + lastx - newx) / width);
                }

                if (index < 0) index = 0;
                if (index > lis.length - 1) index = lis.length - 1;

                setIndex(true);
            }

            function setIndex(animate) {
                offset = index * width;

                ul.css({
                    'transition': (animate) ? 'transform 0.6s ease' : 'none',
                    'transform': 'translateX(' + (-offset) + 'px)'
                });

                if (dynamicheight) {
                    if (animate) {
                        window.setTimeout(function() {
                            container.css({
                                'transition': 'height 0.3s ease',
                                'height': lis.eq(index).height() + 'px'
                            });
                        }, 600);
                    } else {
                        container.css({
                            'transition': 'none',
                            'height': lis.eq(index).height() + 'px'
                        });
                    }
                }
                bullets.removeClass('ngparagraphtouchsliderbulletsactive').eq(index).addClass('ngparagraphtouchsliderbulletsactive');
            }

            function handleMove(x) {
                if (drag) {

                    newx = x;

                    var translate = offset + lastx - newx;
                    if (translate < 0) translate = 0;
                    if (translate > width * (lis.length - 1)) translate = width * (lis.length - 1);

                    ul.css({
                        'transition': 'none',
                        'transform': 'translateX(' + (-translate) + 'px)'
                    });

                    if (Math.abs(newx - lastx) > 50) blockscroll = true;
                }
            }

            function handleTouchEnd(e) {
                handleEnd();
            }

            function handleTouchMove(e) {
                if (e.originalEvent.touches.length == 1) {
                    handleMove(e.originalEvent.touches[0].pageX);
                    if (blockscroll && e.cancelable) e.preventDefault();
                }
            }

            function handleTouchStart(e) {
                if (e.originalEvent.touches.length == 1) {
                    handleStart(e.originalEvent.touches[0].pageX);
                    if (navigator.userAgent.indexOf('Android 4') !== -1) e.preventDefault();
                }
            }

            function handleMouseDown(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                handleStart(e.pageX);
            }

            function handleMouseMove(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                handleMove(e.pageX);
            }

            function handleMouseUp(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                handleEnd();
            }

            function createBullets() {
                var bulletsUl = $('<ul>', {
                    'class': 'ngparatextsliderbullets'
                });
                for (var i = 0; i < lis.length; i++) {
                    bulletsUl.append($('<li>'));
                }
                bulletsUl.css('width', lis.length * 25 + 'px');
                bulletsUl.insertAfter(container);
                bullets = bulletsUl.children('li');
            }

            function handleClick() {
                index = $(this).index();
                setIndex(true);
            }

            createBullets();
            bullets.on('click', handleClick);
            size();
            size();

            lis.on('mousedown', handleMouseDown);
            lis.on('mouseup', handleMouseUp);
            lis.on('mousemove', handleMouseMove);
            lis.on('touchstart', handleTouchStart);
            lis.on('touchend', handleTouchEnd);
            lis.on('touchmove', handleTouchMove);

            $(window).on('resize', size);
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparatextslider').ngTextSlider();
});
