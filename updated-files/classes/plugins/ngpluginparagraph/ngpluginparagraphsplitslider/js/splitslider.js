(function ($) {
    'use strict';
    $.fn.sqwsplitslider = function () {
        $(this).each(function () {
            var that = $(this),
                container = that.find('.sqwpluginsplitsliderslider'),
                info = that.find('.sqwpluginsplitsliderinfo'),
                bulletscontainer = that.find('.sqwpluginsplitsliderbullets'),
                ul = container.find('ul'),
                imgs = container.find('img'),
                lis = container.find('li'),
                text = that.find('.sqwpluginsplitslidertext'),
                ratio = parseInt(imgs.attr('width'), 10) / parseInt(imgs.attr('height'), 10),
                autoChange = parseInt(that.attr('data-autochange')),
                interval,
                drag = false,
                lastx = 0,
                newx = 0,
                offset = 0,
                blockscroll = false,
                bullets,
                width,
                height,
                flicktimer,
                flick = false,
                index = 0;

            function size() {
                width = container.width();
                height = Math.floor(width / ratio);

                var outerheight = height;

                if (info.css('float') === 'none') {
                    outerheight = Math.floor($(window).height() / 2);
                    if (outerheight > height) outerheight = height;
                }

                container.css('height', outerheight);

                lis.css({
                    'width': width + 'px',
                    'height': height + 'px'
                });
                imgs.css({
                    'width': width + 'px',
                    'height': height + 'px'
                });
                ul.css({
                    'width': (width * lis.length) + 'px',
                    'height': outerheight + 'px',
                    'top': -Math.floor((height - outerheight) / 3) + 'px'
                });

                info.css('height', outerheight + 'px');

                setIndex(false, false);
            }

            function startAutoChange() {
                if (autoChange > 0) {
                    stopAutoChange();
                    interval = window.setInterval(handleAutochange, autoChange * 1000);
                }
            }

            function handleAutochange() {
                index++;

                if (index > lis.length - 1) index = 0;
                setIndex(true, true);
            }

            function stopAutoChange() {
                if (interval !== undefined) window.clearInterval(interval);
                interval = undefined;
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

                stopAutoChange();
            }

            function handleEnd() {
                drag = false;

                var newindex = index;
                var animateinfo = false;

                if (flick && Math.abs(newx - lastx) > 50) {
                    if (newx > lastx) {
                        newindex--;
                    } else {
                        newindex++;
                    }
                } else {
                    newindex = Math.round((offset + lastx - newx) / width);
                }

                if (newindex < 0) newindex = 0;
                if (newindex > lis.length - 1) newindex = lis.length - 1;

                if (newindex !== index) animateinfo = true;
                index = newindex;
                setIndex(true, animateinfo);

                startAutoChange();
            }

            function setIndex(animate, animateinfo) {
                offset = index * width;

                ul.css({
                    'transition': (animate) ? 'transform 0.3s ease' : 'none',
                    'transform': 'translateX(' + (-offset) + 'px)'
                });

                bullets.removeClass('sqwpluginsplitsliderbulletsactive').eq(index).addClass('sqwpluginsplitsliderbulletsactive');

                if (animateinfo) {
                    text.css({
                        'transition': 'transform 0.2s ease, opacity 0.2s ease',
                        'opacity': '1',
                        'transform': 'translate3d(0,0,0)'
                    });

                    text.height();

                    text.css({
                        'transform': 'translate3d(0,20px,0)',
                        'opacity': '0'
                    });

                    window.setTimeout(function () {

                        text.css({
                            'transition': 'transform 0s, opacity 0s',
                            'transform': 'translate3d(0,-20px,0)'
                        });

                        text.html(lis.eq(index).find('div').html());

                        text.height();

                        text.css({
                            'transition': 'transform 0.2s ease, opacity 0.2s ease',
                            'transform': 'translate3d(0,0,0)',
                            'opacity': '1'
                        });

                    }, 300);


                } else {
                    text.html(lis.eq(index).find('div').html());
                }

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

            function createBullets() {
                var bulletsUl = $('<ul>');
                for (var i = 0; i < lis.length; i++) {
                    bulletsUl.append($('<li>'));
                }
                bulletsUl.css('width', lis.length * 24 + 'px');
                bulletscontainer.append(bulletsUl);
                bullets = bulletsUl.children('li');
            }

            function handleClick() {
                index = $(this).index();
                setIndex(true, true);
                startAutoChange();
            }

            createBullets();
            size();

            imgs.on('touchstart', handleTouchStart);
            imgs.on('touchend', handleTouchEnd);
            imgs.on('touchmove', handleTouchMove);

            bullets.on('click', handleClick);
            $(window).on('resize', function () {
                size();
                size();
            });

            $(window).on('load', startAutoChange);
        });
    };
})(jQuery);

$(document).ready(function () {
    $('.sqwpluginsplitslider').sqwsplitslider();
});
