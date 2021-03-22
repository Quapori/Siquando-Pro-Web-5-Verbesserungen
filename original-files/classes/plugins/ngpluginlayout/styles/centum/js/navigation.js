(function($) {
    'use strict';
    $.fn.sqrNav = function() {
        $(this).each(function() {

            var nav = $(this);
            var showNav = nav.find('.sqrnavshow');
            var hideNav = nav.find('.sqrnavhide');
            var allItems = nav.find('li:has(ul)');
            var lastitem;
            var doubleClickTimeout;
            var doubleclick = false;

            function handleClick(e) {

                if (lastitem === this && doubleclick) return;

                if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);

                doubleclick = true;

                doubleClickTimeout = window.setTimeout(function() {
                    doubleclick = false;
                }, 1000);

                if ($(this).parent().hasClass('sqrnavopen')) {
                    $(this).parent('li').removeClass('sqrnavopen');
                } else {
                    lastitem = this;
                    allItems.removeClass('sqrnavopen');
                    $(this).parents('li').addClass('sqrnavopen');
                    $(this).parent('li').find('input').focus();
                }

                e.preventDefault();
                e.stopPropagation();
            }

            function isMobile() {
                return nav.children('ul').children('li').css('float') === 'none';
            }

            function handleClose(e) {
                if (!isMobile()) {
                    if ($(e.target).parents('.sqrnav').length === 0) {
                        allItems.removeClass('sqrnavopen');
                        nav.removeClass('sqrnavopen');
                        lastitem = undefined;
                        doubleclick = false;
                        if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);
                    }
                }
            }

            function handleShowNav(e) {
                nav.addClass('sqrnavopen');
                e.preventDefault();
            }

            function handleHideNav(e) {
                nav.removeClass('sqrnavopen');
                e.preventDefault();
            }

            allItems.addClass('sqrnavmore').children('a').on('click', handleClick);
            showNav.on('click', handleShowNav);
            hideNav.on('click', handleHideNav);
            $(document).on('click touchstart', handleClose);

        });

    };

    $.fn.sqrEyecatcher = function() {
        $(this).each(function() {
            var stage = $(this),
                imgs = $(this).find('img'),
                ratio = parseInt(imgs.attr('width'), 10) / parseInt(imgs.attr('height')),
                shifter = $(this).find('.sqreyecatchershifter'),
                delay = parseInt(stage.attr('data-autoprogress'), 10) * 1000,
                offset = 0,
                bullets,
                height,
                handleInterval;

            function createBullets() {
                var bulletContainer = $('<div>', {
                    'class': 'sqreyecatcherbulletcontainer'
                }).css({
                    'margin-top': imgs.length * -12 + 'px'
                });


                stage.append(bulletContainer);

                for (var i = 0; i < imgs.length; i++) {
                    var bullet = $('<a>', {
                        'href': '#'
                    });
                    bulletContainer.append(bullet);
                }

                bullets = stage.find('a');
                bullets.on('click', handleBulletClick);

                setOffset();
            }

            function handleBulletClick(e) {
                e.preventDefault();
                offset = $(this).index();
                setOffset();
                start();
            }

            function setOffset() {
                bullets.removeClass('sqreyecatcherbulletactive').eq(offset).addClass('sqreyecatcherbulletactive');
                shifter.css({
                    'transition': 'transform 0.3s cubic-bezier(0.645, 0.045, 0.355, 1)'
                });
                shifter.css({
                    'transform': 'translate3d(0,' + (-offset * height + 'px') + ',0)'
                });
                imgs.css({
                    'opacity': '0'
                }).eq(offset).css({
                    'opacity': '1'
                });
            }

            function resize() {
                var width = Math.floor(stage.width());
                height = Math.floor(width / ratio);
                stage.css({
                    'height': height + 'px'
                });
                imgs.css({
                    'width': width + 'px',
                    'height': height + 'px'
                });
                shifter.css({
                    'transition': 'none',
                    'transform': 'translate3d(0,' + (-offset * height + 'px') + ',0)'
                });
                start();
            }

            function start() {
                if (delay > 0 && imgs.length > 1) {
                    stop();
                    handleInterval = window.setInterval(nextOffset, delay);
                }
            }

            function stop() {
                if (handleInterval !== undefined && delay > 0) {
                    window.clearInterval(handleInterval);
                    handleInterval = undefined;
                }
            }

            function nextOffset() {
                offset++;
                if (offset >= imgs.length) offset = 0;
                setOffset();
            }

            resize();
            resize();

            $(window).on('resize', function() {
                resize();
                resize();
            });

            if (imgs.length > 1) {
                createBullets();
                $(window).on('load', start);
            }
        });
    };

})(jQuery);

$(document).ready(function() {
    $('.sqrnav').sqrNav();
    $('.sqreyecatcher').sqrEyecatcher();
});
