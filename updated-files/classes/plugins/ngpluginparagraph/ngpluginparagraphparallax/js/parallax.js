(function($) {
    'use strict';
    $.fn.ngParallax = function() {
        $(this).each(function() {
            var container = $(this),
                img = $(this).children('img'),
                imgNaturalHeight = parseFloat(img.attr('height')),
                imgNaturalWidth = parseFloat(img.attr('width')),
                containerOffset = parseInt(container.attr('data-offset')),
                inverse = container.attr('data-inverse')==='true',
                maxOffset = 0;

            function size() {
                var width = container.width(),
                    imgHeight = Math.floor(width * imgNaturalHeight / imgNaturalWidth),
                    containerHeight = Math.floor(imgHeight * (100-containerOffset)/100);

                maxOffset = imgHeight - containerHeight;

                img.css({
                    'width': width + 'px',
                    'height': imgHeight + 'px'
                });
                container.css({
                    'height': containerHeight + 'px'
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
                    offset;

                if (inverse) {
                  offset = -Math.floor(top / range * maxOffset);
                } else {
                  offset = -Math.floor((1 - (top / range)) * maxOffset);
                }

                img.css('transform', 'translateY(' + offset + 'px)');
            }

            $(window).on('scroll', place);
            $(window).on('resize', size);

            size();
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparagraphpictureparallax').ngParallax();
});
