(function($) {
    $.fn.ngBanner = function() {
        this.each(function() {

            var pictures = $(this).find('li');
            var banners = $(this).find("li[data-visible='true']");

            var positions = [];


            var delay = parseInt($(this).attr('data-delay'));
            var fade = $(this).attr('data-fade');

            var nextPicture = banners.length;
            var nextBanner = 0;

            function fadeNext() {
                var banner = $(banners[nextBanner]);
                var picture = $(pictures[nextPicture]);

                banner.css({
                    zIndex: 1
                });
                picture.css({
                    display: 'none',
                    zIndex: 2,
                    left: banner.attr('data-left'),
                    top: banner.attr('data-top')
                });
                picture.attr({
                    'data-left': banner.attr('data-left'),
                    'data-top': banner.attr('data-top')
                });
                banners[nextBanner] = pictures[nextPicture];

                switch (fade) {
                    case 'crossfade':
                        picture.fadeIn(250, function() {
                            banner.hide();
                        });
                        break;
                    case 'hard':
                        picture.show();
                        banner.hide();
                        break;
                    case 'fadeinout':
                        banner.fadeOut(250, function() {
                            banner.hide();
                            picture.fadeIn(250);
                        });
                        break;
                }

                nextBanner++;
                if (nextBanner >= banners.length) nextBanner = 0;

                nextPicture++;
                if (nextPicture >= pictures.length) nextPicture = 0;

            }

            if (pictures.length > banners.length) {
                var timer = setInterval(fadeNext, delay * 1000);

                pictures.hover(function() {
                    if (timer !== null) {
                        clearInterval(timer);
                        timer = null;
                    }
                }, function() {
                    if (timer === null) {
                        timer = setInterval(fadeNext, delay * 1000);
                    }
                });
            }


            return this;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('ul.ngbanner').ngBanner();
});
