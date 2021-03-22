(function ($) {
    'use strict';
    $.fn.sqrNav = function () {
        $(this).each(function () {

            var nav = $(this),
                showNav = nav.find('.sqrnavshow'),
                hideNav = nav.find('.sqrnavhide'),
                allItems = nav.find('li:has(ul)'),
                lastitem,
                doubleClickTimeout,
                doubleclick = false,
                scrolled = false;

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

            function handleScroll() {
                if ($(window).scrollTop() > 138) {
                    if (!scrolled) {
                        $('.sqrtopcontainer').addClass('sqrpicascrolled');
                        scrolled = true;
                    }
                } else {
                    if (scrolled) {
                        $('.sqrtopcontainer').removeClass('sqrpicascrolled');
                        scrolled = false;
                    }
                }
            }

            nav.find('li.active').parents('li').addClass('active');
            allItems.addClass('sqrnavmore').children('a').on('click', handleClick);
            showNav.on('click', handleShowNav);
            hideNav.on('click', handleHideNav);
            $(document).on('click touchstart', handleClose);

            $(window).scroll(handleScroll);
            handleScroll();
        });
    };

    $.fn.sqrPicaSlider = function () {
        var header = $(this),
            container = $(this).children('.sqreyecatcherimagecontainer'),
            bullets = header.children('.sqreyecatcherbulletcontainer').children('a'),
            images = new Array(),
            offset = 0,
            mainEyecatcher = container.children('img').eq(0),
            secEyecatcher,
            autoProgress = parseInt(header.attr('data-autoprogress'), 10),
            autoProgessTimer = null;

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

            $(image).on('load', function () {
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

        function sizeHeader() {
            var fullHeight = Math.floor(header.width() / 3);

            header.css('height', fullHeight + 'px');
            container.css('height', fullHeight + 'px');
        }


        if (bullets.length > 0) {
            bullets.eq(0).addClass('active');

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
    }


})(jQuery);


$(document).ready(function () {
    $('.sqrnav').sqrNav();
    $('.sqreyecatcher').sqrPicaSlider();
});
