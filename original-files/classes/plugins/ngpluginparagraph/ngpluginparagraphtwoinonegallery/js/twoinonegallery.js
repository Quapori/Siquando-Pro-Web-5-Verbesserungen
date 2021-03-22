(function($) {
    'use strict';
    $.fn.ngTwoInOneGallery = function() {
        $(this).each(function() {
            var container = $(this),
                buttonmatrix = container.find('.ngparatwoinonegallerymatrix'),
                buttonclose = container.find('.ngparatwoinonegalleryclose'),
                buttonnext = container.find('.ngparatwoinonegallerynext'),
                buttonprev = container.find('.ngparatwoinonegalleryprev'),
                outer = container.find('.ngparatwoinonegallerycontainer'),
                inner = outer.find('ul'),
                items = inner.find('li'),
                total = items.length,
                columns = parseInt($(this).attr('data-columns')),
                columnsmobile = parseInt($(this).attr('data-columnsmobile')),
                offset = 0,
                scrollMode = true;

            buttonmatrix.on('click', function(e) {
                e.preventDefault();
                container.removeClass('ngparatwoinonegalleryscroll');
                container.addClass('ngparatwoinonegallerymatrix');
                scrollMode = false;
                setDimensions(false);
                setDimensions(false);
            });
            buttonclose.on('click', function(e) {
                e.preventDefault();
                container.removeClass('ngparatwoinonegallerymatrix');
                container.addClass('ngparatwoinonegalleryscroll');
                scrollMode = true;
                setDimensions(false);
                setDimensions(false);
            });
            buttonnext.on('click', function(e) {
                e.preventDefault();
                var width = outer.width() / columns;
                offset += columns;
                checkOffset();
                setDimensions(true);
            });
            buttonprev.on('click', function(e) {
                e.preventDefault();
                var width = outer.width() / columns;
                offset -= columns;
                checkOffset();
                setDimensions(true);
            });
            $(window).on('resize', function() {
                checkOffset();
                setDimensions(false);
                setDimensions(false);
            });

            function realcolumns() {
                return ($(window).width() >= 768) ? columns : columnsmobile;
            }

            function checkOffset() {
                var shownext = true;
                var showprev = true;

                if (offset >= total - realcolumns()) {
                    offset = total - realcolumns();
                    shownext = false;
                }
                if (offset <= 0) {
                    offset = 0;
                    showprev = false;
                }

                if (total <= realcolumns()) {
                    showprev = false;
                    shownext = false;
                }

                if (shownext) {
                    buttonnext.removeClass('ngparatwoinonegallerydisabled');
                } else {
                    buttonnext.addClass('ngparatwoinonegallerydisabled');
                }

                if (showprev) {
                    buttonprev.removeClass('ngparatwoinonegallerydisabled');
                } else {
                    buttonprev.addClass('ngparatwoinonegallerydisabled');
                }
            }

            function setDimensions(animate) {
                var width = outer.width() / realcolumns();

                if (animate) {
                    inner.css('transition', 'transform 0.5s ease');
                } else {
                    inner.css('transition', 'none');
                }

                if (scrollMode) {
                    outer.css('height', width + 'px');
                    inner.css('width', width * items.length + 'px');
                    items.css('width', width + 'px');
                    inner.css('transform', 'translateX(-' + offset * width + 'px)');

                    for (var i = 0; i < items.length; i++) {
                        if (i >= offset && i < offset + realcolumns()) {
                            items.eq(i).css('opacity', '1');
                        } else {
                            items.eq(i).css('opacity', '0');
                        }
                    }
                } else {
                    outer.css('height', 'inherit');
                    inner.css('width', '100%');
                    items.css('width', 100 / realcolumns() + '%');
                    inner.css('transform', 'translateX(0)');

                    items.css('opacity', '1');
                }

            }

            checkOffset();
            setDimensions();
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparatwoinonegallery').ngTwoInOneGallery();
});
