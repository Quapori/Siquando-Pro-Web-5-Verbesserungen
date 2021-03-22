(function($) {
    $.fn.ngPictureband = function() {
        $(this).each(function() {
            var stage = $(this);
            var stagewidth;
            var stageheight;
            var itemwidth;
            var band = $(this).find('ul').eq(0);
            var bandwidth;
            var buttonnext = $(this).find('a.ngpicturebandnext');
            var buttonprev = $(this).find('a.ngpicturebandprev');
            var ratio = parseFloat(stage.attr('data-ratio'));
            var columns = parseFloat(stage.attr('data-columns'));
            var items = stage.find('li');
            var offset = 0;


            function placeElements() {
                stagewidth = stage.width();
                itemwidth = stagewidth / columns;
                stageheight = itemwidth / ratio;
                bandwidth = itemwidth * items.length;

                stage.css({
                    'height': stageheight + 'px'
                });
                items.css({
                    'width': itemwidth + 'px'
                });
                band.css({
                    'width': bandwidth + 'px',
                    'left': -offset * itemwidth
                });

            }

            function roll(e) {
                var direction = $(this).data('direction');

                offset += direction * columns;

                if (offset < 0) offset = 0;
                if (offset > items.length - columns) offset = items.length - columns;


                if (offset == items.length - columns) {
                    buttonnext.animate({
                        'right': -32
                    }, 250);
                } else {
                    buttonnext.animate({
                        'right': 0
                    }, 250);
                }
                if (offset === 0) {
                    buttonprev.animate({
                        'left': -32
                    }, 250);
                } else {
                    buttonprev.animate({
                        'left': 0
                    }, 250);
                }
                band.animate({
                    'left': -offset * itemwidth
                }, 250);

                e.preventDefault();
            }

            placeElements();

            buttonnext.data('direction', 1);
            buttonnext.click(roll);
            buttonprev.data('direction', -1);
            buttonprev.click(roll);

            $(window).on('resize', function() {
                placeElements();
                placeElements();
            });

        });
    };
})(jQuery);


$(document).ready(function() {
    $('div.ngpictureband').ngPictureband();
});
