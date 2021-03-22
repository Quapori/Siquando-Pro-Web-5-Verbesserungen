'use strict';

(function($) {
    $.fn.ngSlider = function() {
        this.each(function() {
            var stage = $(this).find('.ngpluginsliderstage');
            var width;
            var slider = stage.find('ul');
            var slides = slider.find('li');
            var offset = 0;
            var controls = $(this).find('.ngpluginslidercontrols');
            var buttons = controls.find('a');
            var next = stage.find('.ngpluginslidernext');
            var prev = stage.find('.ngpluginsliderprev');
            var audios = $(stage).find('audio');
            var videos = $(stage).find('video');
            var delay = parseInt($(this).attr('data-delay'));
            var ratio = parseFloat(stage.attr('data-ratio'));
            var timeout = null;

            function stopMedia(index, element) {
                try {
                    element.pause();
                    element.currentTime = 0;
                } catch (e) {}
            }

            function startMedia(media) {
                if (media.length > 0) {
                    try {
                        media[0].load();
                        media[0].play();
                    } catch (e) {}
                }
            }

            function setOffset() {
                slider.css({
                    'transform': 'translate(' + (-offset * width) + 'px,0)'
                });
                slider.css({
                    '-webkit-transform': 'translate(' + (-offset * width) + 'px,0)'
                });
                slider.css({
                    '-ms-transform': 'translate(' + (-offset * width) + 'px,0)'
                });
            }

            function slideTo(newOffset) {
                if (timeout !== null) {
                    clearTimeout(timeout);
                    timeout = null;
                }

                offset = newOffset;
                setOffset();
                buttons.removeClass('selectedslide');
                buttons.eq(offset).addClass('selectedslide');
                slides.removeClass('selectedslide');

                audios.each(stopMedia);
                videos.each(stopMedia);

                var currentSlide = slides.eq(offset);

                setTimeout(function() {
                    currentSlide.addClass('selectedslide');
                    startMedia(currentSlide.find('audio'));
                    startMedia(currentSlide.find('video'));
                }, 500);

                prev.css({
                    'left': ((offset === 0) ? '-48px' : 0)
                });
                next.css({
                    'right': ((offset === slides.length - 1) ? '-48px' : 0)
                });

                if (delay !== 0)
                    timeout = setTimeout(nextSlide, delay * 1000);

            }

            function nextSlide() {
                var index = offset + 1;
                if (index < slides.length) {
                    slideTo(index);
                } else {
                    slideTo(0);
                }
            }

            function placeParts() {
                width = stage.width();
                var height = Math.floor(width / ratio);

                stage.css({
                    'height': height + 'px'
                });
                slides.css({
                    'height': height + 'px',
                    'width': width + 'px'
                });

                for (var i = 0; i < slides.length; i++) {
                    slides.eq(i).css({
                        'left': (width * i) + 'px'
                    });
                }

                slider.addClass('ngslidernotransition');
                slider.offset();
                setOffset();
                slider.offset();
                slider.removeClass('ngslidernotransition');
            }

            buttons.click(function(e) {
                var index = buttons.index($(this));
                slideTo(index);
                e.preventDefault();
            });

            next.click(function(e) {
                var index = offset + 1;
                if (index < slides.length)
                    slideTo(index);
                e.preventDefault();
            });

            prev.click(function(e) {
                var index = offset - 1;
                if (index >= 0)
                    slideTo(index);
                e.preventDefault();
            });

            slides.find('img').each(function() {
                var src = $(this).attr('data-src');
                var srchd = $(this).attr('data-src-hd');

                if (window.devicePixelRatio > 1) {
                    if (srchd != 'undefined')
                        $(this).attr('src', srchd);
                } else {
                    if (src != 'undefined')
                        $(this).attr('src', src);
                }
            });

            videos.on('ended', nextSlide);
            $(window).on('resize', placeParts);

            placeParts();
            slideTo(0);

            return this;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngpluginslider').ngSlider();
});
