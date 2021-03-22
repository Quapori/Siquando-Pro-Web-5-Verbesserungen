(function($) {
    'use strict';
    $.fn.ngTextChanger = function() {
        $(this).each(function() {
            var stage = $(this),
                ul = stage.children('ul'),
                items = ul.children('li'),
                timer,
                delay = parseInt(stage.attr('data-delay'), 10),
                offset = 0;

            function next() {
                offset++;
                if (offset >= items.length) offset = 0;
                setOffset();
            }

            function setOffset() {
                ul.css('transform', 'translateY(-' + items.eq(offset).position().top + 'px)');
                stage.css('height', items.eq(offset).outerHeight() + 'px');
            }

            function startTimer() {
                if (timer === undefined) timer = window.setInterval(next, delay * 1000);
            }

            function stopTimer() {
                if (timer !== undefined) window.clearInterval(timer);
                timer = undefined;
            }

            setOffset();
            startTimer();

            $(window).on('resize', setOffset);
            stage.on('mouseover', stopTimer);
            stage.on('mouseout', startTimer);

        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparagraphtextchanger').ngTextChanger();
});
