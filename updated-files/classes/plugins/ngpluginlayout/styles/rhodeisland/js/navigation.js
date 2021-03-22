(function($) {
    'use strict';
    $.fn.sqrNav = function() {
        $.fn.sqrProvidence = function() {
            var header = $(this);
            var img = header.children('img');
            var parallax = header.attr('data-parallax') === 'true';

            function sizeHeader() {

                var width = header.width();
                var height = Math.floor($(window).height() / 3);

                if (height < 200) height = 200;


                header.css('height', height + 'px');

                var picturewidth = width;
                var pictureheight = Math.floor(picturewidth / 3);

                if (pictureheight < height) {
                    pictureheight = height;
                    picturewidth = Math.floor(pictureheight * 3);
                }

                var left = -Math.floor((picturewidth - width) / 2);
                var top = -Math.floor((pictureheight - height) / 2);

                img.css({
                    'width': picturewidth + 'px',
                    'height': pictureheight + 'px',
                    'left': left + 'px',
                    'top': top + 'px'
                });

                placeImage();
            }

            function placeImage() {
                if (parallax) {
                    var scrolltop = Math.floor($(window).scrollTop() / 2);
                    img.css('transform', 'translateY(' + scrolltop + 'px)');
                }
            }


            if (header.length > 0) {
                sizeHeader();
                sizeHeader();
                $(window).on('resize', sizeHeader);
                if (parallax) {
                    $(window).on('scroll', placeImage);
                }
            }
        };

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
})(jQuery);

$(document).ready(function() {
    $('.sqrnav').sqrNav();
    $('.sqrheader').sqrProvidence();
});
