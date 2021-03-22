(function($) {
    'use strict';

    $.fn.sqrNav = function() {
        $(this).each(function() {

            var nav = $(this),
                fixed = false,
                showNav = nav.find('.sqrnavshow'),
                hideNav = nav.find('.sqrnavhide'),
                allItems = nav.find('li:has(ul)'),
                placeholder = $('#navplaceholder'),
                lastitem,
                doubleClickTimeout,
                navIsOpen = false,
                doubleclick = false;

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
                    if ($(e.target).parents('#nav').length === 0) {
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
                navIsOpen = true;
                e.preventDefault();
            }

            function handleHideNav(e) {
                nav.removeClass('sqrnavopen');
                navIsOpen = false;
                e.preventDefault();
            }

            function handleScroll(e) {
                if (navIsOpen) return;

                var top = placeholder.offset().top,
                    scrollTop = $(document).scrollTop();

                if (top - scrollTop > 0) {
                    if (fixed) {
                        $('html').removeClass('flexrfixed');
                        fixed = false;
                    }
                } else {
                    if (!fixed) {
                        $('html').addClass('flexrfixed');
                        fixed = true;
                    }
                }

            }

            nav.find('li.active').parents('li').addClass('active');
            allItems.addClass('sqrnavmore').children('a').on('click', handleClick);
            showNav.on('click', handleShowNav);
            hideNav.on('click', handleHideNav);
            $(document).on('click touchstart', handleClose);

            if (placeholder.length > 0) $(document).on('scroll', handleScroll);
        });
    };
})(jQuery);

$(document).ready(function() {
    $('#nav').sqrNav();
});
