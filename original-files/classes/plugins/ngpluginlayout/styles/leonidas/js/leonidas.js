(function ($) {
    'use strict';

    $.fn.sqrFixMenu = function() {
        var w = $(window),
            h = $('html'),
            fixed = false;

        function setFixed() {
            var newfixed = (w.scrollTop() > 100);

            if (newfixed !== fixed) {
                fixed = newfixed;

                if (fixed) {
                    h.addClass('sqrfixedmenu');
                } else {
                    h.removeClass('sqrfixedmenu');
                }
            }

        }

        w.on('scroll', setFixed);
        w.on('resize', setFixed);

    };

    $.fn.sqrLeonidasSlider = function () {
        var header = $('#sqrheader'),
            container = $('#headercontainer'),
            bullets = $('#headersliderbullets').children('a'),
            images = [],
            offset = 0,
            mainEyecatcher = container.children('img,video').eq(0),
            secEyecatcher,
            autoProgress = parseInt(header.attr('data-autoprogress'), 10),
            autoProgessTimer = null,
            speed = parseInt(header.attr('data-speed')),
            size = parseInt(header.attr('data-size'), 10);


        function performAutoProgress() {
            offset++;

            if (offset > bullets.length - 1) {
                offset = 0;
            }

            setOffset(false);
        }

        function start() {
            if (autoProgress > 0) {
                if (autoProgessTimer !== null) {
                    stop();
                }
                autoProgessTimer = window.setTimeout(performAutoProgress, autoProgress * 1000);
            }
        }

        function stop() {
            if (autoProgessTimer !== null) {
                window.clearTimeout(autoProgessTimer);
                autoProgessTimer = null;
            }
        }

        function sizeHeader() {

            var width = header.width(),
                height = Math.floor(($(window).height() - 30 - 100 ) * size / 100);


            header.css('height', height + 'px');

            var picturewidth = width,
                pictureheight = Math.ceil(picturewidth * 9 / 16);

            if (pictureheight < height) {
                pictureheight = height;
                picturewidth = Math.floor(pictureheight * 16 / 9);
            }

            var left = -Math.floor((picturewidth - width) / 2),
                top = -Math.floor((pictureheight - height) / 4);

            container.css({
                'width': picturewidth + 'px',
                'height': pictureheight + 'px',
                'left': left + 'px',
                'top': top + 'px'
            });
        }

        function setOffset(loading) {
            var url = bullets.eq(offset).attr('href');

            bullets.removeClass('active').eq(offset).addClass('active');

            if (typeof secEyecatcher === 'undefined') {
                secEyecatcher = $('<img>', {
                    class: 'headerslidersecin'
                });
                mainEyecatcher.after(secEyecatcher);
            }

            var image = new Image();

            mainEyecatcher.removeClass('headerslidersec headerslidersecout');
            mainEyecatcher.addClass('headersliderpri');
            secEyecatcher.removeClass('headersliderpri headerslidersecout');
            secEyecatcher.addClass('headerslidersec');

            secEyecatcher[0].offsetHeight;
            mainEyecatcher[0].offsetHeight;


            $(image).on('load', function () {
                secEyecatcher.attr('src', url);
                secEyecatcher[0].offsetHeight;
                secEyecatcher.addClass('headerslidersecout');

                var swap = mainEyecatcher;
                mainEyecatcher = secEyecatcher;
                secEyecatcher = swap;
                start();
            });
            $(image).attr('src', url);
        }

        if (bullets.length > 0) {
            bullets.eq(0).addClass('active');
            mainEyecatcher.after(secEyecatcher);

            bullets.bind('click', function (e) {
                stop();
                e.preventDefault();
                offset = $(this).index();
                setOffset(true);
            });

            $(window).load(start);

        }

        if (header.length > 0) {
            sizeHeader();
            sizeHeader();
            $(window).on('resize', sizeHeader);
        }
    };


    $.fn.sqrNav = function () {
        $(this).each(function () {

            var nav = $(this);
            var showNav = nav.find('.sqrnavshow');
            var hideNav = nav.find('.sqrnavhide');
            var allItems = nav.find('ul').find('li:has(div)');
            var lastitem;
            var doubleClickTimeout;
            var doubleclick = false;

            function handleClick(e) {

                if (lastitem === this && doubleclick) return;

                if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);

                doubleclick = true;

                doubleClickTimeout = window.setTimeout(function () {
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
})(jQuery);

$(document).ready(function () {
    $('.sqrnav').sqrNav();
    $('#sqrheader').sqrLeonidasSlider();
    $('.sqrtopspacer').sqrFixMenu();
});