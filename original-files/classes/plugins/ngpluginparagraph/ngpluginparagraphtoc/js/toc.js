(function ($) {
    $.fn.ngtoc = function () {
        $(this).click(function () {
            var target = $($(this).attr('href')),
                tabarea = target.closest('.tabarea'),
                accordionarea = target.closest('.accordionarea');

            if (tabarea.length > 0) {
                var tabareaid = tabarea.attr('id'),
                    tabcontainer = tabarea.parent('.tabcontainer').parent('div'),
                    matchingtablink = tabcontainer.find('a[href="#' + tabareaid + '"]');

                matchingtablink.trigger('click');
            }

            if (accordionarea.length > 0) {
                var accordionareaid = accordionarea.attr('id'),
                    accordioncontainer = accordionarea.parent('div'),
                    matchingaccordionlink = accordioncontainer.find('a[href="#' + accordionareaid + '"]');

                accordionarea.removeClass('accordionareaclosed');
                matchingaccordionlink.removeClass('accordionlinkclosed');
            }


        });
    };
})(jQuery);

$(document).ready(function () {
    $('ul.ngparatoc>li>a').ngtoc();
});
