(function($) {

    "use strict";

    $.fn.sqrNav = function() {
        $(this).each(function() {

            var nav = $(this),
                showNav = nav.find('.sqrnavshow'),
                hideNav = nav.find('.sqrnavhide'),
                items,
                ul = nav.find('ul'),
                ticking = false,
                scrollTop = 0,
                createUp = nav.attr('data-up') === 'true',
                offset = 0,
                speed = parseInt($('header').attr('data-speed'));

            function buildNav() {
                var anchors = $('[data-sqranchor]');

                for (var i = 0; i < anchors.length; i++) {
                    var uid = anchors.eq(i).attr('id');
                    var caption = anchors.eq(i).attr('data-sqranchor');

                    var li = $('<li>');
                    var a = $('<a>', {
                        href: '#' + uid
                    });
                    a.append(caption);
                    li.append(a);
                    ul.append(li);

                    if (createUp) {

                        var div = $('<div>', {
                            class: 'sqrallwaysboxed sqrtotop'
                        });

                        var sqrtotop = $('<a>', {
                            href: '#',
                            class: 'sqrtotop'
                        });

                        div.append(sqrtotop);

                        anchors.eq(i).append(div);
                    }
                }

                items = nav.find('li>a');

                if (items.length > 0) {
                    offset = nav.height();
                    $('.sqrcontent').css('padding-top', offset + 'px');
                    showNav.on('click', handleShowNav);
                    hideNav.on('click', handleHideNav);
                    items.on('click', handleClick);
                    $(window).on('scroll', handleScroll);
                } else {
                    nav.css('display', 'none');
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

            function handleClick(e) {
                e.preventDefault();
                nav.removeClass('sqrnavopen');
                var anchor = $(this).attr('href');
                var top = Math.floor($(anchor).offset().top) - offset - 10;
                $('html, body').animate({
                    scrollTop: top
                }, speed);
            }

            function handleScroll() {
                scrollTop = Math.ceil($(window).scrollTop());

                if (!ticking) {

                    if (scrollTop === 0) {
                        nav.removeClass('sqrscrolled');
                    } else {
                        nav.addClass('sqrscrolled');
                    }


                    setTimeout(function() {
                        var last = -1;

                        for (var i = 0; i < items.length; i++) {
                            var itemTop = $(items.eq(i).attr('href')).offset().top - offset - 20;
                            if (scrollTop >= itemTop) last = i;
                        }

                        items.removeClass('sqrnavactive');

                        if (last > -1) items.eq(last).addClass('sqrnavactive');

                        ticking = false;

                    }, 500);
                }

            }

            function handleToTop(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, speed);
            }

            buildNav();

            $('.sqrtotop').on('click', handleToTop);

        });

    };

    $.fn.sqrZegrabSlider = function() {
        var header = $('header'),
            container = $('#headercontainer'),
            bullets = $('#headersliderbullets').children('a'),
            images = [],
            offset = 0,
            mainEyecatcher = container.children('img,video').eq(0),
            secEyecatcher,
            autoProgress = parseInt(header.attr('data-autoprogress'), 10),
            autoProgessTimer = null,
            parallax = header.attr('data-parallax') === 'true',
            speed = parseInt(header.attr('data-speed')),
            small = header.attr('data-small') === 'true';


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

            var width = header.width();
            var height = $(window).height();

            if (small) height = Math.floor(height * 3 / 4);

            header.css('height', height + 'px');

            var picturewidth = width;
            var pictureheight = Math.floor(picturewidth * 9 / 16);

            if (pictureheight < height) {
                pictureheight = height;
                picturewidth = Math.floor(pictureheight * 16 / 9);
            }

            var left = -Math.floor((picturewidth - width) / 2);
            var top = -Math.floor((pictureheight - height) / 4);

            container.css({
                'width': picturewidth + 'px',
                'height': pictureheight + 'px',
                'left': left + 'px',
                'top': top + 'px'
            });



            placeContainer();
        }

        function placeContainer() {
            var scrolltop = Math.floor($(window).scrollTop() / 2);
            if (parallax) container.css('transform', 'translateY(' + scrolltop + 'px)');

            if ($(window).scrollTop() === 0) {
                $('.sqrnav').removeClass('sqrnavalt');
            } else {
                $('.sqrnav').addClass('sqrnavalt');
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

            $(image).on('load', function() {
                secEyecatcher.attr('src', url);
                secEyecatcher[0].offsetHeight;
                secEyecatcher.addClass('headerslidersecout');

                var swap = mainEyecatcher;
                mainEyecatcher = secEyecatcher;
                secEyecatcher = swap;
                start();
                header.removeClass('loading');
            });
            $(image).attr('src', url);
        }

        function scrollToBottom(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: container.height()-46
            }, speed);
        }

        if (bullets.length > 0) {
            bullets.eq(0).addClass('active');
            mainEyecatcher.after(secEyecatcher);

            bullets.bind('click', function(e) {
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
            $(window).on('scroll', placeContainer);
            $('#sqrtobottom').on('click', scrollToBottom);
        }
    };
})(jQuery);

$(document).ready(function() {
    $('header').sqrZegrabSlider();
    $('.sqrnav').sqrNav();
});
