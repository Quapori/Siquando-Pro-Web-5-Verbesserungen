(function($) {
    'use strict';
    $.fn.sqrNav = function() {
        $(this).each(function() {

            var nav = $(this),
                showNav = nav.find('.sqrnavshow'),
                hideNav = nav.find('.sqrnavhide'),
                items,
                ul = nav.find('ul'),
                ticking = false,
                scrollTop = 0,
                speed = parseInt(nav.attr('data-speed')),
                createUp = nav.attr('data-up') === 'true';

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
                    showNav.on('click', handleShowNav);
                    hideNav.on('click', handleHideNav);
                    items.on('click', handleClick);
                    $(window).on('scroll', handleScroll);
                }

                if (createUp) $('.sqrtotop>a').on('click', handleToTop);


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
                var top = Math.floor($(anchor).offset().top) - nav.height() - 10;

                $('html, body').animate({
                    scrollTop: top
                }, speed);
            }

            function handleScroll() {
                scrollTop = Math.ceil($(window).scrollTop());

                if ($(window).scrollTop() === 0) {
                    $('.sqrnav').removeClass('sqrnavalt');
                } else {
                    $('.sqrnav').addClass('sqrnavalt');
                }

                if (!ticking) {
                    setTimeout(function() {
                        var last = -1;

                        for (var i = 0; i < items.length; i++) {
                            var itemTop = $(items.eq(i).attr('href')).offset().top - nav.height() - 20;
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
                }, 500);
            }

            buildNav();

        });
    };

    $.fn.sqrEyecatcher = function() {
        $(this).each(function() {
            var container = $(this).find('.sqreyecatcherstage'),
            	parallax = $(this).find('.sqreyecatcherparallax'),
                imgpri = container.children('img'),
                fadeEffect = container.attr('data-fadeeffect'),
                nav = $(this).find('.sqreyecatchernav'),
                links = nav.find('a'),
                offset = 0,
                autoProgress = parseInt(container.attr('data-autoprogress'), 10),
                autoProgessTimer = null;

            function performAutoProgress() {
                offset++;

                if (offset > links.length - 1) {
                    offset = 0;
                }

                setOffset();
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

            function setOffset() {
                if (links.eq(offset).hasClass('sqreyecatchernavselected')) return;

                var img = new Image(),
                    url = links.eq(offset).attr('href'),
                    prifrom,
                    secfrom,
                    prito,
                    secto;

                links.removeClass('sqreyecatchernavselected').eq(offset).addClass('sqreyecatchernavselected');

                switch (fadeEffect) {
                    case 'right':
                        prifrom = 'translateX(0)';
                        secfrom = 'translateX(-30px)';
                        secto = 'translateX(0)';
                        prito = 'translateX(30px)';
                        break;
                    case 'left':
                        prifrom = 'translateX(0)';
                        secfrom = 'translateX(30px)';
                        secto = 'translateX(0)';
                        prito = 'translateX(-30px)';
                        break;
                    case 'down':
                        prifrom = 'translateY(0)';
                        secfrom = 'translateY(-30px)';
                        secto = 'translateY(0)';
                        prito = 'translateY(30px)';
                        break;
                    case 'shrink':
                        prifrom = 'scale(1.0)';
                        secfrom = 'scale(1.1)';
                        secto = 'scale(1.0)';
                        prito = 'scale(0.9)';
                        break;
                    case 'grow':
                        prifrom = 'scale(1.0)';
                        secfrom = 'scale(0.9)';
                        secto = 'scale(1.0)';
                        prito = 'scale(1.1)';
                        break;
                    case 'fade':
                        prifrom = 'none';
                        secfrom = 'none';
                        secto = 'none';
                        prito = 'none';
                        break;
                    default:
                        prifrom = 'translateY(0)';
                        secfrom = 'translateY(30px)';
                        secto = 'translateY(0)';
                        prito = 'translateY(-30px)';
                        break;
                }

                $(img).on('load', function() {
                    imgpri.css({
                        'z-index': '0',
                        'opacity': '1',
                        'transition': 'none',
                        'transform': prifrom
                    });
                    imgsec.css({
                        'z-index': '1',
                        'opacity': '0',
                        'transition': 'none',
                        'transform': secfrom
                    });
                    imgsec.attr('src', url);
                    imgpri.height();
                    imgsec.height();
                    imgsec.css({
                        'transition': 'opacity 0.5s, transform 0.5s',
                        'opacity': '1',
                        'transform': secto
                    });
                    imgpri.css({
                        'transition': 'opacity 0.5s, transform 0.5s',
                        'opacity': '0',
                        'transform': prito
                    });

                    var swap = imgpri;
                    imgpri = imgsec;
                    imgsec = swap;
                    start();
                });

                img.src = url;
            }

            function placeContainer() {
                var scrolltop = Math.floor($(window).scrollTop() / 2);
                parallax.css('transform', 'translateY(' + scrolltop + 'px)');
            }

            function handleClick(e) {
                e.preventDefault();
                offset = $(this).index();
                setOffset();
            }

            if (links.length > 1) {
                links.eq(offset).addClass('sqreyecatchernavselected');

                var imgsec = $('<img>').css({
                    'opacity': '0',
                    'z-index': '0'
                });

                container.append(imgsec);
                links.on('click', handleClick);
                start();
            }

            $(window).on('scroll', placeContainer);
        });
    };

})(jQuery);

$(document).ready(function() {
    $('.sqrnav').sqrNav();
    $('.sqreyecatcher').sqrEyecatcher();
});
