$.fn.sqrTablePivot = function() {
    $(this).each(function() {
        var headers = $(this).find('thead').find('th');
        if (headers.length > 0) {
            $(this).find('tbody').find('td').each(function() {
                $(this).attr('data-header', headers.eq($(this).index()).text().trim());
            });
        }
    });
};

$(document).ready(function() {
    $('.paragraphtablepivot').sqrTablePivot();
});
