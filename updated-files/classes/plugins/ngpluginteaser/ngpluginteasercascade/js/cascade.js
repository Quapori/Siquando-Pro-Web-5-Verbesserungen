(function ($) {
    $.fn.sqrTeaserCascade = function () {
        $(this).each(function () {
            var that = $(this),
                button = that.find('button'),
                w = $(window),
                lazylis = $(this).find('.ngteasercascadelazy').find('li>ul>li>ul>li');

            function handleShowButtonClicked() {
                that.addClass('ngteasercascadeshowhidden');
                lazyload();
            }

            function lazyload() {

                var i = 0,
                    wt = w.scrollTop(),
                    wb = wt + w.height(),
                    inview = lazylis.filter(function () {
                        var e = $(this),
                            et = e.offset().top,
                            eb = et + e.height();

                        if (e.is(":hidden")) return;

                        return eb >= wt && et <= wb;
                    });

                inview.each(function (index) {
                    var reveal = $(this),
                        time = index * 200,
                        img = reveal.find('img'),
                        src = img.attr('data-src');

                    img.attr('src',src);

                    img.on('load', function() {
                        window.setTimeout(function () {
                            reveal.addClass('ngteasercascadelazyreveal');
                        }, time);
                    });

                });

                lazylis = lazylis.not(inview);
            }

            if (lazylis.length > 0) {
                w.on('scroll resize load', lazyload);
            };

            lazyload();

            button.on('click', handleShowButtonClicked);

        });
    };
})(jQuery);


$(document).ready(function () {
    $('.ngteasercascade').sqrTeaserCascade();
});
