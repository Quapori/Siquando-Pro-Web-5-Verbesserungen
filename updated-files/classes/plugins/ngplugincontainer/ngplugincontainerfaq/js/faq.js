(function($) {
    $.fn.ngfaq = function() {
        this.click(function() {
            id = this.href.substr(this.href.lastIndexOf('#') + 1);

            $(this).parent().parent().parent().next().find('.faqarea').each(function(i, e) {
                if (e.id == id) {
                    $(e).removeClass('faqareaclosed');
                } else {
                    $(e).addClass('faqareaclosed');
                }
            });

            $(this).parent().parent().parent().find('a').each(function(i, e) {
                if (e.href.substr(this.href.lastIndexOf('#') + 1) == id) {
                    $(e).addClass('faqselected');
                } else {
                    $(e).removeClass('faqselected');
                }
            });

            $(window).trigger('resize');

            return false;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.faq a').ngfaq();
});
