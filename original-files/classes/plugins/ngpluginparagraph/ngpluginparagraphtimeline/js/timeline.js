(function($) {
    $.fn.ngTimeline = function() {
        var divs = $(this).find('div'),
            $w = $(window);

        function reveal() {
            var inview = divs.filter(function() {
                var $t = $(this),
                    wt = $w.scrollTop(),
                    wb = wt + $w.height(),
                    et = $t.offset().top,
                    eb = et + $t.height();

                return eb >= wt && et <= wb;
            });

            window.setTimeout(function() {
                inview.addClass('sqrparatimelineitemvisible');
            }, 100);
            divs = divs.not(inview);
        }

        $w.on("scroll.timeline resize.timeline", reveal);

        reveal();

        return this;
    };

})(jQuery);

$(document).ready(function() {
    $('ul.sqrparatimelineanimate').ngTimeline();
});
