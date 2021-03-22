(function ($) {

    $.fn.ngCountdown = function () {
        $(this).each(function () {
            var that = $(this),
                digits = that.find('li.ngparacountdowndigit'),
                targetdate = new Date(that.attr('data-date')),
                reload=that.attr('data-reload')==='true',
                seenbefore=false,
                seenafter=false,
                i;

            for (i = 0; i < digits.length; i++) {
                digits.eq(i).html('<div class="ngparacountdowndigittop"><div><div></div></div></div><div class="ngparacountdowndigittopflap"><div><div></div></div></div><div class="ngparacountdowndigitbottomflap"><div><div></div></div></div><div class="ngparacountdowndigitbottom"><div><div></div></div></div>');
            }

            function setDigits() {
                var now = new Date().getTime(),
                    distance = targetdate.getTime() - now;

                if (distance < 0) {
                    distance = 0;
                    seenafter=true;
                } else {
                    seenbefore=true;
                }

                var days = ('00000' + Math.floor(distance / (1000 * 60 * 60 * 24))).slice(-5),
                    hours = ('00' + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).slice(-2),
                    minutes = ('00' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).slice(-2),
                    seconds = ('00' + Math.floor((distance % (1000 * 60)) / 1000)).slice(-2),
                    all = (days + hours + minutes + seconds).slice(-digits.length),
                    i;

                for (i = 0; i < all.length; i++) {
                    var segment = all[i],
                        digit = digits.eq(i),
                        top = digit.find('.ngparacountdowndigittop>div>div'),
                        topflap = digit.find('.ngparacountdowndigittopflap>div>div'),
                        bottomflap = digit.find('.ngparacountdowndigitbottomflap>div>div'),
                        bottom = digit.find('.ngparacountdowndigitbottom>div>div'),
                        current = top.text();

                    if (current !== segment) {
                        digit.removeClass('playing');
                        top.text(segment);
                        topflap.text(current);
                        bottomflap.text(segment);
                        bottom.text(current);
                        digit.height();
                        digit.addClass('playing');
                    }
                }

                if (!seenafter) {
                    window.setTimeout(setDigits, 1000);
                } else {
                    if (seenbefore && reload) {
                        window.setTimeout(function() {
                            window.location.reload(true);
                        }, 3000);
                    }
                }

            }

            setDigits();
        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparacountdown').ngCountdown();
});
