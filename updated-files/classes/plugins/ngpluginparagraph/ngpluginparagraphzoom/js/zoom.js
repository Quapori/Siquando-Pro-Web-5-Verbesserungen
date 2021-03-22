(function ($) {
    'use strict';
    $.fn.ngParaZoom = function () {
        $(this).each(function () {
            var img = $(this),
                zoomsrc = img.attr('data-src'),
                factor = parseInt(img.attr('data-factor')),
                parentli = img.parent('li'),
                otherli = parentli.siblings('li'),
                zoomdiv, zoomimg, imgwidth, imgheight;

            function create() {
                zoomimg = $('<img>');
                zoomimg.attr({'src': zoomsrc});
                zoomdiv = $('<div>');
                zoomdiv.append(zoomimg);
                otherli.append(zoomdiv);
            }

            function isDesktop() {
                return parentli.css('display') === 'table-cell';
            }

            function setTranslate(offsetX, offsetY) {
                if (offsetX < 0) offsetX = 0;
                if (offsetY < 0) offsetY = 0;
                if (offsetX > imgwidth) offsetX = imgwidth;
                if (offsetY > imgheight) offsetY = imgheight;


                var zoomleft = -(offsetX) * (factor - 1),
                    zoomtop = -(offsetY) * (factor - 1);

                zoomimg.css({
                    'transform': 'translate3d(' + zoomleft + 'px,' + zoomtop + 'px,0)'
                });

            }

            function place() {
                imgwidth = Math.floor(otherli.outerWidth());
                imgheight = Math.floor(Math.min(otherli.outerHeight(), img.height()));

                zoomdiv.css({
                    'width': imgwidth + 'px',
                    'height': imgheight + 'px'
                });

                zoomimg.css({
                    'width': imgwidth * factor + 'px',
                    'height': imgheight * factor + 'px'
                });
            }

            function handleOver(e) {
                if (!isDesktop()) return;
                place();
                zoomdiv.addClass('ngparazoomvisible');
            }

            function handleOut(e) {
                if (!isDesktop()) return;
                zoomdiv.removeClass('ngparazoomvisible');
            }

            function handleMove(e) {
                if (!isDesktop()) return;
                setTranslate(e.offsetX, e.offsetY);
            }

            function handleTouchMove(e) {
                if (!isDesktop()) return;

                if (e.originalEvent.touches.length == 1) {
                    var position = parentli.position(),
                        offsetX = e.originalEvent.touches[0].pageX - position.left,
                        offsetY = e.originalEvent.touches[0].pageY - position.top;

                    setTranslate(offsetX, offsetY);
                    if (e.cancelable) e.preventDefault();
                }
            }

            function handleTouchStart(e) {
                if (!isDesktop()) return;

                if (e.originalEvent.touches.length == 1) {
                    place();
                    zoomdiv.addClass('ngparazoomvisible');
                    var position = parentli.position(),
                        offsetX = e.originalEvent.touches[0].pageX - position.left,
                        offsetY = e.originalEvent.touches[0].pageY - position.top;

                    setTranslate(offsetX, offsetY);
                    if (e.cancelable) e.preventDefault();
                }
            }

            create();

            img.on('touchstart', handleTouchStart);
            img.on('mouseover', handleOver);
            img.on('touchend', handleOut);
            img.on('mouseout', handleOut);
            img.on('touchmove', handleTouchMove);
            img.on('mousemove', handleMove);
        });
    }

})(jQuery);

$(document).ready(function () {
    $('.ngparazoom>ul>li.ngparazoompicture>img').ngParaZoom();
});
