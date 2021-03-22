(function ($) {
    'use strict';
    $.fn.sqwFacts = function () {
        $(this).each(function () {
            var images = $(this).find('img'),
                links = $(this).find('.sqwpluginfactslink'),
                lis=$(this).children('li'),
                divs = lis.children('li>div:first-child')


            images.data('appeared', false);

            function handleScroll() {

                var windowheight = $(window).height(),
                    scrolltop = $(window).scrollTop(),
                    i;

                for (i = 0; i < images.length; i++) {
                    var image = images.eq(i);

                    if (!image.data('appeared')) {
                        var imageTop = image.offset().top,
                            imageHeight = image.height();

                        if (imageTop + imageHeight  < scrolltop + windowheight) {
                            image.data('appeared', true);
                            window.setTimeout(showImage, i * 250, image);
                        }
                    }
                }
            }

            function fixHeight() {
                var maxheight=0,
                    i;

                if (lis.css('float')==='left') {

                    for (i = 0; i < divs.length; i++) {
                        var height = divs.eq(i).children('div').outerHeight();
                        if (height > maxheight) maxheight = height;
                    }

                    divs.css('min-height', maxheight + 'px');
                } else {
                    divs.css('min-height', '0');
                }
            }

            function showImage(image) {
                image.addClass('sqwpluginfactappear');
            }

            if (links.length>1) {
                fixHeight();
                $(window).on('load', fixHeight);
                $(window).on('resize', fixHeight);
            }

            $(window).on('scroll', handleScroll);
            $(window).on('load', handleScroll);

        });
    };
})(jQuery);

$(document).ready(function () {
    $('.sqwpluginfactsanim').sqwFacts();
});