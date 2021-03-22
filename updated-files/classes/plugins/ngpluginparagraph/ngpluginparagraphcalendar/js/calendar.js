(function($) {
    'use strict';
    $.fn.ngCalendar = function() {
        $(this).each(function() {
            var eventinfo = $(this).find('.paragraphcalendareventinfo'),
                cells = $(this).find('td.calendarclickable'),
                allevents = $(this).find('.paragraphcalenderevents');

            $(this).find('table').each(function() {
                var year = $(this).attr('data-year'),
                    month = $(this).attr('data-month'),
                    now = new Date();

                if (now.getFullYear() == year && now.getMonth() == month - 1) {
                    $(this).find('td').each(function() {
                        if ($(this).html() == now.getDate()) {
                            $(this).addClass('paragraphcalendartoday');
                        }
                    });
                }
            });

            cells.on('click', function() {
                allevents.children('div').appendTo(eventinfo);
                allevents.empty();
                var ids = $(this).attr('data-ids').split(' '),
                    div = $(this).parents('table').parent('div').find('.paragraphcalenderevents'),
                    header = $(this).parents('table').find('th').first();

                if (!$(this).hasClass('calendareventselected')) {

                    cells.removeClass('calendareventselected');
                    $(this).addClass('calendareventselected');

                    div.append('<p>' + $(this).html() + '. ' + header.html() + ':</p>');
                    for (var i = 0; i < ids.length; i++) {
                        $(div).append(eventinfo.find('#paragraphcalenderevent' + ids[i]));
                    }

                    $(window).trigger('lookup');

                } else {
                    cells.removeClass('calendareventselected');
                }
            });
        });
    };
})(jQuery);


$(document).ready(function() {
    $('.paragraphcalendar').ngCalendar();
});
