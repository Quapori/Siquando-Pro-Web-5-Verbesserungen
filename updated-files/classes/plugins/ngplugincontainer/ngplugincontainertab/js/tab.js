(function($) {
    $.fn.ngtab = function() {
        this.click(function() {
            id = this.href.substr(this.href.lastIndexOf('#') + 1);

            $(this).parent().parent().next().find('.tabarea').each(function(i, e) {
                if (e.id == id) {
                    $(e).removeClass('tabareaclosed');
                } else {
                    $(e).addClass('tabareaclosed');
                }
            });

            $(this).parent().parent().find('a').each(function(i, e) {
                if (e.href.substr(this.href.lastIndexOf('#') + 1) == id) {
                    $(e).addClass('tabselected');
                } else {
                    $(e).removeClass('tabselected');
                }
            });

            $(window).trigger('resize');

            return false;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('ul.tab a').ngtab();
});
