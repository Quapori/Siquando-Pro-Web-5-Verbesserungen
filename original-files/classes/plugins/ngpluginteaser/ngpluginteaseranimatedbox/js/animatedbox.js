(function($) {
    $.fn.ngAnimatedBox = function() {
        $(this).each(function() {
            var currentIndex = 0;
            var items = $(this).find('li');
            var outer = $(this).find('.nganimatedboxtimerout');
            var bar = $(this).find('.nganimatedboxtimerin');
            var delay = parseInt($(this).attr('data-nganimatebox-delay')) * 1000;
            var slide = $(this).attr('data-nganimatebox-slide') == 'true';

            items.each(function(index) {
                if (index !== 0) {
                    $(this).hide();
                }
            });

            function nextPicture() {
                var nextIndex = currentIndex + 1;

                if (nextIndex >= items.length) nextIndex = 0;

                items.css({
                    'z-index': 0,
                    'display': 'none'
                });
                items.eq(currentIndex).css({
                    'display': 'block'
                });
                items.eq(nextIndex).css({
                    'z-index': 1
                }).fadeIn(300);

                var info = items.eq(nextIndex).find('div');

                var width = info.width();

                if (slide) info.children('div').css({
                    'left': width + 'px'
                }).animate({
                    'left': 0
                }, 400);

                currentIndex = nextIndex;

                runTimer();
            }

            function stopTimer() {
                bar.css('width', 0);
                bar.stop();
            }

            function runTimer() {
                var maxwidth = outer.width();

                bar.css('width', 0);
                bar.animate({
                    'width': maxwidth
                }, delay, 'linear', nextPicture);
            }

            $(window).load(function() {
                items.hover(stopTimer, runTimer);
                runTimer();
            });
        });
    };
})(jQuery);


$(document).ready(function() {
    $('div.nganimatedbox').ngAnimatedBox();
});
