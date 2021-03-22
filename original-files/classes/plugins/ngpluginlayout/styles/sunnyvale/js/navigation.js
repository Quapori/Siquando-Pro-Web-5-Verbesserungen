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

            function handleSetmode(e) {
                e.preventDefault();
                $('#sqrouterbox').attr('class', $(this).attr('href').substr(1));
            }

            function handleClose(e) {
                e.preventDefault();
                $('#sqrouterbox').removeAttr('class');
            }


            function handleTouchOutside(e) {
                if ($(e.target).parents('.sqrnav').length === 0) {
                    if (!$(e.target).hasClass('sqrsetmode')) {
                        $('#sqrouterbox').removeAttr('class');
                    }
                }
            }

            nav.children('ul').children('li').eq(0).append($('<span>', {'class':'sqrclearmode'}));
            allItems.addClass('sqrnavmore').append('<div>');
            allItems.children('div').on('click', handleClick);
            if (sparse) allItems.children('a').on('click', handleClick);
            $('.sqrsetmode').on('click', handleSetmode);
            $('.sqrclearmode').on('click', handleClose);
            $(document).on('click touchstart', handleTouchOutside);

            nav.find('li.active').addClass('sqrnavopen').parents('li').addClass('sqrnavopen');


        });
    };
})(jQuery);


$(document).ready(function() {
    $('.sqrnav').sqrNav();
});
