(function ($) {
    'use strict';

    $.fn.sqrSetMode = function () {
        var maincontainer = $('#maincontainer');

        function handleClick(e) {
            e.preventDefault();

            var link = $(this).attr('href').substr(1);

            if (maincontainer.attr('class') === link) {
                maincontainer.removeAttr('class');
            } else {
                maincontainer.attr('class', link);
                if (link === "sqrmodesearch") {
                    $('.sqrsearch input')[0].focus();
                }
            }
        }

        function handleClose(e) {
            if ($(e.target).parents('#eyecatcher').length === 0) {
                maincontainer.removeAttr('class');
            }
        }


        $(document).on('click', handleClose);

        $(this).on('click', handleClick);
    };
})(jQuery);


$(document).ready(function () {
    $('.sqrsetmode').sqrSetMode();
});
