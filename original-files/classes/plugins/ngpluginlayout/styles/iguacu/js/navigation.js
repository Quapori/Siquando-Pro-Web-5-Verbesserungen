(function($) {
    'use strict';
    $.fn.sqrNav = function() {
        $(this).each(function() {
            var nav = $(this),
                allItems = nav.find('li:has(ul)'),
                sparse = nav.attr('data-expandnav') === 'sparse';

            function handleClick(e) {
                if ($(this).parent().hasClass('sqrnavopen')) {
                    $(this).parent().removeClass('sqrnavopen');
                    $(this).parent().removeClass('sqrnavopen').find('.sqrnavmore').removeClass('sqrnavopen');
                } else {
                    $(this).parent().addClass('sqrnavopen');
                }
                e.preventDefault();
            }

            allItems.addClass('sqrnavmore').append('<div>');
            allItems.children('div').on('click', handleClick);
            if (sparse) allItems.children('a').on('click', handleClick);

            nav.find('li.active').addClass('sqrnavopen').parents('li').addClass('sqrnavopen');
        });
    };

    $.fn.sqrSetMode = function() {
        var outerbox = $('#sqrouterbox');

        function handleClick(e) {
            e.preventDefault();

            var link = $(this).attr('href').substr(1);

            if (outerbox.attr('class') === link) {
                outerbox.removeAttr('class');
            } else {
                outerbox.attr('class', link);
                if (link === "sqrmodesearch") {
                    $('.sqrsearchbar input')[0].focus();
                }
            }
        }

        $(this).on('click', handleClick);
    };
})(jQuery);


$(document).ready(function() {
    $('.sqrnav').sqrNav();
    $('.sqrsetmode').sqrSetMode();
});
