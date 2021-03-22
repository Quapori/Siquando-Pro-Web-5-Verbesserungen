(function ($) {

    $.extend($.easing,
        {
            easeanimatedcircle: function (x, t, b, c, d) {
                if ((t /= d / 2) < 1) return c / 2 * t * t + b;
                return -c / 2 * ((--t) * (t - 2) - 1) + b;
            }
        });

    $.fn.ngAnimatedCircles = function () {
        $(this).each(function () {
            var ul = $(this),
                lis = ul.find('li'),
                animationduration = parseInt(ul.attr('data-animationduration')),
                animationdelay = parseInt(ul.attr('data-animationdelay')),
                captionsize = parseInt(ul.attr('data-captionsize')),
                valuesize = parseInt(ul.attr('data-valuesize')),
                captionspans = ul.find('.ngparaanimatedcirclescaption'),
                valuespans = ul.find('.ngparaanimatedcirclesvalue'),
                animationrunning = false;

            function sizeSpan() {
                var liWidth = lis.eq(0).width();

                valuespans.css('font-size', liWidth / (10 - valuesize) + 'px');
                captionspans.css('font-size', liWidth / (10 - captionsize) + 'px');
            }

            function startAnimation() {
                animationrunning = true;
                lis.each(function (index) {
                    var li = $(this),
                        div = li.find('div'),
                        percentage = parseInt(div.attr('data-percentage')),
                        value = parseInt(div.attr('data-value')),
                        unit = div.attr('data-unit'),
                        ring = div.find('.ngparaanimatedcirclesring'),
                        valuespan = div.find('.ngparaanimatedcirclesvalue'),
                        captionspan = $(this).find('.ngparaanimatedcirclescaption');


                    window.setTimeout(function () {
                        ring.animate({
                            'stroke-dashoffset': 629 - (629 * percentage / 100)
                        }, {
                            duration: animationduration,
                            easing: 'easeanimatedcircle',
                            progress: function (a, p, m) {
                                valuespan.text(Math.floor(p * value) + unit);
                            }
                        });
                    }, index * animationdelay);
                });
            }

            function handleScroll() {

                if (animationrunning) return;

                var windowheight = $(window).height(),
                    scrolltop = $(window).scrollTop();

                if (ul.offset().top + lis.eq(0).height()*0.75 < scrolltop + windowheight) {
                    startAnimation();
                }
            }


            sizeSpan();
            $(window).on('resize', sizeSpan);
            $(window).on('scroll', handleScroll);
            $(window).on('load', handleScroll);

        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparaanimatedcircles').ngAnimatedCircles();
});