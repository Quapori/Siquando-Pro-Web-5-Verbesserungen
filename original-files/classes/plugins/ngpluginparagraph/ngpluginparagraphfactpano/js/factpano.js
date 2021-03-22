(function($) {
    'use strict';
    $.fn.sqrFactPano = function() {
        $(this).each(function() {
            var container = $(this),
                img = $(this).find('.sqrfactpanoimg'),
                maxOffset = 0,
                stage = $(this).find('.sqrfactpanostage'),
                fadeIn = stage.hasClass('sqrfactpanofadein'),
                ratio = 1,
                parallax = 0;

            function size() {
                var width = container.width(),
                    height = container.height(),
                    imgWidth = width,
                    imgHeight = Math.floor(imgWidth * ratio);

                if (imgHeight < Math.floor(height * (1 + parallax / 100))) {
                    imgHeight = Math.floor(height * (1 + parallax / 100));
                    imgWidth = Math.floor(imgHeight / ratio);
                }

                maxOffset = imgHeight - height;

                img.css({
                    'width': imgWidth + 'px',
                    'height': imgHeight + 'px',
                    'left': Math.floor((width - imgWidth) / 2) + 'px'
                });

                place();
            }

            function place() {
                var containerTop = container.offset().top,
                    containerHeight = container.height(),
                    windowheight = $(window).height(),
                    scrolltop = $(window).scrollTop(),
                    top = scrolltop + windowheight - containerTop,
                    range = windowheight + containerHeight,
                    offset = -Math.floor((1 - (top / range)) * maxOffset);

                if (parallax === 0) offset = -Math.floor(0.5 * maxOffset);

                img.css('transform', 'translateY(' + offset + 'px)');

                if (fadeIn) {
                    if (containerTop + containerHeight / 2 < scrolltop + windowheight) {
                        fadeIn = false;
                        stage.removeClass('sqrfactpanofadein');
                    }
                }
            }

            if (img.length > 0) {
                ratio = parseFloat(img.attr('height')) / parseFloat(img.attr('width'));
                parallax = parseInt(container.attr('data-sqrfactpanpparallax'));
                $(window).on('resize', size);
                $(window).on('load', size);
                size();
            }

            $(window).on('scroll', place);

        });
    };
})(jQuery);

$(document).ready(function() {
    $('.sqrfactpano').sqrFactPano();
});
