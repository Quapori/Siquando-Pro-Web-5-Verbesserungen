(function ($) {
    'use strict';
    $.fn.ngCookieWarning = function () {
        var display = $(this),
            buttonAccept = display.find('.ngcookiewarningaccept'),
            buttonDecline = display.find('.ngcookiewarningdecline');


        function getCookie(name) {
            name += '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
            }
            return undefined;
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
        }

        function slideDirection() {
            return display.hasClass('ngcookiewarningtop') ? -1 : 1;
        }

        function accept() {
            setCookie('ngcc', '*', 360);
            hideDisplay();
            window.location.reload(true);
        }

        function decline() {
            setCookie('ngcc', '', 360);
            hideDisplay();
        }


        function hideDisplay() {
            display.css({
                'transform': 'translateY(' + (slideDirection() * display.outerHeight()) + 'px)',
            });

            setTimeout(function () {
                display.css('display', 'none');
            }, 1000);
        }

        function showCookie() {
            setTimeout(function () {
                display.css({
                    'transform': 'translateY(' + (slideDirection() * display.outerHeight()) + 'px)',
                    'display': 'block'
                });
                display.height();
                display.css({
                    'transform': 'translateY(0)',
                    'transition': 'transform 0.5s ease'
                });
                buttonAccept.on('click', accept);
                buttonDecline.on('click', decline);
            }, 1000);
        }

        if (getCookie('ngcc') === undefined && $('.ngparaconsent').length === 0) showCookie();

    };

    $.fn.ngCookieAllow = function () {
        var allowLinks = $(this);

        function allowCookie(e) {
            e.preventDefault();

            var id = $(this).attr('data-ngcookieid'),
                cookiedata = getCookie('ngcc');

            if (cookiedata !== '*') {
                if (cookiedata === undefined) cookiedata = '';

                var parts = cookiedata.split(',');

                if (parts.indexOf(id) === -1) {
                    if (cookiedata !== '') cookiedata += ',';
                    cookiedata += id;
                    setCookie('ngcc', cookiedata, 360);
                }
            }

            window.location.reload(true);
        }

        function getCookie(name) {
            name += '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
            }
            return undefined;
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
        }

        allowLinks.on('click', allowCookie)

    };
})(jQuery);

$(document).ready(function () {
    $('.ngcookieallow').ngCookieAllow();
})

$(window).load(function () {
    $('.ngcookiewarning').ngCookieWarning();
});