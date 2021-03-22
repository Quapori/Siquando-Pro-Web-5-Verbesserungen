(function($) {
    'use strict';

    $.fn.sqrPicProtect = function () {
        $(this).each(function() {
            $(this).on('contextmenu', 'img', function(e) {
                e.preventDefault();
            });
        });
    };

})(jQuery);

$(document).ready(function() {
    $('body').sqrPicProtect();
});