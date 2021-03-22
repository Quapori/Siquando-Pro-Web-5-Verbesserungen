(function($) {
    'use strict';
    $.fn.ngLiquidGallery = function() {
        $(this).each(function() {
            var outer = $(this),
                inner = $(this).children('ul'),
                containers = inner.find('li'),
                gutter = parseInt(outer.attr('data-sqrgutter')),
                rowSize = parseInt(outer.attr('data-sqrsize')),
                captions = outer.attr('data-sqrcaptions') === 'true',
                totalWidth,
                all;

            function getImages() {
                var images = outer.find('img'),
                    i;

                all = [];

                for (i = 0; i < images.length; i++) {
                    var image = images.eq(i);
                    var ratio = parseInt(image.attr('width')) / parseFloat(image.attr('height'));

                    all.push({
                        'imageRatio': ratio
                    });

                    if (captions) {
                        var alt = image.attr('alt');
                        if (alt !== '') {
                            image.parent().append($('<div>').text(alt));
                        }
                    }
                }
            }

            function placeImages() {
                totalWidth = outer.width();

                if (totalWidth > 480) {
                    placeImagesMultiCol();
                } else {
                    placeImagesSingleCol();
                }
            }

            function placeImagesSingleCol() {
                var currentY = 0,
                    i;

                for (i = 0; i < all.length; i++) {
                    var imageHeight = Math.floor(totalWidth / all[i].imageRatio);

                    containers.eq(i).css({
                        'width': totalWidth + 'px',
                        'height': imageHeight + 'px',
                        'top': currentY + 'px',
                        'left': '0px'
                    }).find('img').css({
                        'width': totalWidth + 'px',
                        'height': imageHeight + 'px',
                        'left': '0px'
                    });

                    if (i < containers.length ) {
                        currentY += (imageHeight + gutter);
                    }
                }

                inner.css({
                    'height': currentY + 'px',
                    'width': totalWidth + 'px'
                });
            }

            function placeImagesMultiCol() {
                var currentX = 0,
                    currentY = 0,
                    firstIndexInRow = 0,
                    rowHeight = rowSize + Math.floor(totalWidth / 10),
                    i;


                for (i = 0; i < all.length; i++) {
                    var j;
                    all[i].imageWidth = Math.floor(rowHeight * all[i].imageRatio);
                    all[i].containerWidth = all[i].imageWidth;
                    currentX += all[i].containerWidth;
                    if (currentX > totalWidth || i === containers.length - 1) {
                        while (currentX > totalWidth) {
                            for (j = firstIndexInRow; j <= i; j++) {
                                all[j].containerWidth--;
                                currentX--;
                                if (currentX <= totalWidth) break;
                            }
                        }
                        currentX = 0;
                        for (j = firstIndexInRow; j <= i; j++) {
                            containers.eq(j).css({
                                'width': all[j].containerWidth + 'px',
                                'height': rowHeight + 'px',
                                'top': currentY + 'px',
                                'left': currentX + 'px'
                            }).find('img').css({
                                'width': all[j].imageWidth + 'px',
                                'height': rowHeight + 'px',
                                'left': -Math.floor((all[j].imageWidth - all[j].containerWidth) / 2) + 'px'
                            });

                            currentX += all[j].containerWidth + gutter;
                        }
                        if (i < containers.length - 1) {
                            currentX = 0;
                            currentY += (rowHeight + gutter);
                            firstIndexInRow = i + 1;
                        }
                    } else {
                        currentX += gutter;
                    }
                }
                inner.css({
                    'height': currentY + rowHeight + 'px',
                    'width': totalWidth + 'px'
                });
            }

            getImages();
            placeImages();
            placeImages();


            $(window).on('resize', placeImages);

            $(window).trigger('resize');
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparaliquidgallery').ngLiquidGallery();
});
