(function($) {
    $.fn.ngaccordion = function() {
        this.click(function() {
            newOpen = $(this).hasClass('accordionlinkclosed');
            animate = $(this).hasClass('accordionanimate');

            id = this.href.substr(this.href.lastIndexOf('#'));

            if (newOpen) {
                $(this).removeClass('accordionlinkclosed');
                if (animate) {
                    $(id).slideDown(100);
                } else {
                    $(id).removeClass('accordionareaclosed');
                }
            } else {
                $(this).addClass('accordionlinkclosed');
                if (animate) {
                    $(id).slideUp(100);
                } else {
                    $(id).addClass('accordionareaclosed');
                }
            }

            $(window).trigger('resize');


            return false;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('a.accordionlink').ngaccordion();
});
