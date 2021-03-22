(function ($) {
    'use strict';

    $.fn.sqrCeteraSlider = function() {
        var header = $('header');
        var container = $('#headercontainer');
        var bullets = $('#headersliderbullets').children('a');
        var images = new Array();
        var offset = 0;
        var mainEyecatcher = container.children('img').eq(0);
        var secEyecatcher;
        var autoProgress = parseInt(header.attr('data-autoprogress'), 10);
        var autoProgessTimer = null;
        var parallax = header.attr('data-parallax') === '1';

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
            var fullHeight = Math.floor(header.width() / 3 );

            header.css('height', fullHeight + 'px');
            container.css('height', fullHeight + 'px');
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

            if (loading) header.addClass('loading');

            $(image).on('load', function() {
                secEyecatcher.attr('src', url);
                secEyecatcher[0].offsetHeight;
                secEyecatcher.addClass('headerslidersecout');

                var swap = mainEyecatcher;
                mainEyecatcher = secEyecatcher;
                secEyecatcher = swap;
                start();
                header.removeClass('loading');

                $(image).off('load');
            });
            $(image).attr('src', url);
        }

        if (bullets.length > 0) {
            bullets.eq(0).addClass('active');

            bullets.bind('click', function(e) {
                stop();
                e.preventDefault();
                offset = $(this).index();
                setOffset(true);
            });

            $(window).load(start);

            $('#headersliderbullets').css({
                'width': bullets.length * 20 + 'px',
                'margin-left': (bullets.length * -10) + 'px'
            });

        }

        if (header.length > 0) {
            sizeHeader();
            sizeHeader();
            $(window).on('resize', sizeHeader);
        }
    }

    $.fn.sqrNav = function () {
        $(this).each(function () {

            var nav = $(this),
                showNav = nav.find('.sqrnavshow'),
                hideNav = nav.find('.sqrnavhide'),
                allItems = nav.children('ul').children('li:has(div)'),
                lastitem,
                menuOpen = false,
                doubleClickTimeout,
                doubleclick = false;

            function handleClick(e) {
                if (lastitem === this && doubleclick) return;

                if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);

                doubleclick = true;

                doubleClickTimeout = window.setTimeout(function () {
                    doubleclick = false;
                }, 1000);

                if ($(this).parent().hasClass('sqrnavopen')) {
                    $(this).parent('li').removeClass('sqrnavopen');
                    menuOpen = false;
                } else {
                    lastitem = this;
                    allItems.removeClass('sqrnavopen');

                    var li = $(this).parents('li');

                    li.addClass('sqrnavopen');
                    li.find('input').focus();

                    if (!menuOpen) {
                        menuOpen = true;

                        var div = $(this).parents('li').children('div');

                        div.css({
                            'opacity': '0'
                        });
                        div.height();
                        div.css({
                            'transition': 'opacity 0.3s ease',
                            'opacity': '1'
                        });
                    }
                }

                e.preventDefault();
                e.stopPropagation();
            }

            function isMobile() {
                return nav.children('ul').children('li').css('float') === 'none';
            }

            function handleClose(e) {
                if (!isMobile()) {
                    if ($(e.target).parents('.sqrnav').length === 0 || e.target.className==='sqrnavcenter') {
                        allItems.removeClass('sqrnavopen');
                        nav.removeClass('sqrnavopen');
                        lastitem = undefined;
                        doubleclick = false;
                        menuOpen = false;
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
    $('header').sqrCeteraSlider();
});