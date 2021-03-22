(function($) {
    $.fn.ngCollage = function() {

        this.each(function() {

            var stage = $(this);
            var stageWidth = parseInt(stage.attr('data-width'));
            var stageHeight = parseInt(stage.attr('data-height'));
            var items = stage.find('div,img');
            var ratio = stageWidth / stageHeight;

            function storeData() {
                items.each(function() {
                    $(this).data('left', parseInt($(this).css('left').replace('px', '')));
                    $(this).data('top', parseInt($(this).css('top').replace('px', '')));
                    $(this).data('width', parseInt($(this).css('width').replace('px', '')));
                    $(this).data('height', parseInt($(this).css('height').replace('px', '')));
                });
            }

            function reposition() {
                var width = stage.width();
                var height = width / ratio;
                var factorX = width / stageWidth;
                var factorY = height / stageHeight;

                stage.css('height', height + 'px');

                items.each(function() {
                    $(this).css({
                        'left': ($(this).data('left') * factorX) + 'px',
                        'top': ($(this).data('top') * factorY) + 'px',
                        'width': ($(this).data('width') * factorX) + 'px',
                        'height': ($(this).data('height') * factorY) + 'px'
                    });
                });
            }

            storeData();
            reposition();
            $(window).on('resize', function() {
                reposition();
                reposition();
            });
        });

    };
})(jQuery);


$(document).ready(function() {
    $('div.ngparacollageresponsive').ngCollage();
});
