(function($) {
    'use strict';
    $.fn.sqwPluginEndless = function() {
        $(this).each(function() {
            var that = $(this),
                stage = that.children('.sqwpluginendlessstage'),
                container = stage.children('ul'),
                items = container.children('li'),
                images = container.find('img'),
                height = parseInt(that.attr('data-height')),
                overlay = that.children('.sqwpluginendlessoverlay'),
                nextLink = overlay.children('.sqwpluginendlessnav:last'),
                nextCaption = nextLink.children('span'),
                prevLink = overlay.children('.sqwpluginendlessnav:first'),
                prevCaption = prevLink.children('span'),
                currentLink = overlay.children('.sqwpluginendlesscurrent'),
                currentCaption = currentLink.children('span'),
                autoChange = parseInt(that.attr('data-autochange')),
                fontSize = parseInt(that.attr('data-fontsize')),
                timeOutA, timeOutB, timeOutAuto,
                bulletsContainer = that.children('.sqwpluginendlessbullets'),
                bullets,
                current = 0;

            function offset(change) {
                var value = current + change;

                if (value < 0) value = value + items.length;
                if (value > items.length - 1) value = value - items.length;

                return value;
            }

            function animateNext(e) {
                if (e !== undefined) e.preventDefault();
                startAuto();
                current = offset(1);
                setActiveBullet();
                placeContainers('next');

            }

            function animatePrev(e) {
                if (e !== undefined) e.preventDefault();
                startAuto();
                current = offset(-1);
                setActiveBullet();
                placeContainers('prev');
            }

            function placeImage(container, width, outerWidth, height, animate) {
                var image = container.find('img'),
                    imageWidth = parseInt(image.attr('width')),
                    imageHeight = parseInt(image.attr('height')),
                    ratio = imageWidth / imageHeight,
                    newWidth = width,
                    newHeight = Math.floor(newWidth / ratio);

                if (newHeight < height) {
                    newHeight = height;
                    newWidth = Math.floor(newHeight * ratio);
                }

                var newLeft = Math.floor((outerWidth - newWidth) / 2),
                    newTop = Math.floor((height - newHeight) / 2);

                if (animate) {
                    image.css('transition', 'transform 0.4s ease');
                } else {
                    image.css('transition', 'transform 0s');
                }

                image.css({
                    'width': newWidth + 'px',
                    'height': newHeight + 'px',
                    'transform': 'translate3d(' + newLeft + 'px,0,0)',
                    'top': newTop + 'px'
                });
            }

            function placeContainers(animation) {
                var containerWidth = that.width(),
                    teaserWidth = Math.floor(containerWidth / 10),
                    currentWidth = containerWidth - 2 * teaserWidth,
                    containerHeight = Math.floor(($(window).height() - 40) * height / 100),
                    i;

                if (teaserWidth < 42) teaserWidth = 42;

                container.css({
                    'height': containerHeight + 'px'
                });

                for (i = 0; i < items.length; i++) {
                    if (i === offset(-2) || i === offset(-1) || i === current || i === offset(1) || i === offset(2)) {
                        items.eq(i).css('display', 'block');
                    } else {
                        items.eq(i).css('display', 'none');
                    }
                }

                if (animation === 'next' || animation === 'prev') {
                    placeImage(items.eq(current), currentWidth, currentWidth, containerHeight, true);
                    items.eq(current).css('transition', 'transform 0.4s ease, width 0.4s ease');
                } else {
                    placeImage(items.eq(current), currentWidth, currentWidth, containerHeight, false);
                    items.eq(current).css('transition', 'transform 0s, width 0s');
                }

                items.eq(current).css({
                    'width': containerWidth + 'px',
                    'height': containerHeight + 'px',
                    'z-index': '0',
                    'transform': 'translate3d(' + teaserWidth + 'px,0,0)'
                });

                if (animation === 'next' || animation === 'prev') {
                    items.eq(offset(1)).css('transition', 'transform 0.4s ease, width 0.4s ease');
                    placeImage(items.eq(offset(1)), currentWidth, teaserWidth, containerHeight, true);
                } else {
                    items.eq(offset(1)).css('transition', 'transform 0s, width 0s');
                    placeImage(items.eq(offset(1)), currentWidth, teaserWidth, containerHeight, false);
                }

                items.eq(offset(1)).css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px',
                    'z-index': '1',
                    'transform': 'translate3d(' + (containerWidth - teaserWidth) + 'px,0,0)'
                });

                if (animation === 'prev') {
                    items.eq(offset(2)).css('transition', 'transform 0.4s ease, width 0.4s ease');
                    placeImage(items.eq(offset(2)), currentWidth, teaserWidth, containerHeight, true);
                } else {
                    items.eq(offset(2)).css('transition', 'transform 0s, width 0s');
                    placeImage(items.eq(offset(2)), currentWidth, teaserWidth, containerHeight, false);
                }

                items.eq(offset(2)).css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px',
                    'z-index': '2',
                    'transform': 'translate3d(' + containerWidth + 'px,0,0)'
                });

                if (animation === 'next' || animation === 'prev') {
                    items.eq(offset(-1)).css('transition', 'transform 0.4s ease, width 0.4s ease');
                    placeImage(items.eq(offset(-1)), currentWidth, teaserWidth, containerHeight, true);
                } else {
                    items.eq(offset(-1)).css('transition', 'transform 0s, width 0s');
                    placeImage(items.eq(offset(-1)), currentWidth, teaserWidth, containerHeight, false);
                }

                items.eq(offset(-1)).css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px',
                    'z-index': '1',
                    'transform': 'translate3d(0,0,0)'
                });

                if (animation === 'next') {
                    items.eq(offset(-2)).css('transition', 'transform 0.4s, width 0.4s');
                    placeImage(items.eq(offset(-2)), currentWidth, teaserWidth, containerHeight, true);
                } else {
                    items.eq(offset(-2)).css('transition', 'transform 0s, width 0s');
                    placeImage(items.eq(offset(-2)), currentWidth, teaserWidth, containerHeight, false);
                }

                items.eq(offset(-2)).css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px',
                    'z-index': '2',
                    'transform': 'translate3d(-' + teaserWidth + 'px,0,0)'
                });

                nextLink.css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px',
                    'left': containerWidth - teaserWidth + 'px'
                });

                prevLink.css({
                    'width': teaserWidth + 'px',
                    'height': containerHeight + 'px'
                });

                var currentSize = Math.floor(currentWidth * (fontSize + 1) / 100);

                if (currentSize < 20) currentSize = 20;
                if (currentSize > 71) currentSize = 71;

                currentLink.css({
                    'width': currentWidth + 'px',
                    'height': containerHeight + 'px',
                    'left': teaserWidth + 'px',
                    'font-size': currentSize + 'px'
                });

                if (animation === 'next') {
                    currentLink.css({
                        'opacity': '0',
                        'transform': 'translate3d(40px,0,0)',
                        'transition': 'opacity 0s, transform 0s'
                    });
                }

                if (animation === 'prev') {
                    currentLink.css({
                        'opacity': '0',
                        'transform': 'translate3d(-40px,0,0)',
                        'transition': 'opacity 0s, transform 0s'
                    });
                }

                if (animation === 'prev' || animation === 'next') {
                    nextLink.css({
                        'transition': 'opacity 0s, transform 0s',
                        'opacity': '0',
                        'transform': 'translate3d(40px,0,0)'
                    });
                    prevLink.css({
                        'transition': 'opacity 0s, transform 0s',
                        'opacity': '0',
                        'transform': 'translate3d(-40px,0,0)'
                    });
                }

                nextCaption.text(images.eq(offset(1)).attr('alt'));
                prevCaption.text(images.eq(offset(-1)).attr('alt'));
                currentCaption.text(images.eq(current).attr('alt'));

                if (items.eq(current).children('a').length > 0) {
                    currentLink.attr('href', '#');
                } else {
                    currentLink.removeAttr('href');
                }

                if (animation === 'next' || animation === 'prev') {

                    if (timeOutA !== undefined) window.clearTimeout(timeOutA);

                    window.setTimeout(function() {
                        currentLink.css({
                            'transition': 'opacity 0.3s ease, transform 0.3s ease',
                            'opacity': '1',
                            'transform': 'translate3d(0,0,0)'
                        });
                        timeOutA = undefined;
                    }, 400);

                    if (timeOutB !== undefined) window.clearTimeout(timeOutB);

                    window.setTimeout(function() {
                        nextLink.css({
                            'transition': 'opacity 0.2s ease, transform 0.2s ease',
                            'opacity': '1',
                            'transform': 'translate3d(0,0,0)'
                        });
                        prevLink.css({
                            'transition': 'opacity 0s ease, transform 0.2s ease',
                            'opacity': '1',
                            'transform': 'translate3d(0,0,0)'
                        });
                        timeOutB = undefined;
                    }, 300);
                }
            }

            function handleClick(e) {
                e.preventDefault();
                var link = items.eq(current).children('a');

                if (link.length > 0) link[0].click();
            }

            function createBullets() {
                var i;

                for (i = 0; i < items.length; i++) {
                    var bullet = $('<div>');
                    bulletsContainer.append(bullet);
                }

                bulletsContainer.css('width', (items.length * 20) + 'px');

                bullets = bulletsContainer.children();
            }

            function setActiveBullet() {
                bullets.removeClass('sqwpluginendlessbulletactive');
                bullets.eq(current).addClass('sqwpluginendlessbulletactive');
            }

            function startAuto() {
                if (autoChange > 0) {
                    if (timeOutAuto !== undefined) window.clearInterval(timeOutAuto); {
                        timeOutAuto = window.setTimeout(function() {
                            animateNext(undefined);
                        }, autoChange * 1000);
                    }
                }
            }

            placeContainers('');
            createBullets();
            setActiveBullet();

            $(window).on('resize', function() {
                placeContainers('');
                placeContainers('');
            });

            nextLink.on('click', animateNext);
            prevLink.on('click', animatePrev);
            currentLink.on('click', handleClick);

            $(window).on('load', function() {
                placeContainers('');
                startAuto();
            });
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.sqwpluginendless').sqwPluginEndless();
});
